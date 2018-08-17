<?php
  // ob_start();
  get_header();
?>
<?php get_template_part( '404_content' ); ?>
<?php
  get_footer();

  // /*------------------*\
  //  * html compression *
  // \*------------------*/
  // $compress = ob_get_clean();

  // // タブ削除
  // $compress = str_replace( "\t", '', $compress );

  // // // ??? 削除
  // // $compress = str_replace( "\r", '', $compress );

  // // 改行削除
  // $compress = str_replace( "\n", '', $compress );

  // // 閉じタグと開始タグの間の空白削除
  // $compress = preg_replace( "/>[\s]*</", '><', $compress );

  // // コメント削除
  // $compress = preg_replace( '/<!--[\s\S]*?-->/', '', $compress );

  // echo $compress;
?>