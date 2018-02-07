<?php
/*******************************************************************************
Plugin Name: 投稿機能のカスタムフィールドの管理
Description: 投稿機能のカスタムフィールドの管理をファイル上で行います。
Version: 1.0
*/

if ( !class_exists( 'HUV_custom_field_post' ) ) {
  class HUV_custom_field_post {
    // Settings
    private $post_id;

    // カスタムフィールドブロックの設定
    private $base_block = array(
      'pickup' => 'ピックアップ',
    );

    private $base_post_type = array(
      'post',
    );

    // 初期実行関数
    public function __construct() {
      add_action( 'admin_menu', array( $this, 'add_custom_field' ) );
      add_action( 'save_post', array( $this, 'saveContent' ) );
    }

    // Add func
    public function add_custom_field() {
      foreach ( (array)$this->base_post_type as $value_post_type ) {
        foreach ( (array)$this->base_block as $key_block => $value_block ) {
          static $i = 0;
          add_meta_box(
            'huv_custom_field-'.$value_post_type.'_'.$i,
            $value_block,
            array( $this, 'fieldContent_'.$key_block ),
            $value_post_type,
            'normal'
          );
          $i++;
        }
      }
    }

    // View func
    public function fieldContent_pickup() {
      $id   = get_the_ID();
      $post = get_post_type();
      wp_nonce_field( 'sample_metabox', 'sample_metabox_editor_nonce' );

      /*__ pickup _______________________*/
        $content            = '';
        $pickup_meta = get_post_meta( $id, 'fieldContent_pickup_content', true );

        if ( $pickup_meta ) {
          $content = $pickup_meta;
        }

        echo '<p>';
          echo '<label>';
            echo '<input value="pickup" type="checkbox" name="'.$post.'__pickup" id="pickup"'.( $content == 'pickup' ? ' checked' : '' ).'>';
            echo 'ピックアップ';
          echo '</label>';
        echo '</p>';
        
      /*__ pickup end _______________________*/
    }

    // Save func
    public function saveContent( $post_id ) {
      $post = get_post_type();

      // // name="sample_metabox_editor_nonce"があるかどうかチェック
      // if ( !isset( $_POST['sample_metabox_editor_nonce'] ) ) {
      //   return;
      // }

      // // nonceが正しいもので有効期限が切れていないかチェック
      // if ( !wp_verify_nonce( $_POST['sample_metabox_editor_nonce'], 'sample_metabox') ) {
      //   return;
      // }

      // DOING_AUTOSAVEという定数があるかどうかチェック
      if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
      }

      /* 権限チェック */
      // if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
      //  if ( !current_user_can( 'edit_page', $post_id ) ) {
      //    return;
      //  }
      // } else {
      //  if ( !current_user_can( 'edit_post', $post_id ) ) {
      //    return;
      //  }
      // }

      /*__ pickup _______________________*/
        $pickup = isset( $_POST[$post.'__pickup'] ) ? esc_html($_POST[$post.'__pickup']) : '';
        update_post_meta( $post_id, 'fieldContent_pickup_content', $pickup );
      /*__ pickup end _______________________*/
    }
  }
}

if( is_admin() ) {
  $HUV_custom_field_post = new HUV_custom_field_post();
}

// /*__ css _______________________*/
// function my_admin_style_recruit() {
//   $post = get_post_type();
//   if ( $post !== 'post' ) {
//     wp_enqueue_style( $post, plugins_url().'/huv-add_plugins/admin/css/post_type-'.$post.'.css' );
//   }
// }
// add_action( 'admin_enqueue_scripts', 'my_admin_style_recruit' );

// /*__ js _______________________*/
// function my_admin_script_recruit() {
//   $post = get_post_type();
//   if ( $post !== 'post' ) {
//     // wp_enqueue_script( 'jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '', true);
//     wp_enqueue_script( 'jquery-ui-i18n', '//code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '', true );

//     // メディアアップローダー用のスクリプトをロードする
//     wp_enqueue_media();

//     // カスタムメディアアップローダー用のJavaScript
//     // wp_enqueue_script( 'admin-common', plugins_url().'/huv-add_plugins/admin/js/admin-common.js', array('jquery'), '', true);
//   }
//   if ( $post === 'recruit' ) {
//     wp_enqueue_script( 'post_type-'.$post, plugins_url().'/huv-add_plugins/admin/js/post_type-'.$post.'.js', array('jquery'), '', true);
//   }
// }
// add_action( 'admin_enqueue_scripts', 'my_admin_script_recruit' );