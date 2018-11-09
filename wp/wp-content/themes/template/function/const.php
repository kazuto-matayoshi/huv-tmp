<?php
// rootの絶対URL
define( 'huv_url_root', esc_url( get_home_url().'/' ) );

// テーマまでの絶対URL
define( 'huv_url_theme', esc_url( get_template_directory_uri().'/' ) );

// テーマまでのサーバーパス
define( 'huv_dir_theme', esc_url( get_template_directory().'/' ) );