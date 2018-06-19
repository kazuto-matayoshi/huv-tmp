<?php
  get_header();

  global $taxonomy;
  global $term;

  // $path = $taxonomy.'-'.$term;
  $path = $taxonomy;


  // ファイルパスをチェックをするとき
  // echo 'taxonomy : '.$path;

  /**
   * ファイルがあるかの判定
   */
  if ( locate_template( 'taxonomy/'.$path.'.php' ) ) {
    get_template_part( 'taxonomy/'.$path );
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