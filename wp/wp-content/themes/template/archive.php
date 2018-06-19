<?php
  ob_start();
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

  // 何かしらでアーカイブのディレクトリが取得できなかった場合
  if ( $url[0] === '' ) {
    $path = $post_type;
  }
  // カスタム投稿名/ユニーク名とかになっていた場合
  else if ( $post_type === $url[0] && !isset( $url[1] ) ) {
    $path = $post_type;
  }
  // それ以外
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