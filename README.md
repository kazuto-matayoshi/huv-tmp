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
1. [page/tmpl.php](#pagetmplphp)
1. [page/loop-tmpl.php](#pageloop-tmplphp)
1. [archive.php](#archivephp)
1. [search.php](#searchphp)
1. [searchform.php](#searchformphp)
1. [single.php](#singlephp)
1. [404.php](#404php)
1. [404_content.php](#404contentphp)
1. [functions - 概要](#functions---概要)

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
		<title>All in One SEO Setting Title</title>
		<!-- icon -->
		<link rel="shortcut icon" href="/img/favicon.ico">

		<!-- IE対策 -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- その他設定 -->
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width">

		<!-- CSS -->
		<link rel="stylesheet" href="/css/normalize.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
さまざまな分岐を行ったうえで
該当のページファイルがない場合に表示されます。

TOPページの表示処理は
front-page.phpで行います。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## front-page.php
---
TOPページの表示で使います。
初期の記載として、新着を取得するコードを書いています。
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
※使用する際は<form>の内側に<div class="form_box">を生成してください。

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
各固定ページの分岐用のページです。
固定ページを作る際には『(スラッグ名).php』という命名規則で作成してください。

子ページについてですが、作成する際は
『/(テーマディレクトリ)/page/(親スラッグ名)-(子ページのスラッグ名).php』というディレクトリ構成、命名規則で作成してください。

<\*-- 例 --\*>

テーマ名  -> base<br>
親スラッグ -> parent<br>
子スラッグ -> child
```
/base/page/parent-child.php
```
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## page/tmpl.php
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

このファイルは基本的にゴミ扱いなので
不要になった時点で削除してください。

(※リネームでの作業を推奨します。)
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## page/loop-tmpl.php
---
固定ページのloop用のテンプレートです。

新着一覧などを利用時にリネームなどしてお使いください。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## archive.php
---

記事のアーカイブを取得し、表示するファイルです。<br>
ポストタイプを判定し、archive内にファイルがあれば
そのファイルを見に行きます。

なければそのままコンテンツを表示します。
（※404にすべきか検討中）

また、命名規則、ディレクトリ構成は
下記の通りです。

```
/base/archive/投稿タイプ名.php
```
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## taxonomy.php
---

カスタム投稿のカテゴリ一覧を表示するテンプレートファイル（仮）です。

初期からある『投稿』のカテゴリは『category.php』になります。<br>
（※category.phpは未準備）

```
/base/taxonomy/投稿タイプ名.php
```
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## search.php
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

記事詳細を取得し、表示するファイルです。
ポストタイプを判定し、single/内にファイルがあれば
そのファイルを見に行きます。

ない場合は管理画面の投稿画面で入力されたコンテンツが
そのまま表示されます。

命名規則、ディレクトリ構成は下記の通りです。

```
/base/single/投稿タイプ名.php
```
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## 404.php
---

404を表示するファイルです。<br>
コンテンツは『404_content.php』内に記述しております。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## 404_content.php
---

404をコンテンツを表示するファイルです。

別ページで404を表示したい際に404.phpを読み込むと<br>
header、footerの重複が起こる為コンテンツ部分を分離しました。

アーカイブなどのページで404を表示したい場合は<br>
get_template_part関数で呼び出してください。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>

---
## functions - 概要
---

関数について記述はすべてfunction内にあります。  

head内の表示関係をまとめた、【creanup.php】<br>
管理画面に関係する関数をまとめた、【init.php】<br>
カスタム投稿の関数をまとめた、【custom-post.php】<br>
ウィジェットに関する関数をまとめた、【widget.php】

上記で主に構成され、
その他追加関数はfunctions.phpに記述しています。

さらに細かい部分はファイルまたは、[wiki](https://github.com/kazuto-matayoshi/huv-tmp/wiki/functions.php%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6)を確認してください。
<br><br><br>
 - [上部へ戻る](#huvrid用テンプレートファイルの説明)
<br><br><br>
