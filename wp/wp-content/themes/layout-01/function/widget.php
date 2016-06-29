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
	unregister_widget('WP_Widget_RSS');             // RSS/Atom フィード
	unregister_widget('WP_Widget_Meta');            // メタ情報(login/outなど)
	unregister_widget('WP_Widget_Text');            // 任意のテキストやHTMLを挿入するウィジェット
	unregister_widget('WP_Widget_Pages');           // 固定ページ一覧用のウィジェット
	unregister_widget('WP_Widget_Links');           // リンク集
	unregister_widget('WP_Widget_Search');          // サイト内検索フォーム
	// unregister_widget('WP_Nav_Menu_Widget');        // カスタムメニュー
	unregister_widget('WP_Widget_Archives');        // 投稿の月別アーカイブ
	unregister_widget('WP_Widget_Calendar');        // カレンダー
	unregister_widget('WP_Widget_Tag_Cloud');       // タグクラウド
	unregister_widget('WP_Widget_Categories');      // カテゴリーリスト
	unregister_widget('WP_Widget_Recent_Posts');    // 最近の投稿
	unregister_widget('WP_Widget_Recent_Comments'); // 最近のコメント
}
add_action('widgets_init', 'unregister_widgets');


/**
 * - ウィジェット管理画面右側のボックス -
 */

register_sidebar( array(  //「サイドバー」を登録する
	'name'          => __( 'グローバルナビゲーション' ),
	'id'            => 'gnav',
	'description' => __( 'グローバルナビゲーションの追加' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '',
) );

