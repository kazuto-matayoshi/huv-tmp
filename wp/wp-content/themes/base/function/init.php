<?php

/**
 * - 管理画面に関する初期関数群 -
 *
 * 01.0 - ログイン画面
 *   01.1 - ロゴを変更する
 *   01.2 - ロゴのリンク先を変更する
 *   01.3 - ロゴのtitle属性を変更する
 * 02.0 - ログイン後に投稿のページヘリダイレクトさせる
 * 03.0 - フッターWordPressリンクを非表示にする設定
 * 04.0 - 管理バーのサイトリンクを別ウインドウで開く
 * 05.0 - メニューの非表示関係
 *   05.1 - 管理バーの項目を非表示にする設定
 *   05.2 - メニューバーの表示に関する設定
 *   05.3 - 投稿画面 / カテゴリーのタブを非表示
 *   05.4 - 投稿画面 / 項目を非表示にする
 * 06.0 - 投稿画面のパーマリンク編集部分を非表示
 * 07.0 - APIによるバージョンチェックの通信をさせない
 * 08.0 - 自動更新の停止
 * 09.0 - バージョン更新を非表示にする
 * 10.0 - サイト側の管理バーを非表示
 * 11.0 - アイキャッチ画像の設定
 *
 *
 * - カスタマイズ -
 *
 * カスタム投稿タイプを追加
 * カスタム投稿タイプの公開時に自動で投稿IDをスラッグに変更する。
 *
 */

//---------------------------------
/*
 * 01.0 - ログイン画面
 */
//---------------------------------

/*
 * 01.1 - ロゴを変更する
 */
function custom_login_logo() {
	echo '<style type="text/css">h1 a { width: auto !important; background: url(' . get_template_directory_uri() . '/login.png) no-repeat !important; background-size: contain !important; background-position: center !important; }</style>';
}
add_action( 'login_head', 'custom_login_logo' );

/*
 * 01.2 - ロゴのリンク先を変更する
 */
function login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'login_logo_url' );

/*
 * 01.3 - ロゴのtitle属性を変更する
 */
function login_logo_title(){
	return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'login_logo_title' );


/*
 * 02.0 - ログイン後に投稿のページヘリダイレクトさせる
 */
function redirect_dashiboard() {
	// ダッシュボード／管理画面チェック
	if( is_admin() ) {
		// ダッシュボードチェック
		if ( preg_match('/(\/wp-admin\/index.php)/', $_SERVER['SCRIPT_NAME']) ) {
			// リダイレクトアドレス作成
			$redirect_url = str_replace($_SERVER['SCRIPT_NAME'], "index.php", "edit.php");
			// リダイレクト
			wp_redirect( $redirect_url );
		};
	};
}
// 管理者ではない場合実行
if ( !current_user_can( 'level_10' ) ) {
	add_action( 'init', 'redirect_dashiboard' );
};


/*
 * 03.0 - フッターWordPressリンクを非表示にする設定
 */
function custom_admin_footer() {
	echo '';
}
add_filter( 'admin_footer_text', 'custom_admin_footer' );


/*
 * 04.0 - 管理バーのサイトリンクを別ウインドウで開く
 */
function site_target_blank( $wp_admin_bar ) {
	$wp_admin_bar -> add_menu(
		array(
			'id'     => 'site-name',
			'meta'   => array( 'target' => '_blank' ),
		)
	);
}
add_action( 'admin_bar_menu', 'site_target_blank', 100 );


//---------------------------------
/*
 * 05.0 - メニューの非表示関係
 */
//---------------------------------

/*
 * 05.1 - 管理バーの項目を非表示にする設定
 */
function remove_admin_bar_menu( $wp_admin_bar ) {
	// WordPressシンボルマーク
	$wp_admin_bar->remove_menu( 'wp-logo' );
	// コメント
	$wp_admin_bar->remove_menu( 'comments' );
	// 『新規 -> 投稿ページ』の削除
	// $wp_admin_bar->remove_menu( 'new-post' );

	// 管理者ではない場合実行
	if ( !current_user_can( 'level_10' ) ) {
		// 『新規 -> 固定ページ』の削除
		$wp_admin_bar->remove_menu( 'new-page' );
	};
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 201 );

