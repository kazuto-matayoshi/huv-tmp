  </div>
  <!-- / .barba-container --> 
</div>
<!-- / #barba-wrapper -->

<?php wp_footer(); ?>

<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="<?php echo huv_theme_path; ?>assets/js/barba.min.js" async defer></script>
<script src="<?php echo huv_theme_path; ?>assets/js/barba.setting.min.js" async defer></script>
<div id="barba-scripts">
  <script src="<?php echo huv_theme_path; ?>assets/js/lazysizes.min.js" async defer></script>
  <script src="<?php echo huv_theme_path; ?>assets/js/common.js" async defer></script>
  <script>
    (function($){
      <?php if ( is_page('form_xxx') ) : ?>
        // $('.mw_wp_form_input input[name="tell"]')のinput typeをtelに変更
        $('.mw_wp_form_input input[name="tell"]').attr( 'type', 'tel' );

        // $('.mw_wp_form_preview input[name="tell"]')のinput typeをhiddenに変更
        $('.mw_wp_form_preview input[name="tell"]').attr( 'type', 'hidden' );

        // $('select[name="prefectures"] option[value=""]')に対し、『選択してください』の文言を追加
        $('select[name="prefectures"] option[value=""]').html( '選択してください' );

        // 確認画面の際、.form_box内のinput[type="hidden"]のvalue=""の行を消す処理
        $('.mw_wp_form_preview input[type="hidden"]').each(function(){
          if ($(this).val() == "") {
            $(this).parentsUntil(".form_box").hide();
          };
        });
      <?php endif; ?>
      <?php if ( is_singular() ) : ?>
        console.log('test');
      <?php endif; ?>
    })(jQuery);
  </script>
</div>
<!-- / #barba-scripts -->

</body>
</html>