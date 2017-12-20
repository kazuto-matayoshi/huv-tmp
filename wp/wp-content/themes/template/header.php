<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title(); ?></title>

  <!-- icon -->
  <link rel="shortcut icon" href="<?php echo huv_theme_path; ?>assets/img/common/favicon.ico">

  <!-- IE対策 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"><?php wp_head(); ?>

  <!-- その他設定 -->
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo huv_theme_path; ?>assets/css/normalize.css">
  <link rel="stylesheet" href="<?php echo huv_theme_path; ?>assets/css/common.css">
  
  <?php
    global $post;
    global $post_type;
    global $taxonomy;

    $post_type = !empty( $post_type ) ? $post_type : 'post';

    if ( is_home() || is_front_page() ) {
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/index.css">';
    }

    // archive area
    elseif ( is_post_type_archive( $post_type ) ) {
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/'.$post_type.'.css">';
    }

    // singul area
    elseif ( is_singular( $post_type ) && is_single() ) {
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/'.$post_type.'.css">';
    }

    // taxonomy area
    elseif( is_tax( $taxonomy ) ) {
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/'.$taxonomy.'.css">';
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/404.css">';
    }

    elseif ( is_search() ) {
    }

    elseif ( is_404() ) {
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/404.css">';
    }

    else {
      echo '<link rel="stylesheet" href="'.huv_theme_path.'assets/css/'.get_page_uri( $post->ID ).'.css">';
    }
  ?>
</head>
<body>
<h1 class="meta-h1"></h1>
test
<?php breadcrumb(); ?>