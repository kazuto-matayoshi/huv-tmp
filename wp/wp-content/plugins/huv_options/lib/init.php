<?php
include_once( plugin_dir_path( __FILE__ ) . 'init_actions.php' );

if ( !class_exists( 'HUV_init_settings' ) ) {
	class HUV_init_settings {

		/* 設定値 */
		private $loginArr = array(
			'dontchange' => '変更しない',
			'change'     => '変更する',
		);

		/*---------*\
		 * 初期処理 *
		\*---------*/
		public function __construct( $parent_slug, $slug ) {
			$this->parent_slug = $parent_slug;
			$this->slug        = $slug;
			$this->option      = get_option( $this->slug );

			/**
			 * 初期設定処理の分岐
			 * @var array
			 * @param get_option()
			 */
			$HUV_init_actions  = new HUV_init_actions( $this->option );


			// メニューの追加をする処理
			add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );

			// 設定ページのHTMLを出力する処理
			add_action( 'admin_init', array( $this, 'setting_views' ) );

			// ページの設定を保存する処理
			add_action( 'admin_init', array( $this, 'setting_save' ) );
		}

		/*-------------------*\
		 * メニューの追加をする処理 *
		\*-------------------*/
		public function add_plugin_menu() {
			/**
			 * @link https://goo.gl/T2Yxsk
			 */
			add_submenu_page(
				// parent slug
				$this->parent_slug,

				// title tag
				__( 'init設定のタイトル' ),

				// menu title
				__( 'init' ),

				// title tag
				'administrator',

				// page slug
				$this->slug,

				// call back
				array( $this, 'create_admin_page' )
			);
		}

		/*------------------------*\
		 * 使用するシェアボタンの表示設定 *
		\*------------------------*/
		public function sns_settings() {
			$loginArr = $this->loginArr;

			echo '<ul>';
			foreach ( $loginArr as $value => $txt ) {
				echo '<li>';

				// nameの[]より前の部分はregister_setting()の$option_nameと同じ名前にします。
				echo '<input',
								' type="radio"',
								' id="custom_login_logo_'.$value.'"',
								' name="'.$this->slug.'[]"',
								' value="'.$value.'"',
								isset( get_option( $this->slug )[0] )
								&& get_option( $this->slug )[0] === $value
								? ' checked' : '',
						 '>';
				echo '<label for="custom_login_logo_'.$value.'">'.$txt.'</label>';
				echo '</li>';
			}
			echo '<input type="text" name="'.$this->slug.'[]" value="'.get_option( $this->slug )[1].'">';
			echo '</ul>';
		}

		public function setting_views() {
			/**
			 * @link https://goo.gl/PWgs2X
			 */
			add_settings_section( $this->slug.'_section_id', '', '', $this->slug );

			/**
			 * @link https://goo.gl/Uf15cK
			 */
			add_settings_field( 'sns', 'ログイン画面のロゴの変更', array( $this, 'sns_settings' ), $this->slug, $this->slug.'_section_id' );
		}

		/*--------------------------*\
		 * 設定ページのHTMLを出力する処理 *
		\*--------------------------*/
		public function create_admin_page() {
			echo '<div class=\"wrap\">';
				echo '<h2>HUV 開発者用設定</h2>';
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

				echo '<form method="post" action="options.php">';

					// 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。
					settings_fields( $this->slug );

					// 入力項目を出力します(設定ページのslugを指定)。
					do_settings_sections( $this->slug );

					// 送信ボタンを出力します。
					submit_button();

				echo '</form>';
			echo '</div>';
			echo '<!-- /.wrap -->';
		}


		/*----------------------*\
		 * ページの設定を保存する処理 *
		\*----------------------*/
		public function setting_save() {
			/**
			 * @link https://goo.gl/5PjtyL
			 */
			register_setting( $this->slug, $this->slug, array( $this, 'save_valid' ) );
		}

		/**
		 * 送信された入力値のサニタイズ化
		 * @param array $input 設定値
		 */
		public function save_valid( $input ) {
			$new_input = array();

			// SNS シェアボタンの保存
			$loginArr = $this->loginArr;

			foreach ( $input as $key => $value ) {
				$new_input[] = stripslashes( $value );
			}

			return $new_input;
		}
	}
}