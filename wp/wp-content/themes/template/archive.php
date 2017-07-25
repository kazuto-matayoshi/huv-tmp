<?php
get_header();
  $archive_link = get_post_type_archive_link( get_post_type() );
  $protocol     = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
  $domain       = $_SERVER['HTTP_HOST'];
  $archive_dir  = str_replace( $protocol.$domain, '', $archive_link );

  $url  = explode( '/', $archive_dir );
  $path = '';

  if ( get_post_type() === $url[1] ) {
    $path = get_post_type() ? get_post_type() : 'post';
  } else {
    // $path = $url[1];
    foreach ( $url as $key => $value ) {
      if ( $value && !$path ) {
        $path .= $value;
      } elseif ( $value && $path ) {
        $path .= '-'.$value;
      }
    }
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