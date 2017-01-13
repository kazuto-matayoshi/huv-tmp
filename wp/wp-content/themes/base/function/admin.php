<?php
// class TimeOptionSetting {

// 	/** 設定値 */
// 	private $options;

// 	/**
// 	 * 初期化処理です。
// 	 */
// 	public function __construct() {
// 		// メニューを追加します。 -> add_action( 'admin_menu', function);
// 		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );

// 		// ページの初期化を行います。
// 		// 管理画面にいる際の処理 -> add_action( 'admin_init', function);
// 		add_action( 'admin_init', array( $this, 'page_init' ) );
// 	}

// 	/**
// 	 * メニューをメニューバーに追加します。
// 	 */
// 	public function add_plugin_page() {
// 		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
// 		//   $page_title: 設定ページの<title>部分
// 		//   $menu_title: メニュー名
// 		//   $capability: 権限 ( 'manage_options' や 'administrator' や 0(level) など)
// 		//   $menu_slug : メニューのslug
// 		//   $function  : 設定ページの出力を行う関数
// 		//   $icon_url  : メニューに表示するアイコン
// 		//   $position  : メニューの位置 ( 1 や 99 など )
// 		add_menu_page( '開館時間設定', '開館時間設定', 0, 'time_config', array( $this, 'create_admin_page' ), '', 1 );

// 		// 設定のサブメニューとしてメニューを追加する場合は下記のような形にします。
// 		// add_options_page( 'テスト設定', 'テスト設定', 'manage_options', 'time_config', array( $this, 'create_admin_page' ) );
// 	}

// 	/**
// 	 * 設定ページの初期化を行います。
// 	 */
// 	public function page_init() {

// 		// 設定を登録します(入力値チェック用)。
// 		// register_setting( $option_group, $option_name, $sanitize_callback )
// 		//   $option_group      : 設定のグループ名
// 		//   $option_name       : DBに登録する名前
// 		//   $sanitize_callback : オプションの値をサニタイズするためのコールバック関数
// 		register_setting( 'time_config', 'time_config', array( $this, 'sanitize' ) );

// 		// 入力項目のセクションを追加します。
// 		// add_settings_section( $id, $title, $callback, $page )
// 		//   $id       : セクションのID
// 		//   $title    : セクション名
// 		//   $callback : セクションの説明などを出力するための関数
// 		//   $page     : 項目を表示させるページ。 (add_menu_page()の$menu_slugと同じものにしないと設定しだいでは他のページでも表示される)
// 		add_settings_section( 'time_config_section_id', '', '', 'time_config' );

// 		// 入力項目のセクションに項目を追加します。
// 		// add_settings_field( $id, $title, $callback, $page, $section, $args )
// 		//   $id       : 入力項目のID
// 		//   $title    : 入力項目名
// 		//   $callback : 入力項目のHTMLを出力する関数
// 		//   $page     : 項目を表示させるページ。 (add_menu_page()の$menu_slugと同じものにしないと設定しだいでは他のページでも表示される)
// 		//   $section  : セクションのID (add_settings_section()の$idと紐づいてる為、同じものにする)
// 		//   $args     : $callbackの追加引数 (必要な場合のみ指定)
// 		add_settings_field( 'time', '時間', array( $this, 'time_callback' ), 'time_config', 'time_config_section_id' );
// 		add_settings_field( 'text', 'テキスト', array( $this, 'text_callback' ), 'time_config', 'time_config_section_id' );
// 	}

// 	/**
// 	 * 送信された入力値の保存
// 	 *
// 	 * @param array $input 設定値
// 	 */

// 	/**
// 	 * β版
// 	 */
// 	public function sanitize( $input ) {
// 		// データベーステーブル"options"から名前を指定してオプションの値を取得する
// 		$this->options = get_option( 'time_config' );

// 		$new_input = array();

// 		// メッセージがある場合、、、
// 		if ( ( isset( $input['time'] ) && trim( $input['time'] ) !== '' ) && ( isset( $input['text'] ) && trim( $input['text'] ) !== '' ) ) {
// 			// 値をサニタイジングしてDBに保存
// 			$new_input['time'] = sanitize_text_field( $input['time'] );
// 			$new_input['text'] = sanitize_text_field( $input['text'] );
// 		}

// 		// 時間が設定されているがテキストは空の場合、、、
// 		elseif ( isset( $input['time'] ) && trim( $input['time'] ) !== '' ) {
// 			// エラーを出力
// 			add_settings_error( 'time_config', 'message', 'テキストを設定して下さい。' );

