<?php
class HUV_posts_count extends WP_Widget {
  private $classname = 'posts_count';
  private $readTxt   = 'チェックした投稿タイプのリンクと記事数を表示します。';

  /**
   * Widgetを登録する
   */
  function __construct() {
    $widget_ops = array(
      'classname'   => $this->classname,
      'description' => __( $this->readTxt ),
      'customize_selective_refresh' => true,
    );
    parent::__construct( $this->classname, '投稿数のカウント', $widget_ops );
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

    $huv_posts_count = isset( $instance['huv_posts_count'] )
                     ? $instance['huv_posts_count']
                     : '';


    /*---------------*\
     |               |
     |    out put    |
     |               |
    \*---------------*/

    if ( $huv_posts_count ) {
      // 書き出し
      if ( isset( $args['before_widget'] ) ) {
        echo $args['before_widget'];
      }
      ?>
        <section class="widget__item widget__item--<?php echo $this->classname; ?>">
          <h4 class="widget__item__ttl widget__item__ttl--<?php echo $this->classname; ?>">CATEGORY</h4>
          <ul class="widget__item__list widget__item__list--<?php echo $this->classname; ?>">
          <?php
            foreach ( $huv_posts_count as $key => $post_type ) {
              $post_type_name = get_post_type_object( $post_type )->labels->singular_name;
              $count_posts    = wp_count_posts( $post_type );
              $show_txt       = $post_type_name.'（'.$count_posts->publish.'）';
              echo '<li class="widget__item__links widget__item__links--'.$this->classname.'">';
                echo '<a href="'.get_post_type_archive_link( $post_type ).'">'.$show_txt.'</a>';
              echo '</li>';
            }
          ?>
          </ul>
        </section>
      <?php
      if ( isset( $args['after_widget'] ) ) {
        echo $args['after_widget'];
      }
    }
  }

  /**
   * Widget管理画面を出力する
   *
   * @param array $instance 設定項目
   * @return string|void
   */
  public function form( $instance ) {

    /*-----------------*\
     |                 |
     |    Variables    |
     |                 |
    \*-----------------*/

    $huv_posts_count      = isset( $instance['huv_posts_count'] )
                          ? $instance['huv_posts_count']
                          : '';

    // inputのIDとして使用する際には必須
    $huv_posts_count_id   = $this->get_field_id('huv_posts_count');

    // inputのnameとして使用するので必須
    $huv_posts_count_name = $this->get_field_name('huv_posts_count').'[]';

    // 投稿タイプの一覧を取得します
    $args = array(
                'public' => true
            );
    $post_types = get_post_types( $args );


    /*---------------*\
     |               |
     |    out put    |
     |               |
    \*---------------*/

    echo '<p>'.$this->readTxt.'</p>';

    /** 取得した投稿タイプ一覧を出力します */
    if ( count( $post_types ) != 0 ) :
      echo '<ul>';
        foreach ( $post_types as $i => $post_type ) :
          // 投稿タイプ名の取得
          $post_type_name = get_post_type_object( $post_type )->labels->singular_name;

          // checkedの判定
          $checked = '';
          if ( $huv_posts_count
               && array_search( $post_type, $huv_posts_count ) !== false
             ) {
            $checked = ' checked="checked"';
          }

          echo '<li>';
            echo '<input id="'.$huv_posts_count_id.'-'.$i.'" type="checkbox" name="'.$huv_posts_count_name.'" value="'.$post_type.'"'.$checked.'>';

            // echo '<label for="'.$huv_posts_count_id.'-'.$i.'">'.$post_type.'</label>';

            echo '<label for="'.$huv_posts_count_id.'-'.$i.'">'.$post_type_name.'</label>';
          echo '</li>';
        endforeach;
      echo '</ul>';
    endif;
  }

  /**
   * 新しい設定データが適切なデータかどうかをチェックする。
   * 必ず$instanceを返す。さもなければ設定データは保存（更新）されない。
   *
   * @param array $new_instance  form()から入力された新しい設定データ
   * @param array $old_instance  前回の設定データ
   * @return array               保存（更新）する設定データ。falseを返すと更新しない。
   */
  function update( $new_instance, $old_instance ) {
    return $new_instance;
  }
}
