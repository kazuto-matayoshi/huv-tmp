<?php
class mv_control__Options {

  /** 設定値 */
  private $options;

  /**
   * 初期化処理です。
   */
  public function __construct() {
    // メニューを追加します。 -> add_action( 'admin_menu', function );
    add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    // add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );

    // ページの初期化を行います。
    add_action( 'admin_init', array( $this, 'page_view' ) );

    // ページの保存処理を行います。
    add_action( 'admin_init', array( $this, 'page_save' ) );
  }

  /**
   * メニューをメニューバーに追加します。
   */
  public function add_plugin_page() {
    // add_submenu_page ( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    //   $parent_slug: 親メニューのスラッグ名
    //   $page_title: 設定ページの<title>部分
    //   $menu_title: メニュー名
    //   $capability : 権限 ( 'manage_options' や 'administrator' など )
    //   $menu_slug  : メニューのslug
    //   $function  : 設定ページの出力を行う関数


    add_submenu_page(
      MV_Control_prefix.'MV_Control',
      'Options',
      'Options',
      'administrator',
      MV_Control_prefix.'MV_Control_Options',
      array( $this, 'create_option_cont' ),
      '',
      2
    );
  }

  /**
   * ページの初期化を行います。
   */
  public function page_view() {
  }

  /**
   * 設定ページのHTMLを出力します。
   */
  public function create_option_cont() {
    // データベーステーブル"options"から名前を指定してオプションの値を取得する
    $this->options = get_option( MV_Control_prefix.'MV_Control_Options' );


    var_dump( get_option( MV_Control_prefix.'MV_Control_swiperOption' ) );

    echo '<div class="MVControl">';
      echo '<h2 class="MVControl__ttl">MV Control Options</h2>';
      echo '<form method="post" action="options.php">';
        // 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。
        settings_fields( MV_Control_prefix.'MV_Control_Options' );
      ?>
        <div class="MVControl__settingBlock MVControl__settingBlock--navigation">
          <h3 class="MVControl__settingBlock__ttl">ナビゲーション</h3>
          <ul class="MVControl__settingList MVControl__settingList--navigation">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[navigation--navigation]"
                  value="true"
                  <?php
                    echo isset( $this->options['navigation--navigation'] ) &&
                         $this->options['navigation--navigation'] === 'true'
                         ? ' checked'
                         : '';
                  ?>
                >ナビゲーションを使用する</label>
            </li>
          </ul>
        </div>

        <div class="MVControl__settingBlock MVControl__settingBlock--pagination">
          <h3 class="MVControl__settingBlock__ttl">ページネーション</h3>
          <ul class="MVControl__settingList MVControl__settingList--pagination">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[pagination--pagination]"
                  value="true"
                  <?php
                    echo isset( $this->options['pagination--pagination'] ) &&
                         $this->options['pagination--pagination'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >ページネーションを使用する</label>
            </li>
          </ul>
          <ul class="MVControl__settingList MVControl__settingList--type">
            <li>
              <label>
                <input
                  type="radio"
                  name="MV_Control_Options[pagination--type]"
                  value="default"
                  <?php
                    echo isset( $this->options['pagination--type'] ) &&
                         $this->options['pagination--type'] === 'default'
                           ? ' checked'
                           : '';
                  ?>
                >デフォルトのページネーションを使用する</label>
            </li>
            <li>
              <label>
                <input
                  type="radio"
                  name="MV_Control_Options[pagination--type]"
                  value="dynamicBullets"
                  <?php
                    echo isset( $this->options['pagination--type'] ) &&
                         $this->options['pagination--type'] === 'dynamicBullets'
                           ? ' checked'
                           : '';
                  ?>
                >動きのあるページネーションを使用する</label>
            </li>
            <li>
              <label>
                <input
                  type="radio"
                  name="MV_Control_Options[pagination--type]"
                  value="progressbar"
                  <?php
                    echo isset( $this->options['pagination--type'] ) &&
                         $this->options['pagination--type'] === 'progressbar'
                           ? ' checked'
                           : '';
                  ?>
                >進捗ページネーションを使用する</label>
            </li>
            <li>
              <label>
                <input
                  type="radio"
                  name="MV_Control_Options[pagination--type]"
                  value="fraction"
                  <?php
                    echo isset( $this->options['pagination--type'] ) &&
                         $this->options['pagination--type'] === 'fraction'
                           ? ' checked'
                           : '';
                  ?>
                >ページネーションを数字で表示する</label>
            </li>
          </ul>
        </div>

        <div class="MVControl__settingBlock MVControl__settingBlock--scrollbar">
          <h3 class="MVControl__settingBlock__ttl">スクロールバー</h3>
          <ul class="MVControl__settingList MVControl__settingList--scrollbar">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[scrollbar--scrollbar]"
                  value="true"
                  <?php
                    echo isset( $this->options['scrollbar--scrollbar'] ) &&
                         $this->options['scrollbar--scrollbar'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >スクロールバーを使用する</label>
            </li>
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[scrollbar--hide]"
                  value="true"
                  <?php
                    echo isset( $this->options['scrollbar--hide'] ) &&
                         $this->options['scrollbar--hide'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >マウスが乗っていない時は非表示にする</label>
            </li>
          </ul>
        </div>

        <!-- <div class="MVControl__settingBlock MVControl__settingBlock--direction">
          <h3 class="MVControl__settingBlock__ttl">スライダーの方向</h3>
          <ul class="MVControl__settingList MVControl__settingList--direction">
            <li>
              <label>
                <input
                  type="radio"
                  name="MV_Control_Options[direction--direction]"
                  value="horizontal"
                  <?php
                    echo isset( $this->options['direction--direction'] ) &&
                         $this->options['direction--direction'] === 'horizontal'
                           ? ' checked'
                           : '';
                  ?>
                >横方向にスライドさせる</label>
            </li>
            <li>
              <label>
                <input
                  type="radio"
                  name="MV_Control_Options[direction--direction]"
                  value="vertical"
                  <?php
                    echo isset( $this->options['direction--direction'] ) &&
                         $this->options['direction--direction'] === 'vertical'
                           ? ' checked'
                           : '';
                  ?>
                >縦方向にスライドさせる</label>
            </li>
          </ul>
        </div> -->

        <div class="MVControl__settingBlock MVControl__settingBlock--spaceBetween">
          <h3 class="MVControl__settingBlock__ttl">スライダーの余白</h3>
          <ul class="MVControl__settingList MVControl__settingList--spaceBetween">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[spaceBetween--spaceBetween]"
                  value="true"
                  <?php
                    echo isset( $this->options['spaceBetween--spaceBetween'] ) &&
                         $this->options['spaceBetween--spaceBetween'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >スライダーに余白を持たせる</label>
            </li>
            <li>
              <label><input type="number" name="MV_Control_Options[spaceBetween--num]" value="<?php
                echo isset( $this->options['spaceBetween--num'] )
                     ? $this->options['spaceBetween--num']
                     : '';
              ?>" min="0"></label>
            </li>
          </ul>
        </div>

        <div class="MVControl__settingBlock MVControl__settingBlock--grabCursor">
          <h3 class="MVControl__settingBlock__ttl">マウスカーソルの変更</h3>
          <ul class="MVControl__settingList MVControl__settingList--grabCursor">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[grabCursor--grabCursor]"
                  value="true"
                  <?php
                    echo isset( $this->options['grabCursor--grabCursor'] ) &&
                         $this->options['grabCursor--grabCursor'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >マウスカーソルを手袋に変更</label>
            </li>
          </ul>
        </div>

        <div class="MVControl__settingBlock MVControl__settingBlock--loop">
          <h3 class="MVControl__settingBlock__ttl">繰り返し表示</h3>
          <ul class="MVControl__settingList MVControl__settingList--loop">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[loop--loop]"
                  value="true"
                  <?php
                    echo isset( $this->options['loop--loop'] ) &&
                         $this->options['loop--loop'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >繰り返し表示させる</label>
            </li>
          </ul>
        </div>

        <div class="MVControl__settingBlock MVControl__settingBlock--autoplay">
          <h3 class="MVControl__settingBlock__ttl">自動再生</h3>
          <ul class="MVControl__settingList MVControl__settingList--autoplay">
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[autoplay--autoplay]"
                  value="true"
                  <?php
                    echo isset( $this->options['autoplay--autoplay'] ) &&
                         $this->options['autoplay--autoplay'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >自動再生を有効にする</label>
            </li>
            <li>
              <label><input type="number" name="MV_Control_Options[autoplay--delay]" value="<?php
                    echo isset( $this->options['autoplay--delay'] )
                         ? $this->options['autoplay--delay']
                         : '';
                  ?>" min="0">ms</label>
            </li>
            <li>
              <label>
                <input
                  type="checkbox"
                  name="MV_Control_Options[autoplay--disableOnInteraction]"
                  value="true"
                  <?php
                    echo isset( $this->options['autoplay--disableOnInteraction'] ) &&
                         $this->options['autoplay--disableOnInteraction'] === 'true'
                           ? ' checked'
                           : '';
                  ?>
                >ユーザーの操作後に自動再生を無効にする</label>
            </li>
          </ul>
        </div>
      <?php
        // 送信ボタンを出力します。
        submit_button();
      echo '</form>';
    echo '</div>';
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
    register_setting( MV_Control_prefix.'MV_Control_Options', MV_Control_prefix.'MV_Control_Options', array( $this, 'sanitize' ) );
    register_setting( MV_Control_prefix.'MV_Control_Options', MV_Control_prefix.'MV_Control_swiperOption', array( $this, 'json' ) );

  }

  /**
   * サニタイズ
   */
  public function sanitize( $input ) {
    $new_input = array();
    if ( isset( $_POST['MV_Control_Options'] ) ) {
      foreach ( $_POST['MV_Control_Options'] as $key => $value ) {

        // text etc...
        if (
          $key === 'spaceBetween--num' ||
          $key === 'autoplay--delay'
        ) {
          $new_input[$key] = esc_html( $value );
        }

        // radio
        else if (
          $key === 'pagination--type' ||
          $key === 'direction--direction'
        ) {
          $new_input[$key] = esc_html( $value );
        }

        // checkbox
        else {
          if ( $value === 'true' ) {
            $new_input[$key] = $value;
          }
        }
      }
    }

    return $new_input;
  }
  public function json( $input ) {
    $new_input  = array();
    $post_array = $_POST['MV_Control_Options'];

    // ナビゲーションを使用する
    if(
      isset( $post_array['navigation--navigation'] ) &&
      $post_array['navigation--navigation'] === 'true'
    ){
      $new_input['navigation'] = array(
        'nextEl' => '.swiper-button-next',
        'prevEl' => '.swiper-button-prev',
      );
    }

    // ページネーションを使用する
    if(
      isset( $post_array['pagination--pagination'] ) &&
      $post_array['pagination--pagination'] === 'true'
    ){
      $new_input['pagination'] = array(
        'el' => '.swiper-pagination',
      );

      if ( $post_array['pagination--type'] === 'dynamicBullets' ) {
        $new_input['pagination']['dynamicBullets'] = true;
      }
      else if ( $post_array['pagination--type'] === 'progressbar' ) {
        $new_input['pagination']['type'] = 'progressbar';
      }
      else if ( $post_array['pagination--type'] === 'fraction' ) {
        $new_input['pagination']['type'] = 'fraction';
      }
    }

    // スクロールバーを使用する
    if(
      isset( $post_array['scrollbar--scrollbar'] ) &&
      $post_array['scrollbar--scrollbar'] === 'true'
    ){
      $new_input['scrollbar'] = array(
        'el' => '.swiper-scrollbar',
      );

      if ( $post_array['scrollbar--hide'] === 'true' ) {
        $new_input['scrollbar']['hide'] = true;
      }
    }

    // // スライダーの方向
    // if(
    //   isset( $post_array['direction--direction'] ) &&
    //   $post_array['direction--direction'] === 'horizontal'
    // ){
    //   $new_input['direction'] = 'horizontal';
    // }
    // else {
    //   $new_input['direction'] = 'vertical';
    // }

    // スライダーに余白を持たせる
    if(
      isset( $post_array['spaceBetween--spaceBetween'] ) &&
      $post_array['spaceBetween--spaceBetween'] === 'true'
    ){
      $new_input['spaceBetween'] = (int)$post_array['spaceBetween--num'];
    }

    // マウスカーソルを手袋に変更
    if(
      isset( $post_array['grabCursor--grabCursor'] ) &&
      $post_array['grabCursor--grabCursor'] === 'true'
    ){
      $new_input['grabCursor'] = $post_array['grabCursor--grabCursor'];
    }

    // 繰り返し表示
    if(
      isset( $post_array['loop--loop'] ) &&
      $post_array['loop--loop'] === 'true'
    ){
      $new_input['loop'] = true;
    }

    // 自動再生を有効にする
    if(
      isset( $post_array['autoplay--autoplay'] ) &&
      $post_array['autoplay--autoplay'] === 'true'
    ){
      $new_input['autoplay'] = array(
        'delay' => (int)$post_array['autoplay--delay'],
      );
      if(
        isset( $post_array['autoplay--disableOnInteraction'] ) &&
        $post_array['autoplay--disableOnInteraction'] === 'true'
      ){
        $new_input['autoplay']['disableOnInteraction'] = true;
      }
      else {
        $new_input['autoplay']['disableOnInteraction'] = false;
      }
    }


    $new_input = json_encode($new_input);
    return $new_input;
  }
}