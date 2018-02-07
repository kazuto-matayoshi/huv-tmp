<?php
/*******************************************************************************
Plugin Name: ウィジェットの追加
Description: チェックした投稿タイプのリンクと記事数を表示する『posts_count』の追加と、チェックしたカテゴリのリンクを一覧で表示する『tax_archives』の追加をします。
Version: 1.0
*/

/**
 * - ウィジェットの追加 -
 */
require 'widgets/HUV_posts_count.php';
require 'widgets/HUV_tax_archives.php';

add_action( 'widgets_init', function () {
  // チェックした投稿タイプのリンクと記事数を表示する
  register_widget( 'HUV_posts_count' );
  // チェックしたカテゴリのリンクを一覧で表示する
  register_widget( 'HUV_tax_archives' );
});