<?php

/**
 * - カスタムメニューのIDやクラスを簡略化 -
 */

add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}


/**
 * - いらないデフォルトウィジェットを消す -
 */

function unregister_widgets(){
	// RSS/Atom フィード
	unregister_widget('WP_Widget_RSS');

	// メタ情報(login/outなど)
	unregister_widget('WP_Widget_Meta');

	// 任意のテキストやHTMLを挿入するウィジェット
	// unregister_widget('WP_Widget_Text');

	// 固定ページ一覧用のウィジェット
	unregister_widget('WP_Widget_Pages');

	// リンク集
	unregister_widget('WP_Widget_Links');

	// サイト内検索フォーム
	unregister_widget('WP_Widget_Search');

	// カスタムメニュー
	unregister_widget('WP_Nav_Menu_Widget');

	// 投稿の月別アーカイブ
	unregister_widget('WP_Widget_Archives');

	// カレンダー
	unregister_widget('WP_Widget_Calendar');

	// タグクラウド
	unregister_widget('WP_Widget_Tag_Cloud');

	// カテゴリーリスト
	unregister_widget('WP_Widget_Categories');

	// 最近の投稿
	unregister_widget('WP_Widget_Recent_Posts');

	// 最近のコメント
	unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init', 'unregister_widgets');


/**
 * - ウィジェット管理画面右側のボックス -
 */
add_action( 'widgets_init', function () {

register_sidebar( array(  //「サイドバー」を登録する
	'name'          => 'グローバルナビゲーション',
	'id'            => 'gnav',
	'description'   => 'グローバルナビゲーションの追加',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '',
) );

});
