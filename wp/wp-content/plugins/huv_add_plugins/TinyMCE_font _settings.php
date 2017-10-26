<?php
/*******************************************************************************
Plugin Name: TinyMCE Font Settings
Description: TinyMCEのfont-familyを調整します。
Version: 1.0
*/
add_filter('tiny_mce_before_init', 'my_custum_tiny_fonts');

function my_custum_tiny_fonts($settings) {

	$setfonts = array(
		'Andale Mono'      => 'andale mono,times',
		'Arial'            => 'arial,helvetica,sans-serif',
		'Arial Black'      => 'arial black,avant garde',
		'Book Antiqua'     => 'book antiqua,palatino',
		'Comic Sans MS'    => 'comic sans ms,sans-serif',
		'Courier New'      => 'courier new,courier',
		'Georgia'          => 'georgia,palatino',
		'Helvetica'        => 'helvetica',
		'Impact'           => 'impact,chicago',
		'Symbol'           => 'symbol',
		'Tahoma'           => 'tahoma,arial,helvetica,sans-serif',
		'Terminal'         => 'terminal,monaco',
		'Times New Roman'  => 'times new roman,times',
		'Trebuchet MS'     => 'trebuchet ms,geneva',
		'Verdana'          => 'verdana,geneva',
		'Webdings'         => 'webdings',
		'Wingdings'        => 'wingdings,zapf dingbats',

		// 日本語
		/* ゴシック */
		'游ゴシック'       => '游ゴシック, YuGothic, sans-serif',
		'ＭＳ ゴシック'    => 'ＭＳ Ｐゴシック, sans-serif',
		'MS UI Gothic'     => 'MS UI Gothic, sans-serif',
		'ヒラギノ角ゴ'     => 'ヒラギノ角ゴ Pro W3, Hiragino Kaku Gothic Pro, sans-serif',
		'メイリオ'         => 'メイリオ, Meiryo, sans-serif',
		/* 明朝 */
		'游明朝'           => '游明朝, YuMincho, serif',
		'ＭＳ 明朝'        => 'ＭＳ 明朝, MS Mincho, serif',
		'ＭＳ Ｐ明朝'      => 'ＭＳ Ｐ明朝, MS PMincho, serif',
		'ヒラギノ明朝'     => 'ヒラギノ明朝 ProN W6, HiraMinProN-W6, serif',
		'HG明朝E'          => 'HG明朝E, serif',
	);

	$fontstr = "";
	foreach( $setfonts as $k => $v ) {
		$fontstr .= $k."=".$v.";";
	}

	$settings['font_formats'] = $fontstr;
	return $settings;
}

