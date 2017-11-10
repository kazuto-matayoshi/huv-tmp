<?php
/*******************************************************************************
Plugin Name: カスタム投稿
Description: カスタム投稿をプログラム上で追加します。
Version: 1.0
*/

//---------------------------------
/**
 * カスタム投稿タイプ
 */
//---------------------------------

/**
 * カスタム投稿タイプの追加
 */
function create_post_type() {

  /**
   * register_post_type( '$post_type', $args );
   * 詳細 -> http://goo.gl/Sqgk2o
   */
  register_post_type( 'original_themes', //ポストタイプ名の指定
    array(
      'labels'           => array (
        'name'           => 'オリジナルテーマ作成',
        'singular_name'  => 'オリジナルテーマ作成',
      ),
      'public'        => true,
      'has_archive'   => true,
      'rewrite'       => array( 'slug' => 'original_themes', ),
      'menu_icon'     => '',
      'menu_position' => 5,
      'supports'      => array (
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'custom-fields',
        'comments',
      ),
    )
  );

  /**
   * register_taxonomy( $taxonomy, $object_type, $args );
   * 詳細 -> http://goo.gl/f4fyy8
   */
  // カテゴリタクソノミー(カテゴリー分け)を使えるように設定する。(カテゴリver.)
  register_taxonomy (

    // タクソノミーの名前
    'original_themes_cat',

    // 使用するカスタム投稿タイプ名
    'original_themes',

    array(
      'hierarchical'          => true,
      'update_count_callback' => '_update_post_term_count',
      'label'                 => 'オリジナルテーマ作成カテゴリー',
      'public'                => true,
      'show_ui'               => true,
    )
  );

  // カテゴリタクソノミー(カテゴリー分け)を使えるように設定する。(タグver.)
  register_taxonomy(

    // タクソノミーの名前
    'original_themes_tag',

    // 使用するカスタム投稿タイプ名
    'original_themes',

    array(
      'hierarchical'          => false,
      'update_count_callback' => '_update_post_term_count',
      'label'                 => 'オリジナルテーマ作成タグ',
      'public'                => true,
      'show_ui'               => true
    )
  );

  // パーマリンク設定を再設定
  flush_rewrite_rules();
}
// add_action( 'init', 'create_post_type' );