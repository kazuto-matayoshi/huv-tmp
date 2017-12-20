<?php get_header(); ?>
<article class="article-box">
  <?php
    // どうにもうまくいかない時用 -> 投稿タイプ追加時にURL変更している場合注意
    // $path = get_post_type($post->ID);

    // 普段はこっち
    $post_link = get_post_permalink();
    $post_dir  = str_replace( home_url(), '', $post_link );

    $url  = explode( '/', $post_dir );
    $path = '';

    if ( get_post_type() === $url[1] ) {
      $path = get_post_type() ? get_post_type() : 'post';
    }
    elseif ( is_preview() ) {
      /**
       * preview - テスト
       * "$path = get_post_type($post->ID);" 同様、
       * 投稿タイプ追加時にURL変更している場合、注意が必要 "かも" しれない。
       */
      $path = $_GET['post_type'];
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

    // 書き出しテスト
    // echo 'single : '.$path;

    /**
     * ファイルがあるかの判定
     */
    if ( locate_template( 'single/'.$path.'.php' ) ) {
      // ファイルの呼び出し
      get_template_part( 'single/'.$path );
    }
    else {
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
<?php get_footer(); ?>
