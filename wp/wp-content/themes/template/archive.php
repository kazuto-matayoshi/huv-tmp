<?php
  get_header();

  global $post_type;

  $post_type = !empty( $post_type ) ? $post_type : 'post';

  // 各値の取得
  $archive_link = get_post_type_archive_link( $post_type );
  $archive_dir  = str_replace( home_url(), '', $archive_link );

  $url = explode( '/', $archive_dir );
  $url = array_filter( $url, 'strlen' );
  $url = array_values( $url );

  // 何かしらの形でアーカイブのリンクが変更され、上手く取得できない状態を回避
  // 一度arrayの歯抜けなど調整しているがこの方が確実。。。
  if ( !isset( $url[0] ) ) {
    $url[] = '';
  }

  $path = '';

  if ( $post_type === $url[0] ) {
    $path = $post_type;
  }

  else {
    foreach ( $url as $key => $value ) {
      if ( $value && !$path ) {
        $path .= $value;
      } elseif ( $value && $path ) {
        $path .= '-'.$value;
      }
    }
  }

  // ファイルパスをチェックをするとき
  // echo 'archive : '.$path;

  /**
   * ファイルがあるかの判定
   */
  if ( locate_template( 'archive/'.$path.'.php' ) ) {
    get_template_part( 'archive/'.$path );
  }

  // いる？
  else {

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