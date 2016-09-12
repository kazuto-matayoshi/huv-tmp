<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
<script>
	<?php if ( is_page('form_xxx') ) : ?>
	(function($){
		$('.mw_wp_form_input input[name="tell"]').attr( 'type', 'tel' );
		$('select[name="prefectures"] option[value=""]').html( '選択してください' );
		$('.mw_wp_form_preview input[name="tell"]').attr( 'type', 'hidden' );
		$('.mw_wp_form_preview input[type="hidden"]').each(function(){
			if ($(this).val() == "") {
				$(this).parentsUntil(".form_box").hide();
			};
		});
		if ($('.mw_wp_form_preview').length) $('.apply_ttl').hide();
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