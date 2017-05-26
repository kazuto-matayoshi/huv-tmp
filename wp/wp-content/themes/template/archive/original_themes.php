<?php
  /**
   * loopの細かい設定はfunctions.php
   * 09.0 - メインクエリの書き換え
   */
  $query =
  array(
    // 投稿のタイプ
    'post_type'      => 'original_themes',

    // 投稿の状態
    'post_status'    => 'publish',

    // 表示数
    'posts_per_page' => get_option('posts_per_page'),
  );

  // if ( is_user_logged_in() ) {
  //  $query['post_status'] = array(
  //    'publish',
  //    'pending',
  //    'draft',
  //    'future',
  //    'private',
  //    'inherit',
  //  );
  // }

  $the_query = new WP_Query( $query );

  if ( $the_query->have_posts() ) :
  echo '<ul class="post-list">';
    while ( $the_query->have_posts() ) :
    $the_query->the_post();
?>
    <li class="post-list-item">
      <p class="post-img"><?php
        // アイキャッチ
        if ( has_post_thumbnail( 'thumbnail' ) ) {
          echo the_post_thumbnail( 'thumbnail' );
        } else {
          echo'<img src="/img/no-image.jpg" alt="no-image">';
        }
      ?></p>
      <p class="post-day"><?php echo get_the_date(); ?></p>
      <p class="post-ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
    </li>
<?php
    endwhile;
  echo '</ul>';
  // ページネーション
  pagination($the_query->max_num_pages);
endif;
wp_reset_postdata(); // reset
?>