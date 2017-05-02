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


if ( !class_exists( 'HUV_admin_settings' ) ) {
	class HUV_admin_settings {
		private $base_slug = 'huv_admin_settings';

		public function __construct() {
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

			$HUV_sns_settings = new HUV_sns_settings();
			add_submenu_page(
				$this->base_slug,
				'テスト設定2',
				$HUV_sns_settings->test( '$a' ),
				'administrator',
				// 'admin.php?page=menu_slug',
				'menu_slug',
				array( $this, 'create_admin_page' )
				// $HUV_sns_settings->create_admin_page( 'huv_admin_settings' )
			);
		}

		public function create_admin_page() {
			// // データベーステーブル"options"から名前を指定してオプションの値を取得する
			// options = get_option( 'huv_admin_config' );

			// echo "<div class=\"wrap\">\n";
			// 	echo "<h2>HUV 開発者用設定</h2>\n";
			// 	/* *
			// 	 * add_options_page()で設定のサブメニューとして追加している場合は問題ありませんが、
			// 	 * add_menu_page()で追加している場合
			// 	 * options-head.phpが読み込まれずメッセージが出ないため(※)
			// 	 * メッセージが出るようにします。
			// 	 * (※) add_menu_page()の場合親ファイルがoptions-general.phpではない
			// 	 */
			// 	global $parent_file;
			// 	if ( $parent_file != 'options-general.php' ) {
			// 		require( ABSPATH . 'wp-admin/options-head.php' );
			// 	}
			// 	echo "<form method=\"post\" action=\"options.php\">\n";
			// 		// 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。
			// 		settings_fields( 'huv_admin_config' );
			// 		// 入力項目を出力します(設定ページのslugを指定)。
			// 		do_settings_sections( 'huv_admin_config' );
			// 		// 送信ボタンを出力します。
			// 		submit_button();
			// 	echo "</form>\n";
			// echo "</div>\n";
			// echo "<!-- /.wrap -->\n";
		}
	}
}

// 管理画面を表示している場合のみ実行します。
if( is_admin() ) {
	$HUV_admin_settings = new HUV_admin_settings();
}
