<?php
get_header();

  $url = explode( '/', $_SERVER['REQUEST_URI'] );

  if ( get_post_type() === $url[1] ) {
    $path = get_post_type() ? get_post_type() : 'post';
  } else {
    $path = $url[1];
  }

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