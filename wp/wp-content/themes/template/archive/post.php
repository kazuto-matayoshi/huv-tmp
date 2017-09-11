<?php
/**
 * loopの細かい設定はfunctions.php
 * 09.0 - メインクエリの書き換え
 */
if ( have_posts() ) :
  echo '<ul class="post-list">';
  while ( have_posts() ) :
    the_post();
?>
  <li class="post-list-item">
    <p class="post-img"><?php
      // アイキャッチ
      if ( has_post_thumbnail( $post->ID ) ) {
        echo the_post_thumbnail( 'thumbnail' );
      } else {
        echo '<img src="'.huv_theme_path.'img/no-image.jpg" alt="no-image">';
      }
    ?></p>
    <p class="post-day"><?php echo get_the_date(); ?></p>
    <p class="post-ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
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
  pagination($args);
endif;
?>