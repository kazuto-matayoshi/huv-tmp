<?php
if ( have_posts() ) :
while ( have_posts() ) :
	the_post();
	the_content();
endwhile;
endif;
/*
 * get_new_post( $post_type = 'post', $view_posts = 10 );
 */
get_new_post();
?>