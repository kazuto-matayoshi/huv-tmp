<?php
  class HUV_pv_archives extends WP_Widget {
    private $classname = 'pv_archives';
    private $readTxt   = '週間と月間の取得';

    /**
     * Widgetを登録する
     */
    function __construct() {
      $widget_ops = array(
        'classname'   => $this->classname,
        'description' => __( $this->readTxt ),
        'customize_selective_refresh' => true,
      );
      parent::__construct( $this->classname, 'PV数による投稿の取得', $widget_ops );
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

      $huv_pv_archives = isset( $instance['huv_pv_archives'] )
                       ? $instance['huv_pv_archives']
                       : '';

      $huv_pv_view_nom = isset( $instance['huv_pv_view_nom'] )
                         && ctype_digit( $instance['huv_pv_view_nom'] )
                       ? $instance['huv_pv_view_nom']
                       : 0;

      // global $wpdb;
      // $weekly_results = $wpdb->get_results("
      //   SELECT * 
      //   FROM  `wp_postmeta` 
      //   WHERE  `meta_key` =  'weekly_post_views_count'
      //   ORDER BY  `wp_postmeta`.`meta_value` DESC
      //   LIMIT 0, $huv_pv_view_nom
      // ");
      // foreach ( $weekly_results as $i => $value ) {
      //   $weekly_id[]    = $value->post_id;
      //   $weekly_count[] = get_post_meta( $value->post_id, 'weekly_post_views_count', true );
      //   // $type[]  = get_post_meta( $value->post_id, 'post_views_type', true );
      // }

      // $monthly_results = $wpdb->get_results("
      //   SELECT * 
      //   FROM  `wp_postmeta` 
      //   WHERE  `meta_key` =  'monthly_post_views_count'
      //   ORDER BY  `wp_postmeta`.`meta_value` DESC
      //   LIMIT 0, $huv_pv_view_nom
      // ");
      // foreach ( $monthly_results as $i => $value ) {
      //   $monthly_id[]    = $value->post_id;
      //   $monthly_count[] = get_post_meta( $value->post_id, 'monthly_post_views_count', true );
      //   // $type[]  = get_post_meta( $value->post_id, 'post_views_type', true );
      // }

      /**
       * get_weekly_post_views()
       * @return array
       * @declaration HUV_pv_get.php
       *
       * get_monthly_post_views()
       * @return array
       * @declaration HUV_pv_get.php
       */
      $weekly_results  = get_weekly_post_views( $huv_pv_view_nom );
      $monthly_results = get_monthly_post_views( $huv_pv_view_nom );

      /*---------------*\
       |               |
       |    out put    |
       |               |
      \*---------------*/

      if ( $monthly_results || $weekly_results ) {
        // 書き出し
        echo '<script src="'.plugins_url().'/huv_add_plugins/pv-counter/assets/js/huv_pv_counter.js"></script>';
        if ( isset( $args['before_widget'] ) ) {
          echo $args['before_widget'];
        }
        ?>
          <section class="widget__item widget__item--<?php echo $this->classname; ?>">
            <h4 class="widget__item__ttl widget__item__ttl--<?php echo $this->classname; ?>">RANKING</h4>
            <ul class="<?php echo $this->classname; ?>__tab">
              <li class="<?php echo $this->classname; ?>__tab__item <?php echo $this->classname; ?>__tab__item--weekly">
                <p class="pv_archives__trigger pv_archives__trigger--weekly on">
                  <span>Weekly</span>
                </p>
                <?php if ( $weekly_results ) : ?>
                  <ol class="<?php echo $this->classname; ?>__list <?php echo $this->classname; ?>__list--weekly">
                    <?php
                      // weekly
                      foreach ( $weekly_results as $weekly_key => $weekly_val ) {
                        $title     = $weekly_val['title'];
                        $permalink = $weekly_val['permalink'];
                        echo '<li class="widget__item__links widget__item__links--'.$this->classname.'">';
                          echo '<a href="'.$permalink.'">'.$title.'</a>';
                        echo '</li>';
                      }
                    ?>
                  </ol>
                <?php else: ?>
                  <p class="pv_archives__list">Sorry... Nothing Data.</p>
                <?php endif; ?>
              </li>

              <li class="<?php echo $this->classname; ?>__tab__item <?php echo $this->classname; ?>__tab__item--monthly">
                <p class="pv_archives__trigger pv_archives__trigger--monthly">
                  <span>Monthly</span>
                </p>
                <?php if ( $monthly_results ) : ?>
                  <ol class="<?php echo $this->classname; ?>__list <?php echo $this->classname; ?>__list--monthly">
                    <?php
                      // monthly
                      foreach ( $monthly_results as $monthly_key => $monthly_val ) {
                        $title     = $monthly_val['title'];
                        $permalink = $monthly_val['permalink'];
                        echo '<li class="widget__item__links widget__item__links--'.$this->classname.'">';
                          echo '<a href="'.$permalink.'">'.$title.'</a>';
                        echo '</li>';
                      }
                    ?>
                  </ol>
                <?php else: ?>
                  <p class="pv_archives__list">Sorry... Nothing Data.</p>
                <?php endif; ?>
              </li>
            </ul>
          </section>
        <?php
        if ( isset( $args['after_widget'] ) ) {
          echo $args['after_widget'];
        }
      }
      else {
        echo '<p>Sorry... Nothing Data.</p>';
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

      $huv_pv_archives      = isset( $instance['huv_pv_archives'] )
                            ? $instance['huv_pv_archives']
                            : '';

      // inputのIDとして使用する際には必須
      $huv_pv_archives_id   = $this->get_field_id('huv_pv_archives');

      // inputのnameとして使用するので必須
      $huv_pv_archives_name = $this->get_field_name('huv_pv_archives').'[]';

      // 投稿タイプの一覧を取得
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
            if (
              get_post_type_object( $post_type )->name !== "attachment"
            ) :
              // checkedの判定
              $checked = '';
              if ( $huv_pv_archives
                   && array_search( $post_type, $huv_pv_archives ) !== false
                 ) {
                $checked = ' checked="checked"';
              }

              echo '<li>';
                echo '<input id="'.$huv_pv_archives_id.'-'.$i.'" type="checkbox" name="'.$huv_pv_archives_name.'" value="'.$post_type.'"'.$checked.'>';

                // echo '<label for="'.$huv_pv_archives_id.'-'.$i.'">'.$post_type.'</label>';

                echo '<label for="'.$huv_pv_archives_id.'-'.$i.'">'.$post_type_name.'</label>';
              echo '</li>';
            endif;
          endforeach;
        echo '</ul>';
      endif;

      $huv_pv_view_nom = isset( $instance['huv_pv_view_nom'] )
                       ? $instance['huv_pv_view_nom']
                       : '';

      echo '<p>';
        echo '<label for="'.$huv_pv_view_nom.'">表示する投稿数</label>';
        echo '<input type="number"
                     name="'.$this->get_field_name('huv_pv_view_nom').'"
                     id ="'.$huv_pv_view_nom.'"
                     value="'.$huv_pv_view_nom.'">';
      echo '</p>';
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
