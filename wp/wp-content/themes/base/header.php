<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>

	<!-- icon -->
	<link rel="shortcut icon" href="/img/favicon.ico">

	<!-- IE対策 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><?php wp_head(); ?>


	<!-- その他設定 -->
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/common.css">
	
	<?php
		if ( is_home() || is_front_page() ) {
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/index.css">';
		} elseif ( is_singular() ) {
		} elseif ( is_search() ) {
		} elseif ( is_archive() ) {
		} elseif ( is_404() ) {
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/404.css">';
		} else {
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/'.get_page_uri($post->ID).'.css">';
		}
	?>
</head>
<body>
<h1></h1>
<nav>
	<?php
		$args = array(
			'theme_location'  => '',
			'menu'            => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'container'       => '',
			'container_class' => '',
			'container_id'    => '',
			'echo'            => true,
			'fallback_cb'     => '',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul class="a">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
		wp_nav_menu( $args );
	?>
</nav>

<?php breadcrumb(); ?>