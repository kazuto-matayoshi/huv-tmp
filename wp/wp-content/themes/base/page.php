<?php
	get_header();

	get_template_part( get_page_uri($post->ID) );

	get_footer();
?>
