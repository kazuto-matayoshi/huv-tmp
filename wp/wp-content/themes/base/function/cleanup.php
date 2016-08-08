<?php

/**
 *
 * head内整理のための関数群
 *
 * 1.0 - rsd_link
 * 2.0 - noindex
 * 3.0 - wp_generator
 * 4.0 - rel_canonical
 * 5.0 - wlwmanifest_link
 * 6.0 - print_emoji_styles
 * 7.0 - print_emoji_detection_script
 * 8.0 - wp_shortlink_wp_head
 * 9.0 - oEmbed系
 * 10.0 - window._se_plugin_version = 'x.x.x';と生成されるのを削除(global_head.phpの読み込み停止)
 * 要検証
 */



/**
 * 1.0 - rsd_link
 * ブログ編集用のアドレスを削除。
 */
remove_action('wp_head', 'rsd_link');

/**
 * 2.0 - noindex
 * meta name='robots'の削除。
 */
remove_action('wp_head', 'noindex', 1);

/**
 * 3.0 - wp_generator
 * wpのバージョン表示を削除。
 */
remove_action('wp_head', 'wp_generator');

/**
 * 4.0 - rel_canonical
 * URL正規化タグを削除。
 * ユニークで持ちたい場合の参考 - http://on-ze.com/archives/1576
 */
// remove_action('wp_head', 'rel_canonical');

/**
 * 5.0 - wlwmanifest_link
 * Windows Live Writer を使って記事を投稿するときのアドレスを削除。
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * 6.0 - print_emoji_styles
 * WordPress 4.2で追加された絵文字を画像に置き換える時のcssを削除。
 */
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * 7.0 - print_emoji_detection_script
 * WordPress 4.2で追加された絵文字を画像に置き換えるスクリプトの削除。
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');

/**
 * 8.0 - wp_shortlink_wp_head
 * ?p=[投稿ID]という形式のデフォルトパーマリンクのURLの削除。
 */
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/**
 * 9.0 - oEmbed系
 * 参考 - http://on-ze.com/archives/5127
 */
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');

/*
 * 10.0 - window._se_plugin_version = 'x.x.x';と生成されるのを削除(global_head.phpの読み込み停止)
 * 参考 - https://goo.gl/fz6eOH
 */
remove_action('wp_head', 'se_global_head');



/**
 * 要検証
 */

/**
 * .0 - feed_links 
 * サイト全体へのfeedを出力する。
 */
// remove_action('wp_head', 'feed_links', 2);

/**
 * .0 - index_rel_link 
 * linkタグを出力。
 */
// remove_action('wp_head', 'index_rel_link');

/**
 * .0 - ??? 
 * ブラウザが先読みするためlink rel="next"などのタグを吐き出す。
 */
// remove_action('wp_head', 'parent_post_rel_link', 10, 0);
// remove_action('wp_head', 'start_post_rel_link', 10, 0);
// remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
// remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

/**
 * .0 - emoji 
 * 絵文字を画像に変換する関数の削除。
 */
// remove_filter('the_content_feed', 'wp_staticize_emoji');
// remove_filter('comment_text_rss', 'wp_staticize_emoji');

/**
 * .0 - emoji 
 * メールから投稿されたテキストに含まれる絵文字を画像に変換するコードの削除。
 */
// remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

/**
 * .0 - emoji 
 * admin_print_scripts と admin_print_styles は、投稿ページなどではなく、 ログインしたユーザや管理者の走査するダッシュボードなどでスクリプトや CSS を読み込むためのアクションです。
 */
// remove_action('admin_print_styles', 'print_emoji_styles');
