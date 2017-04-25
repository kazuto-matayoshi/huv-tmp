<?php
get_header();

	$path = get_post_type();

	// 書き出しテスト
	echo 'taxonomy : '.$path;

/**
 * ファイルがあるかの判定
 */
if ( $path == 'marine' || $path == 'diving' || $path == 'licence' ) {
	get_template_part( 'taxonomy/menu-taxonomys' );
} else if ( locate_template( 'taxonomy/'.$path.'.php' ) ) {
	// true

	get_template_part( 'taxonomy/'.$path );
} else {
	// false
echo $path;
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