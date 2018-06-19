<?php
  get_header();
?>
<article class="article-box">
<?php
  // $path = get_post_type($post->ID);
  global $post_type;
  $post_type = !empty( $post_type ) ? $post_type : 'post';

  $post_link = get_post_type_archive_link( $post_type );
  $post_dir  = str_replace( home_url(), '', $post_link );

  $url = explode( '/', $post_dir );
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
  elseif ( is_preview() ) {
    /**
     * preview - テスト
     * "$path = get_post_type($post->ID);" 同様、
     * 投稿タイプ追加時にURL変更している場合、注意が必要 "かも" しれない。
     */
    $path = $_GET['post_type'];
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

  // // 書き出しテスト
  // echo 'single : '.$path;

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
?>
</article>
<?php
  get_footer();
?>