// 			// 値をサニタイジングしてDBに保存
// 			$new_input['time'] = sanitize_text_field( $input['time'] );

// 			// input内の値をDBに登録している値へ戻します。
// 			$new_input['text'] = isset( $this->options['text'] ) ? $this->options['text'] : '';
// 		}

// 		// テキストが設定されているが時間は空の場合、、、
// 		elseif ( isset( $input['text'] ) && trim( $input['text'] ) !== '' ) {
// 			// エラーを出力
// 			add_settings_error( 'time_config', 'message', '時間を設定して下さい。' );

// 			// 値をサニタイジングしてDBに保存
// 			$new_input['text'] = sanitize_text_field( $input['text'] );

// 			// input内の値をDBに登録している値へ戻します。
// 			$new_input['time'] = isset( $this->options['time'] ) ? $this->options['time'] : '';
// 		}

// 		// メッセージがない場合エラーを出力
// 		else {
// 			// add_settings_error( $setting, $code, $message, $type )
// 			//   $setting : 設定のslug
// 			//   $code    : エラーコードのslug (HTMLで'setting-error-{$code}'のような形でidが設定されます)
// 			//   $message : エラーメッセージの内容
// 			//   $type    : メッセージのタイプ。'updated' (成功) か 'error' (エラー) のどちらか
// 			add_settings_error( 'time_config', 'message', '時間を設定して下さい。' );
// 			add_settings_error( 'time_config', 'message', 'テキストを設定して下さい。' );

// 			// input内の値をDBに登録している値へ戻します。
// 			$new_input['time'] = isset( $this->options['time'] ) ? $this->options['time'] : '';
// 			$new_input['text'] = isset( $this->options['text'] ) ? $this->options['text'] : '';
// 		}

// 		// radioの処理
// 		if( isset( $input['check'] ) ){
// 			// '(シングルクォーテーション)や"(ダブルクォーテーション)や\(バックスラッシュ)のエスケープ回避して保存
// 			$new_input['check'] = stripslashes( $input['check'] );
// 		} else {
// 			// 念のため
// 			add_settings_error( 'check', 'message', '選択してください。' );
// 		}

// 		return $new_input;
// 	}

// 	/**
// 	 * 設定ページのHTMLを出力します。
// 	 */
// 	public function create_admin_page() {
// 		// データベーステーブル"options"から名前を指定してオプションの値を取得する
// 		$this->options = get_option( 'time_config' );

// 		echo "<div class=\"wrap\">\n";
// 			echo "<h2>開館時間設定</h2>\n";
// 			// add_options_page()で設定のサブメニューとして追加している場合は
// 			// 問題ありませんが、add_menu_page()で追加している場合
// 			// options-head.phpが読み込まれずメッセージが出ない(※)ため
// 			// メッセージが出るようにします。
// 			// ※ add_menu_page()の場合親ファイルがoptions-general.phpではない
// 			global $parent_file;
// 			if ( $parent_file != 'options-general.php' ) {
// 				require(ABSPATH . 'wp-admin/options-head.php');
// 			}
// 			echo "<form method=\"post\" action=\"options.php\">\n";
// 				// 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。
// 				settings_fields( 'time_config' );
// 				// 入力項目を出力します(設定ページのslugを指定)。
// 				do_settings_sections( 'time_config' );
// 				// 送信ボタンを出力します。
// 				submit_button();
// 			echo "</form>\n";
// 		echo "</div>\n";
// 		echo "<!-- /.wrap -->\n";
// 	}

// 	/**
// 	 * 入力項目(「時間」)のHTMLを出力します。
// 	 */
// 	public function time_callback() {
// 		// 値を取得
// 		$time = isset( $this->options['time'] ) ? $this->options['time'] : '';

// 		// nameの[]より前の部分はregister_setting()の$option_nameと同じ名前にします。
// 		if ( get_option( 'time_config' )['check'] == "0" ) {
// 			echo '<input type="radio" id="check" name="time_config[check]" value="0" checked>';
// 		} else {
// 			echo '<input type="radio" id="check" name="time_config[check]" value="0">';
// 		}
// 		echo '<input type="text" id="time" name="time_config[time]" value="'. esc_attr( $time ) .'">';
// 	}

// 	/**
// 	 * 入力項目(「テキスト」)のHTMLを出力します。
// 	 */
// 	public function text_callback() {
// 		// 値を取得
// 		$text = isset( $this->options['text'] ) ? $this->options['text'] : '';

