<?php
/*
Plugin Name: HUVRID Add Custom Post
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
if ( ! defined( 'HUV_AddPostType_DIR' ) ) {
  define( 'HUV_AddPostType_DIR', plugin_dir_path( __FILE__ ) );
}

if ( !function_exists( 'HUV_AddPostType' ) ) {
  function HUV_AddPostType() {
    /**
     * register_post_type( '$post_type', $args );
     * 詳細 -> http://goo.gl/Sqgk2o
     */
    register_post_type(
      // ポストタイプ名の指定
      'add-post-type',

      // args
      array(
        /**
         * labelの詳細設定。labelを上書きする。
         * @param Array
         */
        'labels' => array(
          // カスタム投稿タイプの名前
          'name'                  => 'Add Post Type',

          // admin bar(管理画面上部)の『+新規』内の文言変更
          'singular_name'         => 'Add Post Type',

          // 『新規追加』の文言変更（ボタンとかも諸々）
          'add_new'               => _x('Add New', 'post'),

          // どこ？
          // 'add_new_item'          => __('Add New Post'),

          // 『投稿の編集』の文言変更
          'edit_item'             => __('Edit Post'),

          // どこ？
          // 'new_item'              => __('New Post'),

          // 管理画面のカスタム投稿詳細からフロント側のカスタム投稿の詳細ページを表示するリンクの変更
          'view_item'             => __('View Post'),

          // 管理画面のカスタム投稿一覧からフロント側のカスタム投稿の一覧ページを表示するリンクの変更
          'view_items'            => __('View Post'),

          // 『投稿を検索』ボタンの文言変更（管理画面一覧の投稿絞り込みのボタン）
          'search_items'          => __('Search Posts'),

          // カスタム投稿内で記事が見つからない場合の文言
          'not_found'             => __('No posts found.'),

          // ゴミ箱内で記事が見つからない場合の文言
          'not_found_in_trash'    => __('No posts found in Trash.'),

          // 固定ページ等の階層型のタイプにのみ有効。『親ページ：』の文言を変更
          'parent_item_colon'     => __('Parent Page:'),

          // どこ？
          // 'archives'              => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'attributes'            => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'insert_into_item'      => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'uploaded_to_this_item' => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'set_featured_image'    => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'remove_featured_image' => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'use_featured_image'    => __('aaaaaaaaaaaaaaaaaa'),

          // 管理画面上のメニューの名前（通常は'name'と同じ）
          // 'menu_name'             => _x('Posts', 'post type general name'),

          // どこ？
          // 'filter_items_list'     => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'items_list_navigation' => __('aaaaaaaaaaaaaaaaaa'),

          // どこ？
          // 'items_list'            => __('aaaaaaaaaaaaaaaaaa'),

          // admin bar(管理画面上部)の『+新規』内の文言変更（通常は'singular_name'と同じ）
          // 'name_admin_bar'        => _x('Posts', 'post type general name'),
        ),

        /**
         * ポストタイプの概要を簡単に説明します。
         * @param String
         */
        'description' => '',

        /**
         * 'authors'と'reader'がどのように見えるか制御
         * @param Boolean
         * @default false
         * 'true' - 投稿、固定ページ、メディア（？）に近しい表示
         * 'false' - 独自のインターフェイスを用意することができる
         */
        'public' => true,

        /**
         * フロント側で検索機能を使った際に検索対象から除外するか否か
         * @param Boolean
         * @default 'public'の値と逆
         * 'true'にすることによって検索対象から外れる
         */
        'exclude_from_search' => true,

        // /**
        //  * フロントエンドでクエリを実行できるかどうかを指定します。
        //  * @param Boolean
        //  * @default 'public'と同値
        //  */
        // 'publiclyqueryable' => '',

        // /**
        //  * 管理画面上からこのカスタム投稿にアクセスさせるかどうか。
        //  * @param Boolean
        //  * @default 'public'と同値
        //  */
        // 'show_ui' => '',

        // /**
        //  * 管理画面上のメニューに表示させるかどうか。
        //  * @param Boolean
        //  * @default 'public'と同値
        //  */
        // 'show_in_nav_menus' => '',

        // /**
        //  * 管理メニューで投稿タイプを表示する場所。
        //  * @param Boolean / String
        //  * @default 'show_ui'と同値
        //  * 'true'   - トップレベルメニューとして表示
        //  * 'false'  - 管理者メニューに表示されない
        //  * 'String' - 指定したページのサブメニューとして配置されます。
        //  *            例 : 'tools.php' や 'edit.php?post_type=page'
        //  */
        // 'show_in_menu' => '',

        // /**
        //  * admin bar(管理画面上部)で使用できるようにするか否か
        //  * @param Boolean
        //  * @default 'show_in_menu'と同値
        //  */
        // 'show_in_admin_bar' => '',

        // /**
        //  * メニューの位置
        //  * @param Int
        //  * @default null
        //  */
        // 'menu_position' => '',

        // /**
        //  * メニューのicon
        //  * @param String
        //  * @default null
        //  */
        // 'menu_icon' => '',

        // // 'capability_type' => '',

        // // 'capabilities' => '',

        // // 'map_meta_cap' => '',

        // /**
        //  * 投稿タイプが階層型かどうか。（例：固定ページ）
        //  * ※'supports'の'page-attributes'が指定されている必要あり
        //  * @param Boolean
        //  * @default false
        //  */
        // 'hierarchical' => '',

        /**
         * このカスタム投稿に反映させるコンテンツ内容
         * @param Array / Boolean
         * @default 'title' => '','editor'
         */
        'supports' => array(
          // タイトル
          'title',

          // // エディタ
          // 'editor',

          // // 著者
          // 'author',

          // // サムネイル
          // 'thumbnail',

          // // 抜粋
          // 'excerpt',

          // // トラックバック
          // 'trackbacks',

          // // カスタムフィールド
          // 'custom-fields',

          // // コメント
          // 'comments',

          // // リビジョン
          // 'revisions',

          // // ページ属性（'hierarchical'が'true'である必要あり）
          // 'page-attributes',

          // // ポスト・フォーマット
          // 'post-formats',
        ),

        // // 'register_meta_box_cb' => '',

        /**
         * register_taxonomy()で編集するから必要なし?
         * @param Array
         * @default null
         */
        // 'taxonomies' => '',

        /**
         * アーカイブを持つか否か。
         * @param Boolean / String
         * @default false
         * Stringの用途は不明
         */
        'has_archive' => false,

        // /**
        //  * このポストタイプの書き換えを行います。
        //  * 書き換えを防止するには、falseに設定します。
        //  * @param Array / String
        //  * @default true
        //  */
        // 'rewrite' => array(
        //   /**
        //    * slugの書き換えを行います。archive等に影響が出ます
        //    * @param String
        //    * @default $post_type
        //    */
        //   'slug' => '',

        //   /**
        //    * パーマリンクの設定を引き継ぐか否か。
        //    * @param Boolean
        //    * @default true
        //    * 例 parmalink設定が『/blog/%post_type%/』となっていて、
        //    * 'true'の場合  -> /blog/%post_type%/
        //    * 'false'の場合 -> /%post_type%/
        //    */
        //   'with_front' => '',

        //   /**
        //    * feedを持つか否か
        //    * @param Boolean
        //    * @default 'has_archive'と同値
        //    */
        //   'feeds' => '',

        //   /**
        //    * ようわからん
        //    * @param Boolean
        //    * @default true
        //    */
        //   'pages' => true,

        //   /**
        //    * ようわからん
        //    * @param Const
        //    * @default 'permalink_epmask'が指定されている場合はそれと同値
        //    */
        //   'ep_mask' => '',
        // ),

        // /**
        //  * ようわからん
        //  * @param String / Const
        //  * @default EP_PERMALINK
        //  */
        // // 'permalink_epmask' => EP_PERMALINK,

        /**
         * query_varの設定
         * @param String / Boolean
         * @default true ( $post_type )
         * 'false'  - query_varキーの使用を無効にし、/?{query_var}={single_post_slug}で読み込めなくなります。
         * 'string' - /?{new_query_var}={single_post_slug}として動作します。
         */
        'query_var' => false,

        // /**
        //  * この投稿タイプをエクスポートできるようにするか否か
        //  * @param Boolean
        //  * @default true
        //  */
        // 'can_export' => true,

        // /**
        //  * ユーザーを削除するときに、このタイプの投稿を削除するか否か
        //  * @param Boolean
        //  * @default null
        //  */
        // 'delete_with_user' => null,

        // /**
        //  * この投稿タイプをREST APIに公開するかどうか。
        //  * @param Boolean
        //  * @default false
        //  */
        // 'show_in_rest' => false,

        // /**
        //  * REST APIを使用してこのポストタイプにアクセスするときに使用する基本スラッグの設定
        //  * @param String
        //  * @default $post_type
        //  */
        // 'rest_base' => '',

        // /**
        //  * WP_REST_Posts_Controllerの代わりに使用するオプションのカスタムコントローラー。
        //  * WP_REST_Controllerのサブクラスでなければなりません。
        //  * @param String
        //  * @default WP_REST_Posts_Controller
        //  */
        // 'rest_controller_class' => WP_REST_Posts_Controller,

        // // '_builtin' => '',
        // // '_edit_link' => '',
      )
    );

    // パーマリンク設定を再設定
    flush_rewrite_rules();
  }
  add_action( 'init', 'HUV_AddPostType' );
}
