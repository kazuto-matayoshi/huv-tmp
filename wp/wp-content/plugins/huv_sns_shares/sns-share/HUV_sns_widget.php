<?php
/**
 * - ウィジェットの追加 -
 */
require( dirname( __FILE__ ) . '/widgets/HUV_sns_shares.php' );

add_action( 'widgets_init', function () {
  register_widget( 'HUV_sns_shares' );
});