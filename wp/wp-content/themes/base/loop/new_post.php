<li>
	<p class="post-img"><?php
		if ( empty(get_the_post_thumbnail()) ) {
			echo'<img src="/img/no-image.jpg" alt="no-image">';
		} else {
			echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); 
		}
	?></p>
	<p class="post-day"><?php echo get_the_date(); ?></p>
	<p class="post-ttl"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
</li>