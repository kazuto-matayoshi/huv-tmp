<?php
class mv_control__settings {

  /** 設定値 */
  private $options;

  /**
   * 初期化処理です。
   */
  public function __construct() {
    // メニューを追加します。 -> add_action( 'admin_menu', function );
    add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );

    // ページの初期化を行います。
    // 管理画面にいる際の処理 -> add_action( 'admin_init', function );
    add_action( 'admin_init', array( $this, 'page_view' ) );

    // ページの保存処理を行います。
    add_action( 'admin_init', array( $this, 'page_save' ) );
  }

  /**
   * メニューをメニューバーに追加します。
   */
  public function add_plugin_page() {
    // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    //   $page_title: 設定ページの<title>部分
    //   $menu_title: メニュー名
    //   $capability: 権限 ( 'manage_options' や 'administrator' など )
    //   $menu_slug : メニューのslug
    //   $function  : 設定ページの出力を行う関数
    //   $icon_url  : メニューに表示するアイコン
    //   $position  : メニューの位置 ( 1 や 99 など )


    add_menu_page(
      'MV Control',
      'MV Control',
      'administrator',
      MV_Control_prefix.'MV_Control',
      array( $this, 'create_setting_cont' ),
      '',
      1
    );

    // 設定のサブメニューとしてメニューを追加する場合は下記のような形にします。
    // add_options_page( 'テスト設定', 'テスト設定', 'manage_options', MV_Control_prefix.'MV_Control', array( $this, 'create_setting_cont' ) );
  }

  /**
   * ページの初期化を行います。
   */
  public function page_view() {
  }

  /**
   * 設定ページのHTMLを出力します。
   */
  public function create_setting_cont() {
    // データベーステーブル"options"から名前を指定してオプションの値を取得する
    $this->options = get_option( MV_Control_prefix.'MV_Control' );

    echo '<div class="MVControl">';
      echo '<h2 class="MVControl__ttl">MV Control</h2>';

      // add_options_page()で設定のサブメニューとして追加している場合は
      // 問題ありませんが、add_menu_page()で追加している場合
      // options-head.phpが読み込まれずメッセージが出ない(※)ため
      // メッセージが出るようにします。
      // ※ add_menu_page()の場合親ファイルがoptions-general.phpではない
      global $parent_file;
      if ( $parent_file != 'options-general.php' ) {
        require(ABSPATH . 'wp-admin/options-head.php');
      }

      echo '<div class="MVControl__createMV">';
        echo '<p class="MVControl__createMV__btn"><button type="button" class="button-primary">デモを確認する</button></p>';
        echo '<div class="MVControl__createMV__modal">';
          create_mv( $this->options );
          echo '<p class="MVControl__createMV__modal--close"><a href="#">閉じる</a></p>';
        echo '</div>';
      echo '</div>';

      echo '<form method="post" action="options.php">';
        // 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。
        settings_fields( MV_Control_prefix.'MV_Control' );

        echo '<div class="MVControl__wrapper">';
          $length = 0;
          // echo '<pre>';
          //   var_dump( $this->options );
          // echo '</pre>';
          if ( is_array( $this->options ) ) {
            foreach ( $this->options as $index => $array ) {
              if ( !is_array( $array ) ) {
                continue;
              }

              $img_pc  = isset( $array['img']['img_pc'] ) ? $array['img']['img_pc'] : '';
              $img_sp  = isset( $array['img']['img_sp'] ) ? $array['img']['img_sp'] : '';
              $link    = isset( $array['link'] ) ? $array['link'] : '';
              $blank   = isset( $array['blank'] ) ? $array['blank'] : '';
              $checked = isset( $array['blank'] ) && $array['blank'] === 'true' ? ' checked' : '';

              echo '<div class="MVControl__item" id="MVControl__item--'.$length.'">';
                echo '<div class="MVControl__item__head">';
                  echo '<h3 class="MVControl__item__ttl">MV Item'.( $length + 1 ).'<a href="#"></a></h3>';
                  echo '<ul class="MVControl__item__thumbnail"></ul>';
                echo '</div>';

                echo '<div class="MVControl__item__inner">';
                  echo '<div class="MVControl__uiArea">';
                    $class = $img_pc !== '' ? ' view' : '';
                    echo '<div class="MVControl__uiBox MVControl__uiBox--pc'.$class.'">';
                      echo '<h4 class="MVControl__uiTtl">PC</h4>';

                      $style = $img_pc !== '' ? 'background-image: url('.$img_pc.')' : '';
                      echo '<p class="MVControl__views" style="'.$style.'"></p>';

                      echo '<ul class="MVControl__uiBtn">';
                        echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--add"><button type="button" class="button-primary">PC用の画像を選択</button></li>';
                        echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--change"><button type="button" class="button-primary">PC用の画像を変更</button></li>';
                        echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--del"><button type="button">PC用の画像を削除</button></li>';
                      echo '</ul>';

                      echo '<input type="hidden" name="img_pc['.$length.']" value="'.$img_pc.'">';
                    echo '</div>';

                    $class = $img_sp !== '' ? ' view' : '';
                    echo '<div class="MVControl__uiBox MVControl__uiBox--sp'.$class.'">';
                      echo '<h4 class="MVControl__uiTtl">SP</h4>';

                      $style = $img_sp !== '' ? 'background-image: url('.$img_sp.')' : '';
                      echo '<p class="MVControl__views" style="'.$style.'"></p>';

                      echo '<ul class="MVControl__uiBtn">';
                        echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--add"><button type="button" class="button-primary">SP用の画像を選択</button></li>';
                        echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--change"><button type="button" class="button-primary">SP用の画像を変更</button></li>';
                        echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--del"><button type="button">SP用の画像を削除</button></li>';
                      echo '</ul>';

                      echo '<input type="hidden" name="img_sp['.$length.']" value="'.$img_sp.'">';
                    echo '</div>';
                  echo '</div>';

                  echo '<div class="MVControl__inputArea">';
                    echo '<div class="MVControl__input__anchor">';
                      echo '<p class="MVControl__input__link"><label>リンク : <input type="url" name="link['.$length.']" value="'.$link.'" autocomplete></label></p>';

                      echo '<p class="MVControl__input__blank"><label><input type="checkbox" name="blank['.$length.']" value="true"'.$checked.'>blank</label></p>';
                    echo '</div>';
                  echo '</div>';
                  echo '<p class="MVControl__delBox"><button type="button">コンテンツを削除</button></p>';
                echo '</div>';
              echo '</div>';

              ++$length;
            }
          }

          echo '<div class="MVControl__item" id="MVControl__item--'.$length.'">';
            echo '<div class="MVControl__item__head">';
              echo '<h3 class="MVControl__item__ttl">MV Item'.( $length + 1 ).'<a href="#"></a></h3>';
              echo '<ul class="MVControl__item__thumbnail"></ul>';
            echo '</div>';

            echo '<div class="MVControl__item__inner">';
              echo '<div class="MVControl__uiArea">';
                echo '<div class="MVControl__uiBox MVControl__uiBox--pc">';
                  echo '<h4 class="MVControl__uiTtl">PC</h4>';

                  echo '<p class="MVControl__views" style=""></p>';

                  echo '<ul class="MVControl__uiBtn">';
                    echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--add"><button type="button" class="button-primary">PC用の画像を選択</button></li>';
                    echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--change"><button type="button" class="button-primary">PC用の画像を変更</button></li>';
                    echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--del"><button type="button">PC用の画像を削除</button></li>';
                  echo '</ul>';

                  echo '<input type="hidden" name="img_pc['.$length.']" value="">';

                echo '</div>';

                echo '<div class="MVControl__uiBox MVControl__uiBox--sp">';
                  echo '<h4 class="MVControl__uiTtl">SP</h4>';

                  echo '<p class="MVControl__views" style=""></p>';

                  echo '<ul class="MVControl__uiBtn">';
                    echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--add"><button type="button" class="button-primary">SP用の画像を選択</button></li>';
                    echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--change"><button type="button" class="button-primary">SP用の画像を変更</button></li>';
                    echo '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--del"><button type="button">SP用の画像を削除</button></li>';
                  echo '</ul>';

                  echo '<input type="hidden" name="img_sp['.$length.']" value="">';
                echo '</div>';
              echo '</div>';
              echo '<div class="MVControl__inputArea">';
                echo '<div class="MVControl__input__anchor">';
                  echo '<p class="MVControl__input__link"><label>リンク : <input type="url" name="link['.$length.']" value="" autocomplete></label></p>';

                  echo '<p class="MVControl__input__blank"><label><input type="checkbox" name="blank['.$length.']" value="true">blank</label></p>';
                echo '</div>';
              echo '</div>';

              echo '<p class="MVControl__delBox"><button type="button">コンテンツを削除</button></p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';

        echo '<div class="MVControl__addBox"><button type="button" class="button-primary">追加</button></div>';

        // 送信ボタンを出力します。
        submit_button();
      echo '</form>';
    echo '</div>';
    echo '<!-- /.wrap -->';
  }


  /**
   * ページの保存処理を行います。
   */
  public function page_save() {
    // 設定を登録します(入力値チェック用)。
    // register_setting( $option_group, $option_name, $sanitize_callback )
    //   $option_group      : 設定のグループ名
    //   $option_name       : DBに登録する名前
    //   $sanitize_callback : オプションの値をサニタイズするためのコールバック関数
    register_setting( MV_Control_prefix.'MV_Control', MV_Control_prefix.'MV_Control', array( $this, 'sanitize' ) );
  }
  /**
   * 送信された入力値の保存
   *
   * @param array $input 設定値
   */

  /**
   * サニタイズ
   */
  public function sanitize( $input ) {
    $new_input = array();

    // $new_input = $input;
    if ( isset( $_POST['img_pc'] ) ) {
      $_POST['img_pc'] = array_values($_POST['img_pc']);
      foreach ( $_POST['img_pc'] as $index => $value ) {
        if ( $value !== '' ) {
          $new_input[$index]['img']['img_pc'] = $value;
        }
        continue;
      }
    }
    if ( isset( $_POST['img_sp'] ) ) {
      $_POST['img_sp'] = array_values($_POST['img_sp']);
      foreach ( $_POST['img_sp'] as $index => $value ) {
        if ( $value !== '' ) {
          $new_input[$index]['img']['img_sp'] = $value;
        }
        continue;
      }
    }
    if ( isset( $_POST['link'] ) ) {
      foreach ( $_POST['link'] as $index => $value ) {
        if ( $value !== '' ) {
          $new_input[$index]['link'] = $value;
        }
        continue;
      }
    }
    if ( isset( $_POST['blank'] ) ) {
      foreach ( $_POST['blank'] as $index => $value ) {
        if ( $value !== '' ) {
          $new_input[$index]['blank'] = $value;
        }
        continue;
      }
    }

    ksort($new_input);
    $new_input = array_values($new_input);
    return $new_input;
  }
}
