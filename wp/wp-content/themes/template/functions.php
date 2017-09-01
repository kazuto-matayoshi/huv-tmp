<?php
// 初期設定関数群(主に管理画面)
get_template_part('function/init');

// 定数の設定
get_template_part('function/const');

// ウィジェットに関する関数群
get_template_part('function/widget');

// headerで自動生成される不要なタグを削除する関数群
get_template_part('function/cleanup');

// カスタム投稿タイプ関係
get_template_part('function/custom_post');

/**
 *
 * 01.0 - 一覧用ページネーション
 * 02.0 - パンくず
 * 03.0 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
 * 04.0 - 検索
 *   04.1 - 検索の値が空でもsearch.phpに飛ばす処理
 * 05.0 - アーカイブページの記事ループ外でも、通常の記事ループ内でもpost_typeを取得できるようにした関数
 * 06.0 - ログインしてる状態でも「非公開：」の記事が表示されないようする。
 * 07.0 - 子ページであるかのチェック(true -> 親ページの ID を返す。)
 * 08.0 - 親スラッグの取得
 *   08.1 - 直上の親を返す
 *   08.2 - 一番上の親を返す
 * 09.0 - メインクエリの書き換え
 * 10.0 - post_type == 'post'の一覧ページの設定
 * 11.0 - アイキャッチのサイズ追加
 *
 */

//---------------------------------------------------------------------------------------------------
/**
 * 01.0 - 一覧用ページネーション
 */
//---------------------------------------------------------------------------------------------------
function pagination( $args = array() ) {

  $df_args = array(
    /**
     * @param str 'link' or 'text'
     * linkにすると数字の部分がリンクになります。
     * textだと 1/n となります。
     */
    'type'         => 'link',

    /**
     * @param bool true or false
     * trueにするとprev、nextへのリンクがない場合非表示にします。
     */
    'hide'         => true,

    /**
     * type == linkの時に使用します。
     * 現在のページを中心に左右に何個リンクを排出するかの設定になります。
     */
    'range'        => 2,

    /**
     * @param float $wp_query->max_num_pages
     * ページの最大値です。
     * 基本設定しませんが、WP_Query等でループした際には必須となります。
     */
    'pages'        => '',

    /**
     * @param str -> base class name
     * クラス名を変更できます。
     */
    'class_name'   => 'pager',

    /**
     * @param bool
     * wrapperを生成するかどうか。
     */
    'wrapper'      => false,

    /**
     * @param str
     * nextのテキストの設定
     */
    'next_txt'     => '>',

    /**
     * @param str
     * prevのテキストの設定
     */
    'prev_txt'     => '<',

    /**
     * @param bool
     * 最後まで飛ばすリンクを作成するか
     */
    'endlink'      => false,

    /**
     * @param str
     * end nextのテキストの設定
     */
    'end_next_txt' => '>>',

    /**
     * @param str
     * end prevのテキストの設定
     */
    'end_prev_txt' => '<<',
  );

  $args = array_merge( $df_args, $args );

  // ページネーションのリンク数
  $showitems = ( $args['range'] * 2 ) + 1;

  // 現在のページの値を取得
  global $paged;

  if ( empty( $paged ) ) {
    $paged = 1;
  }

  if ( $args['pages'] == '' ) {
    global $wp_query;

    // 全ページ数を取得
    $args['pages'] = $wp_query->max_num_pages;
  }

  // 全ページ数が空の場合は、1とする
  if( !$args['pages'] ) {
    $args['pages'] = 1;
  }

  // 全ページが1でない場合はページネーションを表示する
  if ( $args['pages'] != 1 ) {
    if ( $args['wrapper'] ) {
      echo '<div class="'.$args['class_name'].'">';
    }

    echo '<ul class="'.$args['class_name'].'__list">';
      // endPrev
      if ( $args['endlink'] ) {
        if ( $args['hide'] ) {
          if ( $paged > 1 ) {
            echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--endPrev"><a href="'. get_pagenum_link( 1 ) .'">',
                    $args['end_prev_txt'],
                 '</a></li>';
          }
        } else {
          if ( ( $paged - 1 ) > 1 ) {
            echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--endPrev"><a href="'. get_pagenum_link( 1 ) .'">',
                    $args['end_prev_txt'],
                 '</a></li>';
          } else {
            echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--endPrev">',
                    $args['end_prev_txt'],
                 '</a></li>';
          }
        }
      }

      // Prev
      if ( $args['hide'] ) {
        if ( $paged > 1 ) {
          echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--prev"><a href="'. get_pagenum_link( $paged - 1 ) .'">',
                  $args['prev_txt'],
               '</a></li>';
        }
      } else {
        if ( $paged > 1 ) {
          echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--prev"><a href="'. get_pagenum_link( $paged - 1 ) .'">',
                  $args['prev_txt'],
               '</a></li>';
        } else {
          echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--prev">',
                  $args['prev_txt'],
               '</li>';
        }
      }

      if ( $args['type'] === 'link' ) {
        for ( $i = 1; $i <= $args['pages']; $i++ ) {
          if (
            1 != $args['pages']
            && (
              !( $i >= $paged + $args['range'] + 1 || $i <= $paged - $args['range'] - 1 )
              || $args['pages'] <= $showitems
            )
          ) {
            if ( $paged == $i ) {
              echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--active">'. $i .'</li>';
            } else {
              echo '<li class="'.$args['class_name'].'__list__item"><a href="'. get_pagenum_link( $i ) .'">'. $i .'</a></li>';
            }
          }
        }
      } elseif ( $args['type'] === 'text' ) {
        echo '<li class="'.$args['class_name'].'__list__item">'.$paged.'/'.$args['pages'].'</li>';
      }

      // next
      if ( $args['hide'] ) {
        if ( $paged < $args['pages'] ) {
          echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--next"><a href="'. get_pagenum_link( $paged + 1 ) .'">',
                  $args['next_txt'],
               '</a></li>';
        }
      } else {
        if ( $paged < $args['pages'] ) {
          echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--next"><a href="'. get_pagenum_link( $paged + 1 ) .'">',
                  $args['next_txt'],
               '</a></li>';
        } else {
          echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--next">',
                  $args['next_txt'],
               '</li>';
        }
      }

      // endNext
      if ( $args['endlink'] ) {
        if ( $args['hide'] ) {
          if ( $paged < $args['pages'] ) {
            echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--endNext"><a href="'. get_pagenum_link( $args['pages'] ) .'">',
                    $args['end_next_txt'],
                 '</a></li>';
          }
        } else {
          if ( ( $paged + 1 ) < $args['pages'] ) {
            echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--endNext"><a href="'. get_pagenum_link( $args['pages'] ) .'">',
                    $args['end_next_txt'],
                 '</a></li>';
          } else {
            echo '<li class="'.$args['class_name'].'__list__item '.$args['class_name'].'__list__item--endNext">',
                    $args['end_next_txt'],
                 '</li>';
          }
        }
      }
    echo '</ul>';

    if ( $args['wrapper'] ) {
      echo '</div>';
    }
  }
}

