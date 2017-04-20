<?php
get_header();

	// file名の変数管理
	if ( $post->ancestors ) {
		$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
		foreach( $ancestors as $ancestor ){
			$page = get_post( $ancestor );
			$path .= $page->post_name."-";
		}
		$page = get_post( $post->ID );
		$path .= $page->post_name;
	} else {
		$path = get_page_uri($post->ID);
	};

	// 書き出しテスト
	// echo 'page : '.$path;

	/**
	 * ファイルがあるかの判定
	 */
	if ( locate_template( 'page/'.$path.'.php' ) ) {
		// true

		// ファイルの呼び出し
		get_template_part( 'page/'.$path );
	} else {
		// false

		// 入力したコンテンツの表示
		if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		endif;
	}

get_footer();
?>
