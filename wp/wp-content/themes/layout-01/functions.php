<?php
locate_template('function/init.php', true);    // 初期設定関数群(主に管理画面)
locate_template('function/custom.php', true);  // 追加関数の書き込み
locate_template('function/widget.php', true);  // headerで自動生成される不要なタグを削除する関数群
locate_template('function/cleanup.php', true); // headerで自動生成される不要なタグを削除する関数群

/**
 *
 * 01.0 - 一覧用ページネーション
 * 02.0 - パンくず
 * 03.0 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
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




/**
 * 03.0 - カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
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
		// 親ページの ID を返す。
		return $parentID;
	} else {
		return false;
	};
};

/**
 * 新着のループ処理
 */
function get_new_post( $post_type = 'post', $view_posts = 10 ) {

	// 三項演算子によるpagedの設定
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	// 三項演算子によるyearの設定
	// $_SERVER['REQUEST_URI'] => /event/2011/ => [0]->'', [1]->'event', [2]->'2011'
	$year = $post_type == 'post' ? split('[/]', $_SERVER['REQUEST_URI'])[1] : split('[/]', $_SERVER['REQUEST_URI'])[2];
	
	$query =
	array(
		'year'           => $year,
		'paged'          => $paged,
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => $view_posts,
	);
	
	$the_query = new WP_Query( $query );
	
	if ( $the_query->have_posts() ) :
		echo "<ul class=\"post\">";
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			get_template_part( 'loop-new_post' );
		endwhile;
		echo "</ul>";
		if ( !is_home() || !is_front_page() ) {
			pagination($the_query->max_num_pages);
		};
	else :
		get_template_part( '404' );
	endif;
	wp_reset_postdata(); // reset
}
