<?php
/**
 * 準備
 */
function cron_weekly_post_views( $post_ID ) {
  /*-----------------*\
   | Setting - start |
  \*-----------------*/
  // リセットする曜日。下記から選ぶ
  // 'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'
  $reset = 'Sunday';

  /*---------------*\
   | Setting - End |
  \*---------------*/

  $update_key = 'weekly_post_views_update';
  $count_key  = 'weekly_post_views_count';
  $flag_key   = 'weekly_post_views_flag';

  $week_name = array(
                      'Sunday',
                      'Monday',
                      'Tuesday',
                      'Wednesday',
                      'Thursday',
                      'Friday',
                      'Saturday'
                    );

  // 時間関係
  date_default_timezone_set('Asia/Tokyo');
  $now         = strtotime( 'now' );
  // $now         = strtotime( '2017-12-03' ); // デバック用
  $week        = date( 'w', $now );
  $update      = get_post_meta( $post_ID, $update_key, true );
  $update_time = date( 'Y/m/d', strtotime( 'last Sunday', $now ) );

  /*------------*\
   |            |
   |    main    |
   |            |
  \*------------*/

  if ( $week_name[$week] === $reset || $update_time !== $update ) {
    $update_time = date( 'Y/m/d',
                    strtotime( 'last Sunday',
                      $now + 7 * 24 * 60 * 60
                    )
                  );
    // 一週間の初期化
    update_post_meta( $post_ID, $count_key, '0' );

    // 更新日の更新
    update_post_meta( $post_ID, $update_key, $update_time );
  }
}

function cron_monthly_post_views( $post_ID ) {
  $update_key = 'monthly_post_views_update';
  $count_key  = 'monthly_post_views_count';
  $flag_key   = 'monthly_post_views_flag';

  $reset_day  = str_pad( 1, 2, 0, STR_PAD_LEFT ); // '01'

  // 時間関係
  date_default_timezone_set('Asia/Tokyo');
  $now         = strtotime( 'now' );
  // $now         = strtotime( '2018-12-01' ); // デバック用
  $update = get_post_meta( $post_ID, $update_key, true );
  $update_time = date( 'Y/m', strtotime( 'first day of 0 month', $now ) );

  /*------------*\
   |            |
   |    main    |
   |            |
  \*------------*/
  if ( date('d') === $reset_day || $update_time !== $update ) {
    // 一月の初期化
    update_post_meta( $post_ID, $count_key, '0' );

    // 更新日の更新
    update_post_meta( $post_ID, $update_key, $update_time );
  }
}


/**
 * 実行関数
 * -> コメントアウトしてるけどlogも残せるよ
 */
function cron_post_views() {
  global $wpdb;
  $results = $wpdb->get_results("
    SELECT *
    FROM `wp_postmeta`
    WHERE `meta_key` = 'post_views_count'
    ORDER BY  `wp_postmeta`.`meta_key` DESC
  ");

  // // log用のテキスト
  // $update_text = 'last update time : ' . date ( 'Y/m/d H:i:s', strtotime( 'now' ) )."\n\n";

  foreach ( $results as $i => $value ) {
    cron_weekly_post_views( $value->post_id );
    cron_monthly_post_views( $value->post_id );
    // $update_text .= "{$value->post_id} monthly_count : ".get_post_meta( $value->post_id, 'monthly_post_views_count', true )."\n";
    // $update_text .= "{$value->post_id} weekly_count : ".get_post_meta( $value->post_id, 'weekly_post_views_count', true )."\n\n";
  }

  // var_dump($results);

  // $dir             = dirname(__FILE__);
  // $log_file        = $dir . '/update_log.txt';
  // $expire          = strtotime( 'now' );

  // // ファイルの存在確認
  // if ( !file_exists( $log_file ) ) {
  //   touch( $log_file, $expire );
  // }

  // /* log書き込み */
  // $up = fopen( $log_file, 'w' );
  // fwrite( $up, $update_text );
  // fclose( $up );
}

// 一分毎に処理できるようにするヤツ
function cron_add_1min( $schedules ) {
  $schedules['1min'] = array(
    'interval' => 1*60,
    'display' => __( 'Every 1 minutes' )
  );

  return $schedules;
}

// 移動させるな！！！（なんかわからんけどここじゃなきゃダメ！）
add_action ( 'my_auto_function_cron', 'cron_post_views' );
add_filter( 'cron_schedules', 'cron_add_1min' );

// cron登録処理
// 何度も同じcronが登録されないように
if ( !wp_next_scheduled( 'my_auto_function_cron' ) ) {
  date_default_timezone_set('Asia/Tokyo');
  wp_schedule_event( strtotime( 'now' ), '1min', 'my_auto_function_cron' );
}