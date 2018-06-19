<?php
/*******************************************************************************
Plugin Name: HUV MV Control
Description: メインビジュアルの登録、更新を行います。
Version: 1.0
*/

require 'include/const.php';
require 'include/functions.php';
require 'include/settings.php';
require 'include/options.php';


/*__ js _______________________*/
function MV_Control_scripts( $pagenow ) {
  // var_dump( $pagenow );
  if ( $pagenow === 'toplevel_page_'.MV_Control_prefix.'MV_Control' ) {
    wp_enqueue_script( 'jquery-'.MV_Control_prefix.'MV_Control', '//code.jquery.com/jquery-2.2.4.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'jquery-'.MV_Control_prefix.'MV_Control-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '', true);
    // メディアアップローダー用のスクリプトをロードする
    wp_enqueue_media();

    wp_enqueue_script( 'mv_control', plugins_url().'/mv_control/assets/js/mv_control'.'.js', array('jquery'), '', true);
  }
  if ( $pagenow === 'toplevel_page_'.MV_Control_prefix.'MV_Control_Options' ) {
    wp_enqueue_script( 'jquery-'.MV_Control_prefix.'MV_Control', '//code.jquery.com/jquery-2.2.4.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'MV_Control_Options', plugins_url().'/mv_control/assets/js/mv_control_options'.'.js', array('jquery'), '', true);
  }
}
add_action( 'admin_enqueue_scripts', 'MV_Control_scripts' );


/*__ css _______________________*/
function MV_Control_styles( $pagenow ) {
  // MV_Control_Options
  if ( $pagenow === 'toplevel_page_'.MV_Control_prefix.'MV_Control' ) {
    wp_enqueue_style( 'mv_control', plugins_url().'/mv_control/assets/css/mv_control.css' );
  }

  // MV_Control_Options
  if ( $pagenow === 'toplevel_page_'.MV_Control_prefix.'MV_Control_Options' ) {
    wp_enqueue_style( 'MV_Control_Options', plugins_url().'/mv_control/assets/css/mv_control_options.css' );
  }
}
add_action( 'admin_enqueue_scripts', 'MV_Control_styles' );


// 管理画面を表示している場合のみ実行します。
if ( is_admin() ) {
  $mv_control__settings = new mv_control__settings();
  $mv_control__options  = new mv_control__options();
}