//---------------------------------------------------------------------------------------------------
/**
 * 02.0 - パンくず
 */
//---------------------------------------------------------------------------------------------------
function breadcrumb() {
  global $post;
  global $taxonomy;
  global $term;

  $str = "";
  if( ( !is_home() || !is_front_page() ) && !is_admin() ) {
    // $str .= '<div class="breadcrumb">';
    $str .= '<ul class="breadcrumb-list">';
    $str .= '<li class="breadcrumb-list-item"><a href="'. home_url() .'">TOP</a></li>';

    // if( is_category() ) {
    //  $cat = get_queried_object();
    //  if($cat->parent != 0) {
    //    $ancestors = array_reverse(get_ancestors( $cat->cat_ID, 'category' ));
    //    foreach($ancestors as $ancestor) {
    //      $str.='<li><a href='.get_category_link($ancestor).'>'.get_cat_name($ancestor).'</a></li>';
    //    }
    //  }
    //  $str .='<a href='.get_category_link($cat->term_id).'>'.$cat->cat_name.'</a>';
    // }
    // elseif( is_page() ) {
    if( is_page() ) { // 調整済み
      if( $post->post_parent != 0 ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        foreach( $ancestors as $ancestor ) {
          $str .= '<li class="breadcrumb-list-item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>';
        }
      }
      $str .= '<li class="breadcrumb-list-item">'. get_the_title() .'</li>';
    } elseif( is_singular( get_post_type() ) && is_single() ) {
      $str .= '<li class="breadcrumb-list-item"><a href="'. get_post_type_archive_link( get_post_type() ) .'">';
      $str .= esc_html( get_post_type_object( get_post_type() )->label );
      $str .= '</a></li>';
      $str .= '<li class="breadcrumb-list-item">'. get_the_title() .'</li>';
    } elseif( is_post_type_archive( get_post_type() ) ) {
      $str .= '<li class="breadcrumb-list-item">';
      $str .= esc_html( get_post_type_object( get_post_type() )->label );
      $str .= '</li>';
    } elseif( is_tax( $taxonomy, $term ) ) {
      $str .= '<li class="breadcrumb-list-item">';
      $str .= get_taxonomy( $taxonomy )->label;
      $str .= '</li>';
      $str .= '<li class="breadcrumb-list-item">';
      $str .= single_tag_title( '', false );
      $str .= '</li>';
    } elseif( is_search() ) {
    } elseif( is_404() ) {
      $str .= '<li class="breadcrumb-list-item">404</li>';
    } else {
      // $str .= '<li class="breadcrumb-list-item">'. get_the_title() .'</li>';
      $str .= '<li class="breadcrumb-list-item">404</li>';
    }
    $str .= '</ul>';
    // $str .= '</div>';
  }
  echo $str;
}

//---------------------------------------------------------------------------------------------------
/**
 * 03.0 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
 */
