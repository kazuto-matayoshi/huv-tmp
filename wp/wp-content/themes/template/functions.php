<?php
// 初期設定関数群(主に管理画面)
get_template_part('function/init');

// 定数の設定
get_template_part('function/const');

// // ウィジェットに関する関数群
// get_template_part('function/widget');

// headerで自動生成される不要なタグを削除する関数群
get_template_part('function/cleanup');

// ajax呼び出しする際に使用する関数群
get_template_part('function/ajax');

/**
 *
 * 01.0 - 一覧用ページネーション
 * 02.0 - パンくず
 * 03.0 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
 * 04.0 - 検索
 *   04.1 - 検索の値が空でもsearch.phpに飛ばす処理
 * 05.0 - ログインしてる状態でも「非公開：」の記事が表示されないようする。
 * 06.0 - 親スラッグの取得
 *   06.1 - 直上の親を返す
 *   06.2 - 一番上の親を返す
 * 07.0 - メインクエリの書き換え
 * 08.0 - post_type == 'post'の一覧ページの設定
 * 09.0 - アイキャッチのサイズ追加
 * 10.0 - 日付チェックする関数
 * 11.0 - 投稿者別アーカイブを404へ
 * 12.0 - html、空白を除いたテキストに変換する関数 (字数制限機能付き)
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
  if ( !$args['pages'] ) {
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
  global $post_type;
  global $term;
  global $taxonomy;

  $post_type = !empty( $post_type ) ? $post_type : 'post';

  $urlArr = $_SERVER["REQUEST_URI"];
  $urlArr = explode( '/', $urlArr );
  $urlArr = array_filter( $urlArr, 'strlen' );
  $urlArr = array_values( $urlArr );

  $str = '';
  if ( ( !is_home() || !is_front_page() ) && !is_admin() ) {
    // $str .= '<div class="breadcrumb">';
    $str .= '<ul class="breadcrumb__list">';
    $str .= '<li class="breadcrumb__item"><a href="'. home_url() .'">TOP</a></li>';

    // page
    if ( is_page() ) {
      if ( $post->post_parent != 0 ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        foreach( $ancestors as $ancestor ) {
          $str .= '<li class="breadcrumb__item">';
          $str .= '<a href="'. get_permalink( $ancestor ) .'">';
          $str .= get_the_title( $ancestor );
          $str .= '</a>';
          $str .= '</li>';
        }
      }
      $str .= '<li class="breadcrumb__item">'. get_the_title() .'</li>';
    }

    // 年別とか
    elseif( is_year() || is_month() || is_day() ) {
      $link = '';
      foreach ( $urlArr as $url ) {
        $link .= '/' . $url;

        if ( $url !== end( $urlArr ) ) {
          $str .= '<li class="breadcrumb__item">';
          $str .= '<a href="'. $link .'/">';
          $str .= $url;
          $str .= '</a>';
          $str .= '</li>';
        } else {
          $str .= '<li class="breadcrumb__item">';
          $str .= esc_html( $url );
          $str .= '</li>';
        }
      }
    }

    // archive
    elseif ( is_post_type_archive( $post_type ) ) {
      $str .= '<li class="breadcrumb__item">';
      $str .= esc_html( get_post_type_object( $post_type )->label );
      $str .= '</li>';
    }

    // category
    elseif( is_category() ) {
      $str .= '<li class="breadcrumb__item">';
      $cat  = get_category( get_query_var( 'cat' ), false );
      $str .= esc_html( $cat->name );
      $str .= '</li>';
    }

    // taxonomy
    elseif ( is_tax( $taxonomy, $term ) ) {
      $str .= '<li class="breadcrumb__item">';
      $str .= get_taxonomy( $taxonomy )->label;
      $str .= '</li>';
      $str .= '<li class="breadcrumb__item">';
      $str .= single_tag_title( '', false );
      $str .= '</li>';
    }

    // single
    elseif ( is_singular( $post_type ) && is_single() ) {
      $str .= '<li class="breadcrumb__item">';
      $str .= '<a href="'. get_post_type_archive_link( $post_type ) .'">';
      $str .= esc_html( get_post_type_object( $post_type )->label );
      $str .= '</a>';
      $str .= '</li>';
      $str .= '<li class="breadcrumb__item">'. get_the_title() .'</li>';
    }

    // search
    elseif ( is_search() ) {
    }

    // 404
    elseif ( is_404() ) {
      $str .= '<li class="breadcrumb__item">404</li>';
    }

    // other
    else {
      $str .= '<li class="breadcrumb__item">404</li>';
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
  global $post;
  if ( !$post ) {
    return;
  }

  // 投稿タイプを取得
  $post_type = $post->post_type;

  // DBからpostしたidを取得し配列に入れる
  $posts_data = get_post( $post_id, ARRAY_A );

  // DBから取得した配列の'post_name'を抽出
  $slug       = $posts_data['post_name'];

  if ( $post_id !== $slug && $post_type !== 'page' ) {
    remove_action( 'save_post', 'add_slug_for_posts' );

    $my_post              = array();
    $my_post['ID']        = $post_id;
    $my_post['post_name'] = $post_id;
    wp_update_post( $my_post );

    add_action( 'save_post', 'add_slug_for_posts' );
  }
}

// add_action( 'save_post', 'add_slug_for_posts' );

//---------------------------------------------------------------------------------------------------
/**
 * 04.0 - 検索
 */
