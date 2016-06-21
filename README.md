# HUVRID用テンプレートファイルの説明
株式会社HUVRIDのテンプレート管理用


 株式会社 HUVRID / WP theme template

---
 - 目次

1. [header.php](#headerphp)
1. [index.php](#indexphp)
1. [front-page.php](#front-pagephp)
1. [footer.php](#footerphp)
1. [page.php](#pagephp)
1. [page-tmp.php](#page-tmpphp)
1. [archive.php](#archivephp)
1. [search.php](#searchphp)
1. [searchform.php](#searchformphp)
1. [single.php](#singlephp)
1. [function - fn.01 - 概要](#fn01---概要)

---
## header.php
---

共通headerを表示処理をするファイルです。

プラグイン( All In One SEO Pack )を使うことで  
meta周りの調整は済むようになっています。

制作していく際は
- cssの追加
- 共通headerの追加  

などが主なカスタマイズになります。


<\*-- 吐き出し例 --\*>

~~~html
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title></title>
		<!-- icon -->
		<link rel="shortcut icon" href="/img/favicon.ico">

		<!-- IE対策 -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- その他設定 -->
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width">

		<!-- CSS -->
		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/common.css">
		<link rel="stylesheet" href="/css/index.css">
	</head>
<body>
~~~
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## index.php
---
基本的に使いません。
TOPページの表示処理は
front-page.phpで行います。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## front-page.php
---
TOPページの表示で使います。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## footer.php
---
header.php同様
共通footerを表示処理をするファイルです。

- jQuery CDN(ver.2.2.4)の読み込み
- common.js
- Google Analyticsのサポートをするコード (\*1)が常に読み込まれます。

また、MW-WP-Formを使う際の最低限度のjs(\*2)も追加していますので確認お願いします。

-------------------------------------------------------------------------------------------------------

(\*1)のコード
~~~js
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
~~~

---

(\*2)のコード

~~~js
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
~~~
---

<\*-- 吐き出し例 --\*>
~~~html
<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="/js/common.js"></script>
<script>
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
</body>
</html>
~~~
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## page.php
---
各固定ページのスラッグ名(URL部分)で分岐する仕組みで作っています。
固定ページを作る際には『(スラッグ名).php』という命名規則で作成してください。

子ページについてですが、作成する際は
『/(テーマディレクトリ)/(親スラッグ名)/(子ページのスラッグ名).php』というディレクトリ構成、命名規則で作成してください。

<\*-- 例 --\*>

親スラッグ -> parent  
子スラッグ -> child
```
/test-theme/parent/child.php
```
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## page-tmp.php
---
固定ページのテンプレートです。

~~~php
if ( have_posts() ) :
  while ( have_posts() ) :
  	the_post();
  	the_content();
  endwhile;
endif;
~~~

上記コードで
固定ページで入力した値を取得します。

このファイルは基本的にごみ扱いなので
不要になった時点で削除してください。  
(※リネームでの作業を推奨します。)
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## archive.php
---

記事のアーカイブを取得し、表示するファイルです。
固定ページでも代用可能なのでtmpでは404と同じ内容が入っています。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## search.php -
---

検索結果を表示するページのファイルです。
~~~php
<?php get_search_form(); ?>
~~~
上記のコードで後述のsearchform.phpの中身を読み込みます。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## searchform.php
---
前述のsearch.phpで呼び出されるファイルです。

~~~html
<form class="select_area" role="search" method="get" action="<?php echo esc_url( bloginfo('url') ); ?>/">
	<p class="search_area"><input type="search" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></span></button></p>
</form>
~~~

デフォルトでは上記のコードが入っています。
使用上の注意点としては

- `<form>`のアクション属性は変更しないでください(不安定の為)
- `<input type="search">`のname属性は変更しないでください。検索できなくなります。

以上2点です。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## single.php
---

記事詳細を表示するページです。  
注意点などは特にありません。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## fn.01 - 概要
---

関数について記述はすべてfunction内にあります。  
テーマと同階層のfunctions.phpはあくまで入り口の役割を担っているのみです。

ファイルを開くとわかると思いますが

head内の表示関係はcreanup.php  
管理画面に関係する関数群はinit.php  
追加機能はすべてcustom.phpに集約しています。

さらに細かい部分はファイルを見てください。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>
