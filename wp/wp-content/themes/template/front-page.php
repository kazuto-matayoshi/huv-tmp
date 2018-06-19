<?php
  get_header();
  create_mv();
?>

<?php
  $query =
  array(
    // ページネーションを使用しないのであれば常に 'true'
    'no_found_rows'  => true,

    // 投稿のタイプ
    'post_type'      => 'post',

    // 投稿の状態
    'post_status'    => 'publish',

    // 表示数
    'posts_per_page' => 3,
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
            huv_lazyload( huv_theme_path.'assets/img/common/no-image.jpg', $attr );
          }
        ?></p>
        <p class="post__day"><?php echo get_the_date(); ?></p>
        <p class="post__ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
      </li>
    <?php endwhile;
    echo '</ul>';
  endif;
  wp_reset_postdata(); // reset
?>
<?php
  get_footer();
?>