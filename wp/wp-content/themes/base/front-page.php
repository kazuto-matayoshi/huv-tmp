<?php get_header(); ?>
<?php dynamic_sidebar('gnav'); ?>
<?php
	/**
	 * get_new_post( $args );
	 */
	$args = array(
		'class'      => 'info-list',
		'post_type'  => 'post',
		'view_posts' => 4,
		'pagination' => false,
	);
	get_new_post( $args );
?>
<?php get_footer(); ?>