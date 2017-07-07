<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="<?php echo huv_theme_path; ?>/js/common.js"></script>
<script>
  <?php if ( is_page('form_xxx') ) : ?>
  (function($){
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
  })(jQuery);
  <?php endif; ?>
  jQuery(function() {
    var hostname = window.location.hostname;
    var pathname = window.location.pathname;
    var siteURL  = hostname + pathname;

    jQuery("a").click(function(e) {
      var ahref = jQuery(this).attr('href');
      if (ahref.indexOf("siteURL") != -1 || ahref.indexOf("http") == -1 ) {
        ga('send', 'event', '内部リンク', 'クリック', ahref);
      } else {
        ga('send', 'event', '外部リンク', 'クリック', ahref);
      };
    });
  });
</script>
<?php wp_footer(); ?>
</body>
</html>