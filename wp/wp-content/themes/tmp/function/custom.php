<?php

/**
 *
 * 01.0 - 一覧用ページネーション
 * 02.0 - パンくず
 * 03.0 - カスタム投稿タイプ
 *   03.1 - カスタム投稿タイプの追加
 *   03.2 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
 * 04.0 - 検索関係
 *   04.1 - 検索の値が空でもsearch.phpに飛ばす処理
 * 05.0 - 子ページであるかのチェック(true -> 親ページの ID を返す。)
 *
 */


/**
 * 01.0 - 一覧用ページネーション
 */
function pagination($pages = '') {

	// ページネーションのリンク数 -> ( $range * 2 ) + 1
	$range = 2;
	$showitems = ( $range * 2 ) + 1;

	// 現在のページの値を取得
	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if( $pages == '' ) {
		global $wp_query;

		// 全ページ数を取得
		$pages = $wp_query->max_num_pages;

		// 全ページ数が空の場合は、1とする
		if( !$pages ) {
			$pages = 1;
		}
	}

	// 全ページが1でない場合はページネーションを表示する
	if ( $pages != 1 ) {

		// echo "<div class=\"pagenation-content\">\n";
		echo "<ul class=\"pager\">\n";

		// 現在のページ値が1より大きい場合にPrev表示
		if ( $paged > 1 ) {
			echo "<li class=\"prev\"><a href='". get_pagenum_link( $paged - 1 ) ."'>≪</a></li>\n";
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) { //三項演算子での条件分岐
				echo ( $paged == $i ) ? "<li class=\"active\">". $i ."</li>\n" : "<li><a href='". get_pagenum_link( $i ) ."'>". $i ."</a></li>\n";
			}
		}

		// 総ページ数より現在のページ値が小さい場合にNext表示
		if ( $paged < $pages ) {
			echo "<li class=\"next\"><a href=\"". get_pagenum_link( $paged + 1 ) ."\">≫</a></li>\n";
		}
			echo "</ul>\n";
			// echo "</div>\n";
	}
}


/**
 * 02.0 - パンくず
 */
function breadcrumb() {
	global $post;
	$str = "";
	if( ( !is_home() || !is_front_page() ) && !is_admin() ){
		$str .= "<div class=\"breadcrumb w_large\">\n<ul class=\"smallfont14\">";
		$str .= "<li><a href=\"". home_url() ."\">トップ</a></li>";

		// if( is_category() ) {
		// 	$cat = get_queried_object();
		// 	if($cat->parent != 0){
		// 		$ancestors = array_reverse(get_ancestors( $cat->cat_ID, "category" ));
		// 		foreach($ancestors as $ancestor){
		// 			$str.="<li><a href="".get_category_link($ancestor)."">".get_cat_name($ancestor)."</a></li>";
		// 		}
		// 	}
		// 	$str .="<a href="".get_category_link($cat->term_id)."">".$cat->cat_name."</a>";
		// }
		// elseif( is_page() ){
		if( is_page() ){ // 調整済み
			if( $post->post_parent != 0 ){
				$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
				foreach( $ancestors as $ancestor ){
					$str .= "<li><a href=\"". get_permalink( $ancestor ) ."\">". get_the_title( $ancestor ) ."</a></li>";
				}
			}
			$str .= "<li>". get_the_title() ."</li>";
		} elseif( is_single() ){ // 調整済み - 平安
			$str .= "<li><a href=\"/". get_post_type() ."/\">";
			$str .= esc_html( get_post_type_object( get_post_type() )->label );
			$str .= "</a></li>";
			$str .= "<li>". get_the_title() ."</li>";
		} elseif( is_archive() ){ // 調整済み - 平安
			$str .= "<li>";
			$str .= esc_html( get_post_type_object( get_post_type() )->label );
			$str .= "</li>";
		} elseif( is_search() ){ // 調整済み
			$str .= "<li>求人情報一覧</li>";
		} else {
			$str .= "<li>". get_the_title() ."</li>";
		}
		$str .= "</ul>\n</div>";
	}
	echo $str;
}


//---------------------------------
/**
 * 03.0 - カスタム投稿タイプ
 */
//---------------------------------

/**
 * 03.1 - カスタム投稿タイプの追加
 */
