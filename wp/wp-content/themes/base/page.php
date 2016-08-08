<?php
get_header();

$path = get_page_uri($post->ID);

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
