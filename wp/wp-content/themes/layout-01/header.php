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
		<meta name="viewport" content="width=device-width">

		<!-- CSS -->
		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/common.css">
		<?php
			if ( is_home() || is_front_page() ) {
				echo "<link rel=\"stylesheet\" href=\"/css/index.css\">\n";
			} elseif ( is_single() ) {
			} elseif ( is_search() ) {
			} elseif ( is_archive() || is_404() ) {
			} else {
				echo "<link rel=\"stylesheet\" href=\"/css/".get_page_uri($post->ID).".css\">\n";
			}
		?>
	</head>
<body>
<header class="header">
	<h1>h1 tag</h1>
	<section class="mv">
		<h2>site main title</h2>
	</section>
	<nav class="gnav">
		<ul class="gnav-list">
			<li class="gnav-item">
				<a href="/">トップ</a>
			</li>
			<li class="gnav-item">
				<a href="/">menu1</a>
			</li>
			<li class="gnav-item">
				<a href="/">menu2</a>
			</li>
			<li class="gnav-item">
				<a href="/">menu3</a>
			</li>
			<li class="gnav-item">
				<a href="/">menu4</a>
			</li>
		</ul>
	</nav>
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
				'items_wrap'      => '<ul class="">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			wp_nav_menu( $args );
		?>
	</nav>
</header>
<main class="main">