//---------------------------------------------------------------------------------------------------

/**
 * 04.1 - 検索の値が空でもsearch.phpに飛ばす処理
 */
function custom_search( $search, $wp_query ) {
  if ( isset( $wp_query->query['s'] ) ) {
    $wp_query->is_search = true;
  }
  return $search;
}
// add_filter( 'posts_search', 'custom_search', 10, 2);

//---------------------------------------------------------------------------------------------------
/**
 * 05.0 - ログインしてる状態でも「非公開：」の記事が表示されないようする。
 */
//---------------------------------------------------------------------------------------------------
function parse_query_ex() {
  if ( !is_super_admin() && !get_query_var( 'post_status' ) && !is_singular() ) {
    set_query_var( 'post_status', 'publish' );
  }
}
// add_action('parse_query', 'parse_query_ex');

//---------------------------------------------------------------------------------------------------
/**
 * 06.0 - 親スラッグの取得
 */
//---------------------------------------------------------------------------------------------------
/**
 * 06.1 - 直上の親を返す
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
 * 06.2 - 一番上の親を返す
 */
function get_root_info( $info, $post_id = null ) {
  global $post;
  $post_id = $post_id !== null ? $post_id : get_the_id();


  if ( !$post_id || $post_id === null ) {
    return false;
  }

  $post = get_post( $post_id );

  // $postが取得できない場合（アーカイブとか）
  if ( $post === null ) {
    return false;
  }

  // 親がいない場合
  if ( count( $post->ancestors ) === 0 ) {
    if ( $info === 'id' ) {
      return $post->ID;
    }
    else if ( $info === 'slug' ) {
      return $post->post_name;
    }
  }
  else {
    $root_parent = get_post( $post->ancestors[ count( $post->ancestors ) - 1 ] );

    if ( $info === 'id' ) {
      return $root_parent->ID;
    }
    else if ( $info === 'slug' ) {
      return $root_parent->post_name;
    }
  }
}

function is_root_slug( $slug = null ) {
  global $post;

  // $postが取得できない場合（アーカイブとか）
  if ( $post === null ) {
    return false;
  }

  if ( empty( $slug ) ) {
    $root_parent = get_post( $post->ancestors[ count( $post->ancestors ) - 1 ] );
    return $root_parent->post_name;
  }

  if ( get_root_info( 'slug' ) === $slug ) {
    return true;
  } else {
    return false;
  }
}

function is_root_id( $post_id = null ) {
  global $post;

  // $postが取得できない場合（アーカイブとか）
  if ( $post === null ) {
    return false;
  }

  if ( empty( $post_id ) ) {
    $root_parent = get_post( $post->ancestors[ count( $post->ancestors ) - 1 ] );
    return $root_parent->ID;
  }

  if ( get_root_info( 'id' ) === $post_id ) {
    return true;
  } else {
    return false;
  }
}


//---------------------------------------------------------------------------------------------------
/**
 * 07.0 - メインクエリの書き換え
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
 * 08.0 - post_type == 'post'の一覧ページの設定
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
// add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

//---------------------------------------------------------------------------------------------------
/**
 * 09.0 - アイキャッチのサイズ追加
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

//---------------------------------------------------------------------------------------------------
/**
 * 10.0 - 日付チェックする関数
 */
//---------------------------------------------------------------------------------------------------

/**
 * @param $day       -> Newを表示させたい期間の日数
 * @param $post_date -> 投稿の日付
 */

function new_checker( $day, $post_date = '' ) {
  global $post, $posts;

  if ( !$post_date ) {
    $post_date = $post->post_date;
  }

  $today = date_i18n( 'U' );
  $entry = strtotime( $post_date );

  // Newを表示させたい期間の日数
  $days = $day;
  $kiji = date( 'U', ( $today - $entry ) ) / 86400;
  // 86400(s/Day) = 60(s) * 60(m) * 24(h)

  if ( $days > $kiji ) {
    return true;
  }
  return false;
}

//---------------------------------------------------------------------------------------------------
/**
 * 11.0 - 投稿者別アーカイブを404へ
 */
//---------------------------------------------------------------------------------------------------
add_filter( 'author_rewrite_rules', '__return_empty_array' );
function disable_author_archive() {
  if ( isset( $_GET['author'] ) || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
    wp_redirect( home_url( '/404.php' ) );
    exit;
  }
}
add_action('init', 'disable_author_archive');

//---------------------------------------------------------------------------------------------------
/**
 * 12.0 - html、空白を除いたテキストに変換する関数 (字数制限機能付き)
 */
//---------------------------------------------------------------------------------------------------
function convert_string( $string, $length = null, $leader = '...' ) {
  $str = strip_tags( $string );
  $str = preg_replace( "/( |　)|\n|\r|\r\n/", '', $str );

  // 字数制限
  if ( is_int( $length ) && $length !== null ) {
    if ( mb_strlen( $str, 'UTF-8' ) > $length ) {
      $l_length = mb_strlen( $leader, 'UTF-8' );
      $str = mb_substr( $str, 0, $length - $l_length, 'UTF-8' ).$leader;
    }
  }

  return $str;
}