function create_post_type() {

	/**
	 * register_post_type( '$post_type', $args );
	 * 詳細 -> http://goo.gl/Sqgk2o
	 */
	register_post_type( 'orijinal_themes', //ポストタイプ名の指定
		array(
			'labels'           => array (
				'name'           => __( 'オリジナルテーマ作成' ),
				'singular_name'  => __( 'オリジナルテーマ作成' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_position' => 5,
			'supports'      => array (
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'comments',
			),
		)
	);

	/**
	 * register_taxonomy( $taxonomy, $object_type, $args );
	 * 詳細 -> http://goo.gl/f4fyy8
	 */
	// カテゴリタクソノミー(カテゴリー分け)を使えるように設定する。(カテゴリver.)
	register_taxonomy (

		// タクソノミーの名前
		'orijinal_themes_cat',

		// 使用するカスタム投稿タイプ名
		'orijinal_themes',

		array(
			'hierarchical'          => true,
			'update_count_callback' => '_update_post_term_count',
			'label'                 => 'オリジナルテーマ作成カテゴリー',
			'public'                => true,
			'show_ui'               => true,
		)
	);

	// カテゴリタクソノミー(カテゴリー分け)を使えるように設定する。(タグver.)
	register_taxonomy(

		// タクソノミーの名前
		'orijinal_themes_tag',

		// 使用するカスタム投稿タイプ名
		'orijinal_themes',

		array(
			'hierarchical'          => false,
			'update_count_callback' => '_update_post_term_count',
			'label'                 => 'オリジナルテーマ作成タグ',
			'public'                => true,
			'show_ui'               => true
		)
	);
}
// add_action( 'init', 'create_post_type' );


/**
 * 03.2 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
 */
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
	};
};
// add_action('publish_base', 'add_slug_for_posts');


//---------------------------------
/**
 * 04.0 - 検索
 */
//---------------------------------

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


/**
 * 05.0 - 子ページであるかのチェック(true -> 親ページの ID を返す。)
 */
function is_subpage() {
	global $post;
	if ( is_page() && $post->post_parent ) {
		$parentID = $post->post_parent;
		// 親ページの ID を返します。
		return $parentID;
	} else {
		return false;
	};
};


































//---------------------------------
/*
 *           調整中
 *         ∧,,∧ ∧,,∧
 *  ∧,,∧  (´・ω・)(・ω・｀)∧,,∧
 * ( ´・ω).(O┬O) (O┬O(ω・｀ )
 * ( O┬O ∧,,∧.  ∧,,∧O┬O )
 * ◎-Ｊ┴◎(  ´・) (・｀  )┴し-◎
 *      (.__l) (l__)
 *       `ｕﾛｕ'.`ｕﾛu'
 */
//---------------------------------


// /**
//  *  投稿数の取得
//  */
// function loopPostCount() {
// 	$args = array(
// 		'post_type'      => 'post', // 投稿タイプに'post'を取得
// 		'posts_per_page' => -1,     // 'post'を全件取得
// 	);

// 	$meta_posts = get_posts($args);
// 	$count_post = 0;

// 	// 投稿数loop
// 	foreach ($meta_posts as $post) {
// 			$count_post++;
// 	}

// 	// $count_postに値を返して処理終了
// 	return $count_post;
// }


// /**
//  * mw-WP-FORM
//  * URLを見て値を引き継ぐ設定
//  */
// function my_mwform_value( $value, $name ) {
// 	/**
// 	 * $name -> inputのnameの値'work_name'
// 	 * $_GET['xxx'] -> URLパラメーターのxxxの値
// 	 */
// 	if ( $name === 'work_name' && !empty( $_GET['title'] ) && !is_array( $_GET['title'] ) ) {
// 		return $_GET['title'];
// 	}
// 	return $value;
// }

// // 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
// add_filter( 'mwform_value_mw-wp-form-xxx', 'my_mwform_value', 10, 2 );



/**
 * 他のメンバーの画像を見れないようにする設定
 * メディアの抽出条件にログインユーザーの絞り込み条件を追加する
 */
// function display_only_self_uploaded_medias( $wp_query ) {
// 		if ( is_admin() && ( $wp_query->is_main_query() || ( defined( 'DOING_QUERY_ATTACHMENT' ) && DOING_QUERY_ATTACHMENT ) ) && $wp_query->get( 'post_type' ) == 'attachment' ) {
// 				$user = wp_get_current_user();
// 				$wp_query->set( 'author', $user->ID );
// 		};
// }
// function define_doing_query_attachment_const() {
// 		if ( ! defined( 'DOING_QUERY_ATTACHMENT' ) ) {
// 				define( 'DOING_QUERY_ATTACHMENT', true );
// 		};
// }

// get_currentuserinfo();
// if($current_user->user_level < 9){
// 		add_action( 'pre_get_posts', 'display_only_self_uploaded_medias' );
// 		add_action( 'wp_ajax_query-attachments', 'define_doing_query_attachment_const', 0 );
// };

/**
 * 他の人の投稿を見れないようにする
 */ 
// function exclude_other_posts( $wp_query ) {
// 	if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
// 		$post_type = get_post_type_object( $_REQUEST['post_type'] );
// 		$cap_type = $post_type->cap->edit_other_posts;
// 	} else {
// 		$cap_type = 'edit_others_posts';
// 	};

// 	if ( is_admin() && $wp_query->is_main_query() && ! $wp_query->get( 'author' ) && ! current_user_can( $cap_type ) ) {
// 		$user = wp_get_current_user();
// 		$wp_query->set( 'author', $user->ID );
// 	};
// }

// if ($current_user->user_level < 9) {
// 	add_action( 'pre_get_posts', 'exclude_other_posts' );
// };

