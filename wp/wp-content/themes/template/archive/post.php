<?php
/**
 * loopの細かい設定はfunctions.php
 * 09.0 - メインクエリの書き換え
 */

if ( have_posts() ) :
  echo '<ul class="post__list">';
  while ( have_posts() ) :
    the_post();
?>
  <li class="post__item">
    <p class="post__img"><?php
      // アイキャッチ
      $attr = array(
        'class'    => 'lazyload',
      );
      if ( has_post_thumbnail( $post->ID ) ) {
        huv_lazyload( huv_get_thumbnail_src( 'thumbnail' ), $attr );
      }
      else {
        $attr['alt'] = 'no-image';
        huv_lazyload( huv_url_theme.'assets/img/common/no-image.jpg', $attr );
      }
    ?></p>
    <p class="post__day"><?php echo get_the_date( 'Y.m.d' ); ?></p>
    <p class="post__ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
  </li>
<?php
  endwhile;
  echo '</ul>';
  global $wp_query;

  // ページネーション
  $args = array(
    // 'type'         => 'link',
    // 'hide'         => true,
    // 'range'        => 2,
    // 'pages'        => $the_query->max_num_pages,
    // 'class_name'   => 'pager',
    // 'wrapper'      => false,
    // 'next_txt'     => '>',
    // 'prev_txt'     => '<',
    // 'endlink'      => false,
  );
  pagination( $args );
endif;
?>