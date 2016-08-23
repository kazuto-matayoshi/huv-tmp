<?php
get_header();

$path = get_post_type($post->ID);
echo 'single : '.$path;

/**
 * ファイルがあるかの判定
 */
if ( locate_template( 'single/'.$path.'.php' ) ) {
	// true

	// ファイルの呼び出し
	get_template_part( 'single/'.$path );
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