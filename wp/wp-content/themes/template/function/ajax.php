<?php
// Ajaxのactionで呼び出される関数
function ajax_get_index(){

  // settings
  $jsonObj   = array();
  $data      = $_POST['data'];
  // $views     = $_POST['data']['views'];
  // $paged     = $_POST['data']['page'];
  // $post_type = $_POST['data']['post_type'];

  // 
  $query =
  array(
    // 投稿のタイプ
    'post_type'      => $post_type,

    // 投稿の状態
    'post_status'    => 'publish',

    // page
    'paged'          => $paged,

    // 表示数
    'posts_per_page' => $views,

    // 年別
    'year'           => $year,

    // カテゴリ別
    'tax_query'      => $tax_query,
  );


  // if ( is_user_logged_in() ) {
  //  $query['post_status'] = array(
  //    'publish',
  //    'pending',
  //    'draft',
  //    'future',
  //    'private',
  //    'inherit',
  //  );
  // }

  // var_dump( $query );
  $the_query = new WP_Query( $query );
  if ( $the_query->have_posts() ) :
    $i = 0;
    while ( $the_query->have_posts() ) :
      $the_query->the_post();

      /*-----------------*\
       |    thumbnail    |
      \*-----------------*/
      // noimgの設定
      $noImg = '<img src="'.huv_theme_path.'assets/img/common/no-image.jpg" alt="no-image">';

      // サムネイルの有無と分岐、セット
      $thumbnail = has_post_thumbnail( get_the_id() )
                 ? get_the_post_thumbnail( get_the_id(), 'takunan_thumbnail' )
                 : $noImg;

      /*-----------*\
       |    new    |
      \*-----------*/
      // new_checker() -> functions.php - No.10
      $new = new_checker( '7' ) ? true : false;

      /*----------------*\
       |    category    |
      \*----------------*/
      $set_terms = array(
        'category',
      );

      foreach ( $set_terms as $key => $term ) {
        // カテゴリーの取得
        $terms    = get_the_terms( get_the_id(), $term );
        $cat_name = array();
        $cat_slug = array();

        // カテゴリーをセット
        foreach ( $terms as $key => $value ) {
          $cat_name[] = $value->name;
          $cat_slug[] = $value->slug;
        }
      }

      /*------------------*\
       |    post_title    |
      \*------------------*/
      // タイトルの取得
      $post_title = get_the_title();

      // esc & 字数制限 (30字)
      // convert_string() -> functions.php - No.12
      $post_title = convert_string( $post_title, 30, '...' );

      /*---------------*\
       |    content    |
      \*---------------*/
      // 内容の取得
      $post_content = get_the_content();

      // esc & 字数制限 (60字)
      // convert_string() -> functions.php - No.12
      $post_content = convert_string( $post_content, 60, '...' );

      $jsonObj[$i] = array(
        'permalink'      => get_permalink(),
        'thumbnail'      => $thumbnail,
        'new'            => $new,
        'cat_slug'       => $cat_slug,
        'cat_name'       => $cat_name,
        'post_title'     => $post_title,
        'content'        => $post_content,
        'post_date'      => get_the_date('Y.m.d'),
        // 'query'      => $query,
        // 'end'      => $the_query->found_posts - ( $views * $paged ) <= 0,
      );
      ++$i;

      // 最後に取得した記事より前に記事がない場合
      if ( $the_query->found_posts - ( $views * $paged ) <= 0 ) {
        $previous = true;
      }
    endwhile;
    else :
      $noneObj = true;
  endif;
  wp_reset_postdata(); // reset

  // 最後に取得した記事より前に記事がない場合
  if ( $previous ) {
    $jsonObj['end'] = 'end';
  }

  if ( $noneObj ) {
    $jsonObj['noneObj'] = 'noneObj';
  }

  // jsonにして返す
  echo json_encode( $jsonObj );

  die();
}
add_action( 'wp_ajax_ajax_get_index', 'ajax_get_index' );
add_action( 'wp_ajax_nopriv_ajax_get_index', 'ajax_get_index' );
