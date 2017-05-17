<?php
/*
Plugin Name: HUVRID Settings
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: WP basic configuration
Version:     1.0.0
Author:      HUVRID Development team
Author URI:  http://huvrid.co.jp/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/
include_once( plugin_dir_path( __FILE__ ) . 'lib/shear_btns.php' );
include_once( plugin_dir_path( __FILE__ ) . 'lib/init.php' );


if ( !class_exists( 'HUV_admin_settings' ) ) {
	class HUV_admin_settings {
		public function __construct( $base_slug ) {
			$this->base_slug = $base_slug;

			// メニューの追加をする処理
			add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );
			add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );

			// 設定ページのHTMLを出力する処理
			// add_action( 'admin_init', array( $this, 'setting_views' ) );

			// // ページの設定を保存する処理
			// add_action( 'admin_init', array( $this, 'setting_save' ) );
		}

		public function add_plugin_menu() {
			/**
			* @link https://goo.gl/OCdspw
			*/
			add_menu_page(
				'HUV Settings',
				'HUV Settings',
				'administrator',
				$this->base_slug,
				function(){},
				'',
				1
			);
		}

		public function add_submenu_page() {
			/**
			* @link https://goo.gl/T2Yxsk
			*/
			add_submenu_page(
				$this->base_slug,
				'テスト設定',
				'テスト設定',
				'administrator',
				$this->base_slug,
				array( $this, 'create_admin_page' )
			);
		}

		public function create_admin_page() {
		}
	}
}




/*----------------*\
 * call functions *
\*----------------*/
if ( is_admin() ) {

	$base_slug = 'huv_admin_settings';
	$HUV_admin_settings = new HUV_admin_settings( $base_slug );

	/**
	 * 初期化処理
	 * @param $base_srug -> base slug;
	 * @param $slug      -> this part slug;
	 */
	$HUV_init_settings  = new HUV_init_settings( $base_slug, 'huv_init_settings' );
	$HUV_sns_settings   = new HUV_sns_settings( $base_slug, 'huv_sns_settings' );

}