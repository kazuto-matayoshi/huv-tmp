<?php
//---------------------------------
/*
 *           調整中
 *         ∧,,∧ ∧,,∧
 *  ∧,,∧  (´・ω・)(・ω・｀)∧,,∧
 * ( ´・ω).(O┬O) (O┬O(ω・｀ )
 * ( O┬O ∧,,∧.  ∧,,∧O┬O )
 * ◎-Ｊ┴◎(  ´・) (・｀  )┴し-◎
 *      (.__l) (l__)
 *       `ｕﾛｕ'.`ｕﾛu'
 */
//---------------------------------


// /**
//  *  投稿数の取得
//  */
// function loopPostCount() {
//  $args = array(
//    'post_type'      => 'post', // 投稿タイプに'post'を取得
//    'posts_per_page' => -1,     // 'post'を全件取得
//  );

//  $meta_posts = get_posts($args);
//  $count_post = 0;

//  // 投稿数loop
//  foreach ($meta_posts as $post) {
//      $count_post++;
//  }

//  // $count_postに値を返して処理終了
//  return $count_post;
// }


// /**
//  * mw-WP-FORM
//  * URLを見て値を引き継ぐ設定
//  */
// function my_mwform_value( $value, $name ) {
//  /**
//   * $name -> inputのnameの値'work_name'
//   * $_GET['xxx'] -> URLパラメーターのxxxの値
//   */
//  if ( $name === 'work_name' && !empty( $_GET['title'] ) && !is_array( $_GET['title'] ) ) {
//    return $_GET['title'];
//  }
//  return $value;
// }

// // 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
// add_filter( 'mwform_value_mw-wp-form-xxx', 'my_mwform_value', 10, 2 );



/**
 * 他のメンバーの画像を見れないようにする設定
 * メディアの抽出条件にログインユーザーの絞り込み条件を追加する
 */
// function display_only_self_uploaded_medias( $wp_query ) {
//    if ( is_admin() && ( $wp_query->is_main_query() || ( defined( 'DOING_QUERY_ATTACHMENT' ) && DOING_QUERY_ATTACHMENT ) ) && $wp_query->get( 'post_type' ) == 'attachment' ) {
//        $user = wp_get_current_user();
//        $wp_query->set( 'author', $user->ID );
//    };
// }
// function define_doing_query_attachment_const() {
//    if ( ! defined( 'DOING_QUERY_ATTACHMENT' ) ) {
//        define( 'DOING_QUERY_ATTACHMENT', true );
//    };
// }

// get_currentuserinfo();
// if($current_user->user_level < 9){
//    add_action( 'pre_get_posts', 'display_only_self_uploaded_medias' );
//    add_action( 'wp_ajax_query-attachments', 'define_doing_query_attachment_const', 0 );
// };

/**
 * 他の人の投稿を見れないようにする
 */ 
// function exclude_other_posts( $wp_query ) {
//  if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
//    $post_type = get_post_type_object( $_REQUEST['post_type'] );
//    $cap_type = $post_type->cap->edit_other_posts;
//  } else {
//    $cap_type = 'edit_others_posts';
//  };

//  if ( is_admin() && $wp_query->is_main_query() && ! $wp_query->get( 'author' ) && ! current_user_can( $cap_type ) ) {
//    $user = wp_get_current_user();
//    $wp_query->set( 'author', $user->ID );
//  };
// }

// if ($current_user->user_level < 9) {
//  add_action( 'pre_get_posts', 'exclude_other_posts' );
// };

