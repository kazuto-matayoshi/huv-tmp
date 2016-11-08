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
	// 	$year = $option['post_type'] == 'post' ? split('[/]', $_SERVER['REQUEST_URI'])[1] : split('[/]', $_SERVER['REQUEST_URI'])[2];
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
		echo '<ul class="post-list">';
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
		?>
			<li class="post-list-item">
				<p class="post-img"><?php
					// アイキャッチ
					if ( has_post_thumbnail() ) {
						echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); 
					} else {
						echo'<img src="/img/no-image.jpg" alt="no-image">';
					}
				?></p>
				<p class="post-day"><?php the_date(); ?></p>
				<p class="post-ttl"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
			</li>
		<?php endwhile;
		echo '</ul>';

		// ページネーション
		pagination($the_query->max_num_pages);
	endif;
	wp_reset_postdata(); // reset
?>