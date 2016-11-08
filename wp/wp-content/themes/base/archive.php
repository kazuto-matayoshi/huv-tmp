<?php
get_header();

	$path = get_post_type($post->ID);

	// 書き出しテスト
	// echo 'archive : '.$path;

/**
 * ファイルがあるかの判定
 */
if ( locate_template( 'archive/'.$path.'.php' ) ) {
	// true

	// ファイルの呼び出し
	get_template_part( 'archive/'.$path );
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