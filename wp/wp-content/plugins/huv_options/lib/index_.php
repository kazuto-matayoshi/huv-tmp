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

include_once( plugin_dir_path( __FILE__ ) . 'init.php' );
include_once( plugin_dir_path( __FILE__ ) . 'cleanup.php' );
include_once( plugin_dir_path( __FILE__ ) . 'shear_btns.php' );

class HUV_admin_settings {

	/** 設定値 */
	private $options;
	private $snsarr = array(
		'Google+1',
		'Twitter',
		'Facebook(like)',
		'Facebook(share)',
		'Pocket',
		'feedly',
		'はてなブックマーク',
		'Evernote',
		'Tumblr',
		'LINE',
	);

	/**
	 * 初期化処理です。
	 */
	public function __construct() {
		// メニューの追加をする処理
		add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );

		// 設定ページのHTMLを出力する処理
		add_action( 'admin_init', array( $this, 'setting_views' ) );

		// ページの設定を保存する処理
		add_action( 'admin_init', array( $this, 'setting_save' ) );
	}

	/**
	 * メニューの追加をする処理
	 */
	public function add_plugin_menu() {
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		//   $page_title: 設定ページの<title>部分
		//   $menu_title: メニュー名
		//   $capability: 権限 ( 'manage_options' や 'administrator' など )
		//   $menu_slug : メニューのslug
		//   $function  : 設定ページの出力を行う関数
		//   $icon_url  : メニューに表示するアイコン
		//   $position  : メニューの位置 ( 1 や 99 など )
		add_menu_page(
			'HUV Settings',
			'HUV Settings',
			'administrator',
			'huv_admin_config',
			array( $this, 'create_admin_page' ),
			// array( $this, 'create_admin_page' ),
			'',
			1
		);

		// // 設定のサブメニューとしてメニューを追加する場合は下記のような形にします。
		// add_options_page(
		// 	'テスト設定',
		// 	'テスト設定',
		// 	'manage_options',
		// 	'huv_admin_config',
		// 	array( $this, 'create_admin_page' )
		// );

		// // huv_admin_configのサブメニューとしてメニューを追加する場合は下記のような形にします。
		// add_submenu_page(
		// 	'huv_admin_config',
		// 	'テスト設定',
		// 	'テスト設定',
		// 	'manage_options',
		// 	'huv_admin_subconfig',
		// 	array( $this, 'create_admin_page' )
		// );
	}

	/**
	 * 使用するシェアボタンの表示設定
	 */
	public function sns_settings() {
		// 値を取得
		$sns    = isset( $this->options['sns'] ) ? $this->options['sns'] : '';
		$snsarr = $this->snsarr;

		echo '<ul>';
		foreach ($snsarr as $key => $value) {
			echo '<li>';
			// nameの[]より前の部分はregister_setting()の$option_nameと同じ名前にします。
			if ( get_option( 'huv_admin_config' )[$value] == "" ) {
				echo '<input type="checkbox" id="sns_check_'.$value.'" name="huv_admin_config['.$value.']" value="'.$value.'">';
			} else {
				echo '<input type="checkbox" id="sns_check_'.$value.'" name="huv_admin_config['.$value.']" value="'.$value.'" checked>';
			}
			echo '<label for="sns_check_'.$value.'">'.$value.'</label>';
			echo '</li>';
		}
		echo '</ul>';
	}

	public function setting_views() {
		// 入力項目のセクションを追加します。
		// add_settings_section( $id, $title, $callback, $page )
		//   $id       : セクションのID
		//   $title    : セクション名
		//   $callback : セクションの説明などを出力するための関数
		//   $page     : 項目を表示させるページ。 (add_menu_page()の$menu_slugと同じものにしないと設定しだいでは他のページでも表示される)
		add_settings_section( 'huv_admin_config_section_id', '', '', 'huv_admin_config' );

		// 入力項目のセクションに項目を追加します。
		// add_settings_field( $id, $title, $callback, $page, $section, $args )
		//   $id       : 入力項目のID
		//   $title    : 入力項目名
		//   $callback : 入力項目のHTMLを出力する関数
		//   $page     : 項目を表示させるページ。 (add_menu_page()の$menu_slugと同じものにしないと設定しだいでは他のページでも表示される)
		//   $section  : セクションのID (add_settings_section()の$idと紐づいてる為、同じものにする)
		//   $args     : $callbackの追加引数 (必要な場合のみ指定)
		add_settings_field( 'sns', '使用するシェアボタン', array( $this, 'sns_settings' ), 'huv_admin_config', 'huv_admin_config_section_id' );
	}

	/**
	 * 設定ページのHTMLを出力する処理
	 */
	public function create_admin_page() {
		// // データベーステーブル"options"から名前を指定してオプションの値を取得する
		// $this->options = get_option( 'huv_admin_config' );

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


	/**
	 * ページの設定を保存する処理
	 */
	public function setting_save() {
		// 設定を登録します(入力値チェック用)。
		// register_setting( $option_group, $option_name, $sanitize_callback )
		//   $option_group      : 設定のグループ名
		//   $option_name       : DBに登録する名前
		//   $sanitize_callback : オプションの値をサニタイズするためのコールバック関数
		register_setting( 'huv_admin_config', 'huv_admin_config', array( $this, 'save_valid' ) );
	}

	/**
	 * 送信された入力値のサニタイズ化
	 * @param array $input 設定値
	 */
	public function save_valid( $input ) {
		$this->options = get_option( 'huv_admin_config' );
		$new_input = array();

		// SNS シェアボタンの保存
		$snsarr = $this->snsarr;
		foreach ($snsarr as $key => $value) {
			$new_input[$value] = stripslashes( $input[$value] );
		}

		return $new_input;
	}
}

// 管理画面を表示している場合のみ実行します。
if( is_admin() ) {
	$HUV_admin_settings = new HUV_admin_settings();
}