//---------------------------------------------------------------------------------------------------
function add_slug_for_posts( $post_id ) {
  // DBからpostしたidを取得し配列に入れる
  $posts_data = get_post( $post_id, ARRAY_A );

  // DBから取得した配列の'post_name'を抽出
  $slug       = $posts_data['post_name'];

  if ( $post_id != $slug ){
    $my_post              = array();
    $my_post['ID']        = $post_id;
    $my_post['post_name'] = $post_id;
    wp_update_post($my_post);
  }
}
$post_type_array = array(
  'original_post_type',
);

foreach ($post_type_array as $post_type_value) {
  // add_action( "publish_{$post_type_value}", 'add_slug_for_posts' );
}

//---------------------------------------------------------------------------------------------------
/**
 * 04.0 - 検索
 */
//---------------------------------------------------------------------------------------------------

/**
 * 04.1 - 検索の値が空でもsearch.phpに飛ばす処理
 */
function custom_search( $search, $wp_query ) {
  if( isset( $wp_query->query['s'] ) ) {
    $wp_query->is_search = true;
  }
  return $search;
}
// add_filter( 'posts_search', 'custom_search', 10, 2);


//---------------------------------------------------------------------------------------------------
/**
 * 05.0 - アーカイブページの記事ループ外でも、通常の記事ループ内でもpost_typeを取得できるようにした関数
 */
//---------------------------------------------------------------------------------------------------
function get_post_type_query() {
  if ( is_archive() ) {
    return get_query_var( 'post_type' );
  }
  return get_post_type();
}

//---------------------------------------------------------------------------------------------------
/**
 * 06.0 - ログインしてる状態でも「非公開：」の記事が表示されないようする。
 */
//---------------------------------------------------------------------------------------------------
function parse_query_ex() {
  if ( !is_super_admin() && !get_query_var('post_status') && !is_singular() ) {
    set_query_var('post_status', 'publish');
  }
}
// add_action('parse_query', 'parse_query_ex');

//---------------------------------------------------------------------------------------------------
/**
 * 07.0 - 子ページであるかのチェック(true -> 親ページの ID を返す。)
 */
//---------------------------------------------------------------------------------------------------
function is_subpage() {
  global $post;
  if ( is_page() && $post->post_parent ) {
    $parentID = $post->post_parent;
    // 親ページの ID を返す。
    return $parentID;
  } else {
    return false;
  };
};

//---------------------------------------------------------------------------------------------------
/**
 * 08.0 - 親スラッグの取得
 */
//---------------------------------------------------------------------------------------------------
/**
 * 08.1 - 直上の親を返す
 */
function is_parent_slug( $post_type ) {
  global $post;
  if ( $post->post_parent ) {
    $post_data = get_post( $post->post_parent );

    if ( empty( $post_type ) ) {
      return $post_data->post_name;
    }

    if ( !empty( $post_type ) && $post_data->post_name === $post_type ) {
      return true;
    } else {
      return false;
    }
  }
}

/**
 * 08.2 - 一番上の親を返す
 */
function get_root_parent_slug( $post_id ) {
  global $post;

  if ( $post_id ) {
    $post = get_post( $post_id );
  }

  $root_parent = get_post( $post->ancestors[ count( $post->ancestors ) - 1 ] );

  return $root_parent->post_name;
}

function is_root_parent_slug( $slug ) {
  global $post;

  if ( empty( $slug ) ) {
    $root_parent = get_post($post->ancestors[count($post->ancestors) - 1]);
    return $root_parent->post_name;
  }

  if ( get_root_parent_slug() === $slug ) {
    return true;
  } else {
    return false;
  }
}

//---------------------------------------------------------------------------------------------------
/**
 * 09.0 - メインクエリの書き換え
 */
//---------------------------------------------------------------------------------------------------

function change_posts_per_page($query) {
/* 管理画面,メインクエリに干渉しないために必須 */
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

 // カテゴリーページの表示件数を5件にする 
  if ( $query->is_category() ) {
    // $query->set( 'posts_per_page', '5' );
    return;
  }

}
// add_action( 'pre_get_posts', 'change_posts_per_page' );

//---------------------------------------------------------------------------------------------------
/**
 * 10.0 - post_type == 'post'の一覧ページの設定
 */
//---------------------------------------------------------------------------------------------------
/*
 * 投稿にアーカイブ(投稿一覧)を持たせるようにします。
 * ※ 記載後にパーマリンク設定で「変更を保存」してください。
 */
function post_has_archive( $args, $post_type ) {
  if ( $post_type == 'post' ) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'post'; // ページ名
  }
  return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

//---------------------------------------------------------------------------------------------------
/**
 * 11.0 - アイキャッチのサイズ追加
 */
//---------------------------------------------------------------------------------------------------

// add_image_size( 'tmpl_thumbnail', 530, 374, true );

// メディアアップローダーに登録するために必須
function my_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'tmpl_thumbnail' => __('tmpl_thumbnail'),
  ) );
}
// add_filter( 'image_size_names_choose', 'my_custom_sizes' );