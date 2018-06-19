<?php
  ob_start();
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


  /*------------------*\
   * html compression *
  \*------------------*/
  $compress = ob_get_clean();

  // タブ削除
  $compress = str_replace( "\t", '', $compress );

  // // ??? 削除
  // $compress = str_replace( "\r", '', $compress );

  // 改行削除
  $compress = str_replace( "\n", '', $compress );

  // 閉じタグと開始タグの間の空白削除
  $compress = preg_replace( "/>[\s]*</", '><', $compress );

  // コメント削除
  $compress = preg_replace( '/<!--[\s\S]*?-->/', '', $compress );

  echo $compress;
?>