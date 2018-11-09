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
  echo '<ul class="post__list">';
    while ( $the_query->have_posts() ) :
    $the_query->the_post();
?>
    <li class="post__item">
      <p class="post__img"><?php
        // アイキャッチ
        $attr = array(
          'class'    => 'lazyload',
        );
        if ( has_post_thumbnail( $post->ID ) ) {
          huv_lazyload( huv_get_thumbnail_src( 'thumbnail' ), $attr );
        } else {
          $attr['alt'] = 'no-image';
          huv_lazyload( huv_url_theme.'assets/img/common/no-image.jpg', $attr );
        }
      ?></p>
      <p class="post__day"><?php echo get_the_date(); ?></p>
      <p class="post__ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
    </li>
<?php
    endwhile;
  echo '</ul>';

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
wp_reset_postdata(); // reset
?>