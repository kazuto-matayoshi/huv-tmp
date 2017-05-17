<?php
// 初期設定関数群(主に管理画面)
get_template_part('function/init');

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
 *
 */


//---------------------------------------------------------------------------------------------------
/**
 * 01.0 - 一覧用ページネーション
 */
//---------------------------------------------------------------------------------------------------
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

		// echo '<div class="pagenation-content">';
		echo '<ul class="pager">';

		// 現在のページ値が1より大きい場合にPrev表示
		if ( $paged > 1 ) {
			echo '<li class="prev"><a href="'. get_pagenum_link( $paged - 1 ) .'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				//三項演算子での条件分岐
				echo ( $paged == $i ) ? '<li class="active">'. $i .'</li>' : '<li><a href="'. get_pagenum_link( $i ) .'">'. $i .'</a></li>';
			}
		}

		// 総ページ数より現在のページ値が小さい場合にNext表示
		if ( $paged < $pages ) {
			echo '<li class="next"><a href="'. get_pagenum_link( $paged + 1 ) .'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
		}
			echo '</ul>';
			// echo '</div>';
	}
}

//---------------------------------------------------------------------------------------------------
/**
 * 02.0 - パンくず
 */
//---------------------------------------------------------------------------------------------------
function breadcrumb() {
	global $post;
	$str = "";
	if( ( !is_home() || !is_front_page() ) && !is_admin() ){
		// $str .= '<div class="breadcrumb">';
		$str .= '<ul class="breadcrumb-list">';
		$str .= '<li class="breadcrumb-list-item"><a href="'. home_url() .'">TOP</a></li>';

		// if( is_category() ) {
		// 	$cat = get_queried_object();
		// 	if($cat->parent != 0){
		// 		$ancestors = array_reverse(get_ancestors( $cat->cat_ID, 'category' ));
		// 		foreach($ancestors as $ancestor){
		// 			$str.='<li><a href='.get_category_link($ancestor).'>'.get_cat_name($ancestor).'</a></li>';
		// 		}
		// 	}
		// 	$str .='<a href='.get_category_link($cat->term_id).'>'.$cat->cat_name.'</a>';
		// }
		// elseif( is_page() ){
		if( is_page() ){ // 調整済み
			if( $post->post_parent != 0 ){
				$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
				foreach( $ancestors as $ancestor ){
					$str .= '<li class="breadcrumb-list-item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>';
				}
			}
			$str .= '<li class="breadcrumb-list-item">'. get_the_title() .'</li>';
		} elseif( is_single() ){
			$str .= '<li class="breadcrumb-list-item"><a href="/'. get_post_type() .'/">';
			$str .= esc_html( get_post_type_object( get_post_type() )->label );
			$str .= '</a></li>';
			$str .= '<li class="breadcrumb-list-item">'. get_the_title() .'</li>';
		} elseif( is_archive() ){
			$str .= '<li class="breadcrumb-list-item">';
			$str .= esc_html( get_post_type_object( get_post_type() )->label );
			$str .= '</li>';
		} elseif( is_search() ){
		} else {
			$str .= '<li class="breadcrumb-list-item">'. get_the_title() .'</li>';
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
	};
};
// add_action('publish_base', 'add_slug_for_posts');

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
function is_parent_slug() {
	global $post;
	if ($post->post_parent) {
		$post_data = get_post($post->post_parent);
		return $post_data->post_name;
	}
}

/**
 * 08.2 - 一番上の親を返す
 */
function is_root_parent_slug() {
	global $post;
	$root_parent = get_page($post->ancestors[count($post->ancestors) - 1]);
	return $root_parent->post_name;
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