<?php
if ( have_posts() ) :
while ( have_posts() ) :
  the_post();
  the_content();
endwhile;
endif;
?>

<?php 
  // 三項演算子によるpagedの設定
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;

  // 三項演算子によるyearの設定
  // $_SERVER['REQUEST_URI'] => /event/2011/ => [0]->'', [1]->'event', [2]->'2011'
  // $year = '';
  // if ( is_archive() ) {
  //  $year = $option['post_type'] == 'post' ? split('[/]', $_SERVER['REQUEST_URI'])[1] : split('[/]', $_SERVER['REQUEST_URI'])[2];
  // }

  $query =
  array(
    // 'year'           => $year,

    // 現在のページ
    'paged'          => $paged,

    // 投稿のタイプ
    'post_type'      => 'post',

    // 投稿の状態
    'post_status'    => 'publish',

    // 表示数
    'posts_per_page' => get_option('posts_per_page'),
  );

  $the_query = new WP_Query( $query );

  if ( $the_query->have_posts() ) :
    echo '<ul class="post__list">';
    while ( $the_query->have_posts() ) :
      $the_query->the_post();
    ?>
      <li class="post__item">
        <p class="post-img"><?php
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
        <p class="post__day"><?php echo get_the_date(); ?></p>
        <p class="post__ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
      </li>
    <?php endwhile;
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
    pagination( $args );
  endif;
  wp_reset_postdata(); // reset
?>