/*
 * 05.2 - メニューバーの表示に関する設定
 */
function remove_menus () {
	global $menu;
	// 投稿
	// unset( $menu[5] );
	// コメント
	unset( $menu[25] );

	// 管理者ではない場合実行
	if ( !current_user_can( 'level_10' ) ) {
		// ダッシュボード
		unset( $menu[2] );
		// ページ
		unset( $menu[20] );
		// ツール
		unset( $menu[75] );
		// メニューのカテゴリーの削除
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
		// メニューのタグの削除
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	};
}
add_action('admin_menu', 'remove_menus');

/*
 * 05.3 - 投稿画面 / カテゴリーのタブを非表示
 */
function hide_category_tabs_adder() {
	global $pagenow;
	global $post_type;
	if ( is_admin() && ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) ) {
		echo "<style type=\"text/css\">\n
		#category-tabs, #category-adder {display:none;}
		.categorydiv .tabs-panel {padding: 0 !important; background: none; border: none !important;}
		</style>\n";
	};
}
if ( !current_user_can( 'level_10' ) ) { // 管理者ではない場合
	add_action( 'admin_head', 'hide_category_tabs_adder' );
};

/*
 * 05.4 - 投稿画面 / 項目を非表示にする
 */
function remove_default_post_screen_metaboxes() {
	// remove_meta_box( 'slugdiv','post','normal' );            // スラッグ
	// remove_meta_box( 'postcustom','post','normal' );         // カスタムフィールド
	remove_meta_box( 'commentsdiv','post','normal' );        // コメント
	// remove_meta_box( 'postexcerpt','post','normal' );        // 抜粋
	// remove_meta_box( 'trackbacksdiv','post','normal' );      // トラックバック
	// remove_meta_box( 'commentstatusdiv','post','normal' );   // ディスカッション
	// remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'side' ); // 投稿のタグ
}

add_action('admin_menu','remove_default_post_screen_metaboxes');

function remove_post_supports() {
	// remove_post_type_support( 'post', 'title' );           // タイトル
	// remove_post_type_support( 'post', 'editor' );          // 本文欄
	// remove_post_type_support( 'post', 'author' );          // 作成者
	// remove_post_type_support( 'post', 'thumbnail' );       // アイキャッチ
	// remove_post_type_support( 'post', 'excerpt' );         // 抜粋
	// remove_post_type_support( 'post', 'trackbacks' );      // トラックバック
	// remove_post_type_support( 'post', 'custom-fields' );   // カスタムフィールド
	// remove_post_type_support( 'post', 'comments' );        // コメント
	// remove_post_type_support( 'post', 'revisions' );       // リビジョン
	// remove_post_type_support( 'post', 'page-attributes' ); // ページ属性
	// remove_post_type_support( 'post', 'post-formats' );    // 投稿フォーマット

	// unregister_taxonomy_for_object_type( 'category', 'post' ); // カテゴリ
	// unregister_taxonomy_for_object_type( 'post_tag', 'post' ); // タグ
}
add_action( 'init', 'remove_post_supports' );
/*
 * 06.0 - 投稿画面のパーマリンク編集部分を非表示
 */
// add_filter( 'get_sample_permalink_html', '__return_false' );

/*
 * 07.0 - APIによるバージョンチェックの通信をさせない
 */
remove_action('wp_version_check', 'wp_version_check');
remove_action('admin_init', '_maybe_update_core');

/*
 * 08.0 - 自動更新の停止
 */
add_filter( 'automatic_updater_disabled', '__return_true' );

/*
 * 09.0 - バージョン更新を非表示にする
 */
add_filter('pre_site_transient_update_core', '__return_zero');

/*
 * 10.0 - サイト側の管理バーを非表示
 */
add_filter('show_admin_bar', '__return_false');

/**
 * 11.0 - アイキャッチ画像の設定
 */
add_theme_support( 'post-thumbnails' );


