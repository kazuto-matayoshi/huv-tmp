<?php
/**
 * - ウィジェットの追加 -
 */
require( dirname( __FILE__ ) . '/widgets/HUV_pv_archives.php' );

add_action( 'widgets_init', function () {
  register_widget( 'HUV_pv_archives' );
});