<?php
/**
 * 実行関数
 */

function get_this_post_views( $post_ID = null ) {
  global $wpdb;
  $post_ID = $post_ID === null ? get_the_id() : $post_ID;

  $all_results = $wpdb->get_results("
    SELECT *
    FROM `wp_postmeta`, `wp_posts`
    WHERE `wp_postmeta`.`meta_key` = 'post_views_count'
          AND `wp_postmeta`.`post_id` = $post_ID
          AND `wp_posts`.`ID` = $post_ID
          -- AND `wp_posts`.`post_status` = 'publish'
    ORDER BY `wp_postmeta`.`meta_value` DESC
    LIMIT 1
  ");

  if ( isset( $all_results[0] ) ) {
    return (int)$all_results[0]->meta_value;
  }
  else {
    return 0;
  }
}

function get_all_post_views( $pv_view_nom = null ) {
  global $wpdb;
  $pv_view_nom = $pv_view_nom === null ? 1 : $pv_view_nom;

  $all_results = $wpdb->get_results("
    SELECT *
    FROM  `wp_postmeta`, `wp_posts`
    WHERE  `wp_postmeta`.`meta_key` = 'post_views_count'
          AND `wp_posts`.`post_status` = 'publish'
          AND `wp_postmeta`.`post_id` = `wp_posts`.`ID`
    ORDER BY  `wp_postmeta`.`meta_value` DESC
    LIMIT 0, $pv_view_nom
  ");

  foreach ( $all_results as $i => $value ) {
    $all_id[]    = $value->post_id;
    $all_count[] = get_post_meta( $value->post_id, 'post_views_count', true );
    // $type[]  = get_post_meta( $value->post_id, 'post_views_type', true );
  }

  foreach ( $all_id as $all_i => $all_v ) {
    if ( isset( $all_count[$all_i] ) ) {
      $pv = (int)$all_count[$all_i];
    }
    else {
      $pv = 0;
    }

    $array[] = array(
                 'title'     => get_the_title( $all_v ),
                 'permalink' => get_the_permalink( $all_v ),
                 'pv'        => $pv,
               );
  }

  return $array;
}

function get_weekly_post_views( $pv_view_nom = null ) {
  global $wpdb;
  $pv_view_nom = $pv_view_nom === null ? 1 : $pv_view_nom;

  $weekly_results = $wpdb->get_results("
    SELECT *
    FROM  `wp_postmeta`, `wp_posts`
    WHERE  `wp_postmeta`.`meta_key` = 'weekly_post_views_count'
          AND `wp_posts`.`post_status` = 'publish'
          AND `wp_postmeta`.`post_id` = `wp_posts`.`ID`
    ORDER BY  `wp_postmeta`.`meta_value` DESC
    LIMIT 0, $pv_view_nom
  ");

  if ( !isset( $weekly_results[0] ) ) {
    return false;
  }

  foreach ( $weekly_results as $i => $value ) {
    $weekly_id[]    = $value->post_id;
    $weekly_count[] = get_post_meta( $value->post_id, 'weekly_post_views_count', true );
    // $type[]  = get_post_meta( $value->post_id, 'post_views_type', true );
  }

  foreach ( $weekly_id as $weekly_i => $weekly_v ) {
    if ( isset( $weekly_count[$weekly_i] ) ) {
      $pv = (int)$weekly_count[$weekly_i];
    }
    else {
      $pv = 0;
    }

    $array[] = array(
                 'title'     => get_the_title( $weekly_v ),
                 'permalink' => get_the_permalink( $weekly_v ),
                 'pv'        => $pv,
               );
  }

  return $array;
}

function get_monthly_post_views( $pv_view_nom = null ) {
  global $wpdb;
  $pv_view_nom = $pv_view_nom === null ? 1 : $pv_view_nom;

  $monthly_results = $wpdb->get_results("
    SELECT *
    FROM  `wp_postmeta`, `wp_posts`
    WHERE  `wp_postmeta`.`meta_key` = 'monthly_post_views_count'
          AND `wp_posts`.`post_status` = 'publish'
          AND `wp_postmeta`.`post_id` = `wp_posts`.`ID`
    ORDER BY  `wp_postmeta`.`meta_value` DESC
    LIMIT 0, $pv_view_nom
  ");

  if ( !isset( $monthly_results[0] ) ) {
    return false;
  }

  foreach ( $monthly_results as $i => $value ) {
    $monthly_id[]    = $value->post_id;
    $monthly_count[] = get_post_meta( $value->post_id, 'monthly_post_views_count', true );
    // $type[]  = get_post_meta( $value->post_id, 'post_views_type', true );
  }

  foreach ( $monthly_id as $monthly_i => $monthly_v ) {
    if ( isset( $monthly_count[$monthly_i] ) ) {
      $pv = (int)$monthly_count[$monthly_i];
    }
    else {
      $pv = 0;
    }

    $array[] = array(
                 'title'     => get_the_title( $monthly_v ),
                 'permalink' => get_the_permalink( $monthly_v ),
                 'pv'        => $pv,
               );
  }

  return $array;
}