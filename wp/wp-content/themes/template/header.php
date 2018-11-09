<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title(); ?></title>

  <!-- icon -->
  <link rel="shortcut icon" href="<?php echo huv_url_theme; ?>assets/img/common/favicon.ico">

  <!-- IE対策 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"><?php wp_head(); ?>

  <!-- その他設定 -->
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <link rel="stylesheet" href="<?php echo huv_url_theme; ?>assets/css/normalize.css">
  <link rel="stylesheet" href="<?php echo huv_url_theme; ?>assets/css/common.css">
  
  <?php
    global $post;
    global $post_type;
    global $taxonomy;

    $post_type = !empty( $post_type ) ? $post_type : 'post';

    if ( is_home() || is_front_page() ) {
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/index.css">';
    }

    // archive area
    elseif ( is_post_type_archive( $post_type ) ) {
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/'.$post_type.'.css">';
    }

    // singul area
    elseif ( is_singular( $post_type ) && is_single() ) {
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/'.$post_type.'.css">';
    }

    // taxonomy area
    elseif( is_tax( $taxonomy ) ) {
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/'.$taxonomy.'.css">';
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/404.css">';
    }

    elseif ( is_search() ) {
    }

    elseif ( is_404() ) {
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/404.css">';
    }

    else {
      echo '<link rel="stylesheet" href="'.huv_url_theme.'assets/css/'.get_page_uri( $post->ID ).'.css">';
    }
  ?>
</head>
<body>
<h1 class=""></h1>
<!-- <nav>
  <?php
    // 開発中ナビゲーション
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
</nav> -->







<div id="barba-wrapper" aria-live="polite">
<div class="barba-container">
<?php breadcrumb(); ?>