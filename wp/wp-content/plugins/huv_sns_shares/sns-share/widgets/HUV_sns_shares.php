<?php
  class HUV_sns_shares extends WP_Widget {
    private $classname = 'sns_shares';
    private $readTxt   = 'SNSの投稿ボタンの追加とその編集';

    private $use_sns_array = array(
      'Facebook',
      'Twitter',
      'Google',
      'hatena',
      'pocket',
      'LINE',
    );


    /**
     * Widgetを登録する
     */
    function __construct() {
      $widget_ops = array(
        'classname'   => $this->classname,
        'description' => __( $this->readTxt ),
        'customize_selective_refresh' => true,
      );
      parent::__construct( $this->classname, 'SNSの投稿ボタンの追加とその編集', $widget_ops );
    }

    /**
     * 表側の Widget を出力する
     *
     * @param array $args
       'register_sidebar'で設定した「before_title, after_title, before_widget, after_widget」が入る
     * @param array $instance  Widgetの設定項目
     */
    public function widget( $args, $instance ) {

      /*-----------------*\
       |                 |
       |    Variables    |
       |                 |
      \*-----------------*/

      $huv_sns_posts = isset( $instance['huv_sns_posts'] )
                       ? $instance['huv_sns_posts']
                       : '';

      /*---------------*\
       |               |
       |    out put    |
       |               |
      \*---------------*/

        var_dump($huv_sns_posts);

        $url = "https://syncer.jp/";   //シェア対象のURLアドレスを指定する (HTML部分は変更不要)
        $content = "test";

        echo HUV_fb_share( $url, 'HUV_fb_share' ).'<br>';
        echo HUV_tw_share( $url, 'HUV_tw_share' ).'<br>';
        echo HUV_google_share( $url, 'HUV_google_share' ).'<br>';
        echo HUV_line_share( $url, 'HUV_line_share' ).'<br>';
        echo HUV_hatena_share( $url, 'HUV_hatena_share' ).'<br>';
        echo HUV_pocket_share( $url, 'HUV_pocket_share' ).'<br>';
        echo 'aaaaaaaaaaaaa';
    }

    /**
     * Widget管理画面を出力する
     *
     * @param array $instance 設定項目
     * @return string|void
     */
    public function form( $instance ) {

      /*---------------*\
       |               |
       |    out put    |
       |               |
      \*---------------*/

      /*---- Posts Variables ----*/
      $huv_sns_posts      = isset( $instance['huv_sns_posts'] )
                            ? $instance['huv_sns_posts']
                            : '';

      // inputのIDとして使用する際には必須
      $huv_sns_posts_id   = $this->get_field_id('huv_sns_posts');

      // inputのnameとして使用するので必須
      $huv_sns_posts_name = $this->get_field_name('huv_sns_posts').'[]';

      // 投稿タイプの一覧を取得
      $args = array(
                'public' => true
              );
      $post_types = get_post_types( $args );


      // echo '<p>'.$this->readTxt.'</p>';
      echo '<p>使用する投稿タイプ</p>';

      /** 取得した投稿タイプ一覧を出力します */
      if ( count( $post_types ) != 0 ) :
        echo '<ul>';
          foreach ( $post_types as $i => $post_type ) :
            // 投稿タイプ名の取得
            $post_type_name = get_post_type_object( $post_type )->labels->singular_name;
            if (
              get_post_type_object( $post_type )->name !== "attachment"
            ) :
              // checkedの判定
              $checked = '';
              if ( $huv_sns_posts
                   && array_search( $post_type, $huv_sns_posts ) !== false
                 ) {
                $checked = ' checked="checked"';
              }

              echo '<li>';
                echo '<input id="'.$huv_sns_posts_id.'-'.$i.'" type="checkbox" name="'.$huv_sns_posts_name.'" value="'.$post_type.'"'.$checked.'>';

                // echo '<label for="'.$huv_sns_posts_id.'-'.$i.'">'.$post_type.'</label>';

                echo '<label for="'.$huv_sns_posts_id.'-'.$i.'">'.$post_type_name.'</label>';
              echo '</li>';
            endif;
          endforeach;
        echo '</ul>';
      endif;




      /*---- Use Variables ----*/
      $huv_sns_use      = isset( $instance['huv_sns_use'] )
                        ? $instance['huv_sns_use']
                        : '';

      // inputのIDとして使用する際には必須
      $huv_sns_use_id   = $this->get_field_id('huv_sns_use');

      // inputのnameとして使用するので必須
      $huv_sns_use_name = $this->get_field_name('huv_sns_use').'[]';


      echo '<p>使用するSNS</p>';
      echo '<ul>';
        foreach ( $this->use_sns_array as $i => $sns_name ) :
          // checkedの判定
          $checked = '';
          if ( $huv_sns_use
               && array_search( $sns_name, $huv_sns_use ) !== false
             ) {
            $checked = ' checked="checked"';
          }

          echo '<li>';
            echo '<input id="'.$huv_sns_use_id.'-'.$i.'" type="checkbox" name="'.$huv_sns_use_name.'" value="'.$sns_name.'"'.$checked.'>';

            // echo '<label for="'.$huv_sns_use_id.'-'.$i.'">'.$sns_name.'</label>';
            echo '<label for="'.$huv_sns_use_id.'-'.$i.'">'.$sns_name.'</label>';

            if ( $checked !== '' ) {
              $url = "https://syncer.jp/"; //シェア対象のURLアドレスを指定する (HTML部分は変更不要)
              $content = "test";
              $func_name = 'HUV_'.$sns_name.'_share';
              echo $func_name( $url, $content );
            }
          echo '</li>';
        endforeach;
      echo '</ul>';
      var_dump($instance);
    }

    /**
     * 新しい設定データが適切なデータかどうかをチェックする。
     * 必ず$instanceを返す。さもなければ設定データは保存（更新）されない。
     *
     * @param array $new_instance  form()から入力された新しい設定データ
     * @param array $old_instance  前回の設定データ
     * @return array               保存（更新）する設定データ。falseを返すと更新しない。
     */


    private function sanitizing( $instance ) {
      $sanitizing_instance = array();


      foreach ( $instance as $array_key => $array_value ) {
        if ( is_array( $array_value ) ) {
          foreach ( $array_value as $key => $value ) {
            $value = esc_html( $value );
            // if ( array_key_exists( $value, $this->use_sns_array ) ) {
            $sanitizing_instance[$array_key][] = $value;
            // }
          }
        }
        else {
          $value = esc_html( $array_value );
          $sanitizing_instance[$array_key] = $value;
        }
      }
      return $sanitizing_instance;
    }


    function update( $new_instance, $old_instance ) {
      $this->sanitizing( $new_instance );

      // $sanitizing_instance = array();
      // foreach ( $new_instance as $key => $value ) {
      //   $value = esc_html( $value );
      //   if ( array_key_exists( $value, $this->use_sns_array ) ) {
      //     $sanitizing_instance[] = $value;
      //   }
      //   // var_dump( $value );
      // }

      return $this->sanitizing( $new_instance );
    }
  }
