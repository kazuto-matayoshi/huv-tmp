<?php
	/**
	 * get_new_post( $args );
	 */
	$args = array(
		'class'      => 'info-list',
		'post_type'  => 'post',
		'view_posts' => 4,
		'pagination' => false,
		'eye' => true,
	);
	huv_get_new_post( $args );
?>