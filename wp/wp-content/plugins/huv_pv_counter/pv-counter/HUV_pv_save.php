<?php
/**
 * 実行関数
 */
function save_post_views( $post_ID = null ) {
  save_all_post_views( $post_ID );
  save_weekly_post_views( $post_ID );
  save_monthly_post_views( $post_ID );
}


/**
 * 準備
 */
/**
 *  wp_postmetaに
 * 'meta_key'='post_views_count'
 * を作成し、そこにPV数を突っ込む
 */
function save_all_post_views( $post_ID = null ) {
  // 投稿が『公開』じゃない場合
  if ( get_post_status( $post_ID ) !== 'publish' ) {
    return;
  }

  $post_type = get_post_type();
  $count_key = 'post_views_count';
  // $type_key  = 'post_views_type';
  $pad_left  = 10; // 何ケタで埋めるか

  if ( $post_ID === null ) {
    $post_ID = get_the_id();
  }

  $count = get_post_meta( $post_ID, $count_key, true );

  if ( $count === '' ) {
    $count = str_pad( 1, $pad_left, 0, STR_PAD_LEFT ); // 桁揃え→揃えないとsql叩いたときにソートされない
    delete_post_meta( $post_ID, $count_key );
    add_post_meta( $post_ID, $count_key, $count );
  }
  else {
    ++$count;
    $count = str_pad( $count, $pad_left, 0, STR_PAD_LEFT ); // 桁揃え→揃えないとsql叩いたときにソートされない
    update_post_meta( $post_ID, $count_key, $count );
  }

  // // 一回切り
  // $type = get_post_meta( $post_ID, $type_key, true );
  // if ( $type === '' ) {
  //   add_post_meta( $post_ID, $type_key, $post_type );
  // }
}

/**
 *  週に一回、wp_postmetaに
 * 'meta_key'='weekly_post_views_update'
 * 'meta_key'='weekly_post_views_count'
 * 'meta_key'='weekly_post_views_flag'
 * を作成し、そこにPV数を突っ込む
 */

function save_weekly_post_views( $post_ID = null ) {
  // 投稿が『公開』じゃない場合
  if ( get_post_status( $post_ID ) !== 'publish' ) {
    return;
  }

  $update_key = 'weekly_post_views_update';
  $count_key  = 'weekly_post_views_count';
  $pad_left   = 10; // 何ケタで埋めるか

  $week_name = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );

  // 時間関係
  date_default_timezone_set('Asia/Tokyo');

  $now         = strtotime( 'now' );
  // $now         = strtotime( '2017-12-03' ); // デバック用
  $week        = date( 'w', $now );
  $update_time = date( 'Y/m/d', strtotime( 'last Sunday', $now ) );

  if ( $post_ID === null ) {
    $post_ID = get_the_id();
  }

  // countの初期設定
  $count = get_post_meta( $post_ID, $count_key, true );

  if ( $count === false ) {
    $count = str_pad( 0, $pad_left, 0, STR_PAD_LEFT );
    add_post_meta( $post_ID, $count_key, $count );
  }

  // 更新日の初期設定
  $update = get_post_meta( $post_ID, $update_key, true );
  if ( $update === false ) {
    add_post_meta( $post_ID, $update_key, $update_time );
  }

  // 日曜、または、最終更新日が同じではない場合
  if ( $week_name[$week] === 'Sunday' ) {
    $update_time = date( 'Y/m/d',
                    strtotime( 'last Sunday',
                      $now + 7 * 24 * 60 * 60
                    )
                  );
  }

  // count追加
  ++$count;
  $count = str_pad( $count, $pad_left, 0, STR_PAD_LEFT ); // 桁揃え→揃えないとsql叩いたときにソートされない
  update_post_meta( $post_ID, $count_key, $count );

  // 更新日の更新
  update_post_meta( $post_ID, $update_key, $update_time );
}

/**
 *  月に一回、wp_postmetaに
 * 'meta_key'='monthly_post_views_update'
 * 'meta_key'='monthly_post_views_count'
 * 'meta_key'='monthly_post_views_flag'
 * を作成し、そこにPV数を突っ込む
 */
function save_monthly_post_views( $post_ID = null ) {
  // 投稿が『公開』じゃない場合
  if ( get_post_status( $post_ID ) !== 'publish' ) {
    return;
  }

  $update_key = 'monthly_post_views_update';
  $count_key  = 'monthly_post_views_count';
  $pad_left   = 10; // 何ケタで埋めるか

  $reset_day  = str_pad( 1, 2, 0, STR_PAD_LEFT ); // '01'

  // 時間関係
  date_default_timezone_set('Asia/Tokyo');
  $now         = strtotime( 'now' );
  // $now         = strtotime( '2017-12-01' ); // デバック用
  $update_time = date( 'Y/m', strtotime( 'first day of 0 month', $now ) );

  if ( $post_ID === null ) {
    $post_ID = get_the_id();
  }

  // countの初期設定
  $count = get_post_meta( $post_ID, $count_key, true );
  if ( $count === false ) {
    $count = str_pad( 0, $pad_left, 0, STR_PAD_LEFT );
    add_post_meta( $post_ID, $count_key, $count );
  }

  // 更新日の初期設定
  $update = get_post_meta( $post_ID, $update_key, true );
  if ( $update === false ) {
    add_post_meta( $post_ID, $update_key, $update_time );
  }

  // count追加
  ++$count;
  $count = str_pad( $count, $pad_left, 0, STR_PAD_LEFT ); // 桁揃え→揃えないとsql叩いたときにソートされない
  update_post_meta( $post_ID, $count_key, $count );

  // 更新日の更新
  update_post_meta( $post_ID, $update_key, $update_time );
}