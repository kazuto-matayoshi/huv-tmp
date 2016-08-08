<?php get_header(); ?>
<?php dynamic_sidebar('gnav'); ?>
<?php
	/*
	 * get_new_post( $post_type = 'post', $view_posts = 10 );
	 */
	get_new_post();
?>
<?php get_footer(); ?>