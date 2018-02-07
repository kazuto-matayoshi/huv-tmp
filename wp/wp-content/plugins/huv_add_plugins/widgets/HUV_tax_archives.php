<?php
  class HUV_tax_archives extends WP_Widget {
    private $classname = 'tax_archives';
    private $readTxt   = 'チェックしたカテゴリのリンクを一覧で表示します。';

    /**
     * Widgetを登録する
     */
    function __construct() {
      $widget_ops = array(
        'classname'   => $this->classname,
        'description' => __( $this->readTxt ),
        'customize_selective_refresh' => true,
      );
      parent::__construct( $this->classname, 'カテゴリ一覧', $widget_ops );
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

      $huv_tax_archives = isset( $instance['huv_tax_archives'] )
                        ? $instance['huv_tax_archives']
                        : '';

      // カテゴリの一覧を取得します
      $args = array(
                'public' => true
              );
      $taxonomies = get_taxonomies( $args );



      /*---------------*\
       |               |
       |    out put    |
       |               |
      \*---------------*/

      if ( $huv_tax_archives ) {
        // 書き出し
        if ( isset( $args['before_widget'] ) ) {
          echo $args['before_widget'];
        }
        ?>
          <section class="widget__item widget__item--<?php echo $this->classname; ?>">
            <h4 class="widget__item__ttl widget__item__ttl--<?php echo $this->classname; ?>">KEYWORD</h4>
            <ul class="widget__item__list widget__item__list--<?php echo $this->classname; ?>">
            <?php
              foreach ( $huv_tax_archives as $key => $tax ) {
                $args = array(
                  'hide_empty' => false,
                );
                $tarms = get_terms( $tax, $args );

                if ( get_taxonomy( $tax ) ) {
                  $taxonomy_name = get_taxonomy( $tax )->label;
                  foreach ($tarms as $key => $tarm) {
                    echo '<li class="widget__item__links widget__item__links--'.$this->classname.'">';
                      echo '<a href="/'.$tarm->taxonomy.'/'.$tarm->slug.'/">'.$tarm->name.'</a>';
                    echo '</li>';
                  }
                }
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

      $huv_tax_archives      = isset( $instance['huv_tax_archives'] )
                             ? $instance['huv_tax_archives']
                             : '';

      // inputのIDとして使用する際には必須
      $huv_tax_archives_id   = $this->get_field_id('huv_tax_archives');

      // inputのnameとして使用するので必須
      $huv_tax_archives_name = $this->get_field_name('huv_tax_archives').'[]';

      // カテゴリの一覧を取得します
      $args = array(
                  'public' => true
              );
      $taxonomies = get_taxonomies( $args );



      /*---------------*\
       |               |
       |    out put    |
       |               |
      \*---------------*/

      echo '<p>'.$this->readTxt.'</p>';

      /** 取得したカテゴリ一覧を出力します */
      if ( count( $taxonomies ) != 0 ) :
        echo '<ul>';
          foreach ( $taxonomies as $i => $tax ) :

            // カテゴリ名の取得
            $taxonomy_name = get_taxonomy( $tax )->label;

            // checkedの判定
            $checked = '';
            if ( $huv_tax_archives
                 && array_search( $tax, $huv_tax_archives ) !== false
               ) {
              $checked = ' checked="checked"';
            }

            echo '<li>';
              echo '<input id="'.$huv_tax_archives_id.'-'.$i.'" type="checkbox" name="'.$huv_tax_archives_name.'" value="'.$tax.'"'.$checked.'>';

              // echo '<label for="'.$huv_tax_archives_id.'-'.$i.'">'.$tax.'</label>';

              echo '<label for="'.$huv_tax_archives_id.'-'.$i.'">'.$taxonomy_name.'</label>';
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