// 		// nameの[]より前の部分はregister_setting()の$option_nameと同じ名前にします。
// 		if ( get_option( 'time_config' )['check'] == "1" ) {
// 			echo '<input type="radio" id="check" name="time_config[check]" value="1" checked>';
// 		} else {
// 			echo '<input type="radio" id="check" name="time_config[check]" value="1">';
// 		}
// 		echo '<input type="text" id="text" name="time_config[text]" value="'. esc_attr( $text ) .'">';
// 	}
// }

// // 管理画面を表示している場合のみ実行します。
// if( is_admin() ) {
// 	$Time_Option_Setting = new TimeOptionSetting();
// }


// // Time_Option_Settingのデータ取得
// function get_my_time_options () {
// 	if ( get_option( 'time_config' )['check'] == "0" ) {
// 		echo get_option( 'time_config' )['time'];
// 	} else if ( get_option( 'time_config' )['check'] == "1" ) {
// 		echo get_option( 'time_config' )['text'];
// 	}
// }
// // value="1" <?php checked('1', get_option('users_can_register'));

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
		add_menu_page( 'HUV Settings', 'HUV Settings', 'administrator', 'huv_addmin_config', array( $this, 'create_admin_page' ), '', 1 );

		// 設定のサブメニューとしてメニューを追加する場合は下記のような形にします。
		// add_options_page( 'テスト設定', 'テスト設定', 'manage_options', 'huv_addmin_config', array( $this, 'create_admin_page' ) );
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
			if ( get_option( 'huv_addmin_config' )[$value] == "" ) {
				echo '<input type="checkbox" id="sns_check_'.$value.'" name="huv_addmin_config['.$value.']" value="'.$value.'">';
			} else {
				echo '<input type="checkbox" id="sns_check_'.$value.'" name="huv_addmin_config['.$value.']" value="'.$value.'" checked>';
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
		add_settings_section( 'huv_addmin_config_section_id', '', '', 'huv_addmin_config' );

		// 入力項目のセクションに項目を追加します。
		// add_settings_field( $id, $title, $callback, $page, $section, $args )
		//   $id       : 入力項目のID
		//   $title    : 入力項目名
		//   $callback : 入力項目のHTMLを出力する関数
		//   $page     : 項目を表示させるページ。 (add_menu_page()の$menu_slugと同じものにしないと設定しだいでは他のページでも表示される)
		//   $section  : セクションのID (add_settings_section()の$idと紐づいてる為、同じものにする)
		//   $args     : $callbackの追加引数 (必要な場合のみ指定)
		add_settings_field( 'sns', '使用するシェアボタン', array( $this, 'sns_settings' ), 'huv_addmin_config', 'huv_addmin_config_section_id' );
	}

	/**
	 * 設定ページのHTMLを出力する処理
	 */
	public function create_admin_page() {
		// データベーステーブル"options"から名前を指定してオプションの値を取得する
		$this->options = get_option( 'huv_addmin_config' );

		echo "<div class=\"wrap\">\n";
			echo "<h2>HUV 開発者用設定</h2>\n";
			/* *
			 * add_options_page()で設定のサブメニューとして追加している場合は問題ありませんが、
			 * add_menu_page()で追加している場合
			 * options-head.phpが読み込まれずメッセージが出ないため(※)
			 * メッセージが出るようにします。
			 * (※) add_menu_page()の場合親ファイルがoptions-general.phpではない
			 */
			global $parent_file;
			if ( $parent_file != 'options-general.php' ) {
				require( ABSPATH . 'wp-admin/options-head.php' );
			}
			echo "<form method=\"post\" action=\"options.php\">\n";
				// 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。
				settings_fields( 'huv_addmin_config' );
				// 入力項目を出力します(設定ページのslugを指定)。
				do_settings_sections( 'huv_addmin_config' );
				// 送信ボタンを出力します。
				submit_button();
			echo "</form>\n";
		echo "</div>\n";
		echo "<!-- /.wrap -->\n";
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
		register_setting( 'huv_addmin_config', 'huv_addmin_config', array( $this, 'save_valid' ) );
	}

	/**
	 * 送信された入力値のサニタイズ化
	 * @param array $input 設定値
	 */
	public function save_valid( $input ) {
		$this->options = get_option( 'huv_addmin_config' );
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
	$Time_Option_Setting = new HUV_admin_settings();
}

?>