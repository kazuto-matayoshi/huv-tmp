<?php get_header(); ?>
<?php
breadcrumb();
if ( have_posts() ) :
while ( have_posts() ) :
	the_post();
	the_content();
endwhile;
endif;
?>
<?php get_footer(); ?>