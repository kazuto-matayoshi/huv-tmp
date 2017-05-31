# HUVRID用Coding guidelines



- 目次

1. [対応OS,Device,Monitor size](#1対応osdevicemonitorsize)
    1. [1-1. OS](#1-1-os)
    1. [1-2. browser](#1-2-browser)
    1. [1-3. Monitor size](#1-3-monitorsize)
1. [制作環境](#2制作環境)
    1. [2-1. デザインツール](#2-1-デザインツール)
    1. [2-2. エディター](#2-2-エディター)
    1. [2-3. ビルドツール](#2-3-ビルドツール)
    1. [2-4. Git管理](#2-4-git管理)
    1. [2-5. ディレクトリ構造](#2-5-ディレクトリ構造)
1. [基本規則](#3基本規則)
    1. [3-1. エンコード](#3-1-エンコード)
    1. [3-2. インデント](#3-2-インデント)
    1. [3-3. 命名規則](#3-3-命名規則)
        1. [3-3-1. BEMの命名規則](#3-3-1-bemの命名規則)
    1. [3-4. 大文字/小文字](#3-4-大文字小文字)
    1. [3-5. コメント](#3-5-コメント)
1. [HTML](#4html)
    1. [4-1. 基本ルール](#4-1-基本ルール)
    1. [4-2. プロトコル](#4-2-プロトコル)
    1. [4-3. Type属性](#4-3-type属性)
    1. [4-4. タグ](#4-4-タグ)
1. [CSS](#5css)
    1. [5-1. 命名規則-レギュレーション](#5-1-命名規則-レギュレーション)
    1. [5-2. Breakpoint](#5-2-breakpoint)
1. [JavaScript](#6javascript)
    1. [6-1. レギュレーション](#5-1-レギュレーション)
1. [WP](#7wp)
    1. [7-1. バージョン](#7-1-バージョン)
    1. [7-2. プラグイン](#7-2-プラグイン)
    1. [7-3. ビジュアルエディタ部分の書き出し](#7-3-ビジュアルエディタ部分の書き出し)

<br>

---

<br>

## 1.【対応OS,device,Monitor size】
基本的に最新で対応。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 1-1. OS
■ PC
- Windows 8.1 - 10
- Mac OSX 最新

■ mobile
- iOS 最新
- Android 最新

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 1-2. browser
各バージョンは最新とする。

■ PC
- Google Chrome
- Firefox
- Safari
- Microsoft Edge
- Interne Explorer 11 （ユーザ使用率と業界内の動向を確認）

■ mobile
- Google Chrome
- Safari

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 1-3. Monitor size

■ PC<br>
通常多く流通している画像解像度を考慮して設定。<br>
プロジェクターでの表示は考慮しない。<br>
Full HD（1920 x 1080）での表示を基本とする。

■ Tablet<br>
iPadを基準にする。<br>
768 x 1024

■ mobile<br>
iPhone 6を基準に。<br>
AndroidはXperiaやGalaxyなど流通量の多く、且つトレンドなdeviceを考慮する。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

## 2.【制作環境】
コーディングは以下の制作ツールを使用を前提して業務に従事する。

- デザインツール
- エディター
- Git管理
- ビルドツール

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 2-1. デザインツール
デザイナーが使用するツールを同様に使用する。
また書き出しはプラグインやJSXで自動書き出しできるように工夫する。
具体的には以下になる。

- Adobe Photoshop CC
- Adobe Illustrator CC
- Adobe Experience Design CC （XD）
- Adobe Fireworks CS6 （レガシースキーム）

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 2-2. エディター
コーディングに用いるエディターは以下を使用するようにする。

- Visual Studio Code
- Sublime Text 3
- Atom
- Brackets
- Adobe Dreamweaver CC


上記では以下のような機能をプラグインなどの形で事前に入れておく。

- Emmet
- Beatify
- CSS Lint
- Lorem ipsum
- Syntax HighLight
- Markdown Preview
- Convert to UTF-8 (Multi-Encoding)
- minimap
- Code folding
- Indent Guild
- W3C Validator
- css comb

上記の機能がすでに実装されている場合、近似しているプラグインがエディターについている場合はその機能を使用する。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 2-3. ビルドツール
Sass/Scssのコンパイルビルドとして「Prepros」を使用。<br>
タスクランナーの「gulp.js」、「Grunt」なども使用してよい。<br>
画像の圧縮は「TinyPng」などのWebサービスを使用して良い。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 2-4. Git管理
GitのGUIツール「SourceTree」を使用。<br>
また複数人での共有の場合は、「Backlog」にてプロジェクトを立ち上げ、リモートリポジトリを使用する。<br>
※WordPressでのgitignore の設定は、後述のWordPressの項目で記載する。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 2-5. ディレクトリ構造
基本的に以下の通りとする。<br>

/ - document root -<br>
　┝ css/<br>
　│　┝ normalize.css - default -<br>
　│　┝ common.css - サイト全体の共通css -<br>
　│　└pagename.css - ページごとのcss -<br>
　┝ img/<br>
　│　┝ pagename/ - 下層ごとにディレクトリを設置 -<br>
　┝ js/ - JSディレクトリ -<br>
　│ 　└ common.js - セットJS jqueryは基本的にCDNのload -<br>
　┝ scss/ - ページごとorディレクトリごとにscssファイル作成 -<br>
　│　┝ common.scss - サイト全体の共通scss -<br>
　│　└ pagename.scss - ページごとのscss -<br>
　┝ index.html - トップページ -<br>
　└ pagename.html - ページのHTML -

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

## 3.【基本規則】

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 3-1. エンコード
UTF-8のみとする。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 3-2. インデント
インデントは半角2スペース。<br>
エディタのtabキーの設定が必要。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 3-3. 命名規則
「BEM」を命名規則の準拠とする。

■ BEMの基本
- Blockは単語。
- BlockとElementは「アンスコ:2 (__)」で繋ぐ。
- BlockまたはElementとModifierは「ハイフン:2 (--)」で繋ぐ。

### 3-3-1. BEMの命名規則
- 使用単語にはその箇所を表す適切な英単語を用いる。
- 省略できる単語はできるだけ省略形式で記述する。[(\*1)](#1-単語の省略について)
- 3語以上の連結は可能な限り避ける。
- Modifierで使用した単語は独立して存在してはいけない。
- キャメルケースで書く場合は単語間の区切りの際に使用する。<br>
(例 : box__subtitle ⇒ box__subTitle)


#### Example

【HTML】
~~~html
<!-- Block + Element -->
<div class="box">
    <h2 class="box__ttl">タイトル</h2>
    <p class="box__txt">テキスト</p>
</div>

<!-- Block + Modifier -->
<div class="box box--white">
    <h2 class="box__ttl">背景が白いコンテンツ内にあるタイトル</h2>
</div>

<!-- Block + Element + Modifier -->
<div class="box">
    <h2 class="box__ttl">標準</h2>
    <h2 class="box__ttl box__ttl--big">大</h2>
    <h2 class="box__ttl box__ttl--small">小</h2>
</div>

<!-- Block + Element + Element -->
<div class="box">
    <div class="box__inner">
        <h2 class="box__inner__ttl">タイトル</h2>
        <p class="box__inner__txt">テキスト</p>
    </div>
</div>

<!-- Block + Modifier + Element -->
<div class="box box--white">
    <h2 class="box__ttl box--white__ttl">タイトル</h2>
</div>

【※補足】
Modifierとして拡張された要素の、パーツとして定義したい場合に使用。
前述した『Block + Modifier』のさらに細かく指定する場合に使用します。

~~~

【SCSS】
~~~scss
// .box
.box {
    // .box__ttl
    &__ttl {
        #code...
    }
    // .box__txt
    &__txt {
        #code...
    }
    // .box__inner
    &__inner {
        // .box__inner__ttl
        &__ttl {
            #code...
        }
        // .box__inner__txt
        &__txt {
            #code...
        }
    }
    // .box--white
    &--white {
        // .box--white__ttl
        &__ttl {
            #code...
        }
    }
}
~~~

【CSS】
~~~css
.box {}
.box__ttl {}
.box__txt {}
.box__inner {}
.box__inner__ttl {}
.box__inner__txt {}
.box--white {}
.box--white__ttl {}
~~~

##### *1. 単語の省略について
|種類|規則|
|:--:|:--:|
|画像、図、写真|img|
|動画|mov|
|バナー|bnr|
|サムネイル|thumb|
|アイコン|ico|
|メインビジュアル|mv|
|ナビ|nav|
|ボタン|btn|
|見出し、タイトル|ttl|
|テキスト|txt|
|説明|desc,descript|
|カテゴリー|cat|
|テンプレート|tmp,tmpl|
|番号|num|
|背景|bg|
|前へ|prev|
|次へ|next|
|エラー|err|
|メッセージ|msg|


<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 3-4. 大文字/小文字
小文字のみ使用する。<br>
ファイル名も同様とする。

- 値が文字列
- キャメルケース

上記の場合は除く。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 3-5. コメント
ファイル内での検索を行ったりするのでこまめに残してください。

#### Example
【HTML】
~~~html
<div class="box">
    <h2 class="box__ttl">タイトル</h2>
    <p class="box__txt">テキスト</p>
</div>
<!-- /.box -->

<div id="box">
    <h2 class="box__ttl">タイトル</h2>
    <p class="box__txt">テキスト</p>
</div>
<!-- /#box -->

【ルール】
・/(スラッシュ)を先頭に着けること。
・/(スラッシュ)の後はその要素のクラス、またはIDを示すこと。
　→cssのセレクタに習い、クラスの場合は.(ドット)、IDの場合は#(ハッシュ)
~~~

【SCSS】
~~~scss
// で一行コメント。コンパイルした際、css上には残りません。
/**/ で範囲コメント。コンパイルした際、css上に残ります。

【ルール】
ネストが深くなって場合や
複雑になった場合にもわかるように
随所に残すこと。
~~~

【CSS】<br>
scssで書くため割愛
<br>
<br>

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

## 4.【HTML】
作成後は「[W3C](https://validator.w3.org/)」のデバッカーに通して構文的にエラーがないか確認すること。<br>
エディターのプラグインなどで導入されている場合はそのプラグインを使用してもよい。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 4-1. 基本ルール
- HTMLはHTML5で記述する。
- imgの表示は基本的にimgタグを使用する。<br>
装飾の場合にのみ背景として表示させることとする。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 4-2. プロトコル
http/httpsのそれぞれのファイルを両方のプロトコル上で利用できない場合を除き、<br>
画像やその他のメディアファイル、スタイルシート、<br>
およびスクリプトを指しているURLからプロトコルを省略する。

~~~html
<!-- 非推奨 -->
<script src="http://localhost/js/xxx.js"></script>
<!-- 推奨 -->
<script src="//localhost/js/xxx.js"></script>
~~~

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 4-3. Type属性
stylesheetとscriptのtype属性は省略する。<br>
HTML5ではデフォルトで解釈されるため必要ない。

~~~html
/* css */
<!-- 非推奨 -->
<link rel="stylesheet" href="//localhost/css/xxx.css" type="text/css">
<!-- 推奨 -->
<link rel="stylesheet" href="//localhost/css/xxx.css">

/* js */
<!-- 非推奨 -->
<script src="//localhost/js/xxx.js" type="text/javascript"></script>
<!-- 推奨 -->
<script src="//localhost/js/xxx.js"></script>
~~~

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 4-4. タグ
|意味・用途|HTMLタグ|解説|
|-|-|-|
|見出し|h1～6|見出しに使用すること。<br><br>dt要素との使い分けに迷うことがある場合<br>以下の基準で判断すること。<br><ul><li>そのテキストがページの目次として適しているか</li><li>そのテキストに対するコンテンツがあるか</li></ul>HTML5のsectionタグで文書の階層構造を表している場合、<br>見出しレベルの数字は1～6のどれを使っても仕様上問題はないが、<br>コードを読んだ際に階層レベルがわかりにくいため、<br>sectionタグを使っていたとしても階層レベルに合わせて数字を増やすこと。|
|段落|p|段落（複数の文から構成される文章）に使用すること。<br><br>その他にも段落とは言えず、<br>どのようなタグも適していないテキストがでてくることがあるが、<br>そういったときにはdivタグかspanタグを使用すること。|
|リスト|ul > li|順序に意味がないリスト（箇条書き）に使用すること。<br><br>文章を確認し、箇条書きといえる内容（端的で長文を含まない）かどうか、<br>順序に意味があるかどうかを判断してマークアップすること。|
|順序リスト|ol > li|順序に意味があるリスト（箇条書き）に使用すること。<br><br>ulタグによるマークアップの考え方に加えて順序に意味があるかどうかで使い分ける。<br>番号が付いている＝olタグではないため、<br>まずは箇条書きとして適切かどうかを判断した後に順序に意味があるかどうかを判断し使うこと。|
|定義リスト|dl > dt + dd|用語とその説明から構成される文章に使用すること。<br><br>用語以外にも、新着情報の年月日（dtタグ）と内容（ddタグ）や対話型の文章の中で話者（dtタグ）とその内容（ddタグ）にも使用できる。<br>汎用性が高く、用途も広いため便利なタグなため、<br>他に適切なタグがないかを考えてから使うこと。|
|注釈・細目|small|免責・警告・法的規制・著作権・ライセンス要件などを注釈・細目に使用すること。<br>一般的なWebサイトでよくあるものとしては、コピーライトが挙げられる。|
|記事|article|このタグでマークアップされた内容が独立したコンテンツとして成り立つものに使用すること。<br><br>ブログ記事・ニュース記事・新着情報などが対象になります。 独立しているかどうか判断に困ることがありますので、以下を判断基準とすること。<br><ul><li>RSSフィードで配信するコンテンツか</li><li>そのコンテンツだけを抜き取ってWordなどに貼り付けたとき、<br>何のコト・モノについて言及したコンテンツなのか理解できるか</li></ul>それでも困った場合には使用しないこと。|
|余談・補足情報|aside|文章の本筋ではないが、<br>余談・補足程度で軽く触れている文章や関連する広告・商品に使用すること。<br><br>文章の意図や書き手の考えを汲み取らなければ正しく使用できないため、使用が難しいタグの一つ。<br>以下の基準で判断し、それでも使用に迷った場合は使わないこと。<ul><li>このタグでマークアップされた文章が削除された場合にコンテンツが破綻しないか。</li></ul>|
|フォームの項目名|label|inputタグやselectタグなど入力要素に対する項目名に使用すること。<br><br>このタグでマークアップされた内容をクリックしたときに、<br>フォーカスが対象の要素に移るようにfor属性を指定すること。|

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

## 5.【CSS】

- 予測しやすい
- 再利用しやすい
- 保守しやすい
- 拡張しやすい

以上の結果から次のことを念頭にCSSコーディングを行う。

- 一貫性
- 誰が読んでも理解できる
- 簡潔に単純
- 重複を避ける

CSSの記述は基本的に「SCSS」で行う。

また、公開時には圧縮をかけること。<br>
圧縮前のファイルはバックアップとして残しておくこと。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 5-1. 命名規則-レギュレーション
- id名はページ内リンク、またはJSでのフック、input等以外では使用しない。<br>
styleの用途では基本使用しない。
- IDとクラス名にタイプセレクタは記述しない。
- パフォーマンスを考慮して不要な子孫セレクタも避ける。
- 可能な限りショートハンドでプロパティを書く。
- cssセレクタのネストは三つまで。
- cssのresetにはnormalize.cssを使用する。
- !importantは使用しない。
- プラグイン既存のcssファイルには触れない。カスタマイズは別のファイルで行うこと。<br>
またその際にスタイルの調整が非常に困難な場合にのみ!importantの使用を許可する。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 5-2. Breakpoint
[多様化したdeviceに対応！CSSで使いやすいブレイクポイントを的確に定義する方法](https://goo.gl/64dMl6)<br>
上記記事内容に基づき設定。

- 600px
- 900px
- 1200px

モバイルファーストではなく、PCデザインを元に設定。
よってmediaqueryの記述は以下のようになる。

~~~css
@media screen and (max-width: 600px) {
  /* code... */
}
~~~

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

## 6.【JavaScript】

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 6-1. レギュレーション
- jQuery等のプラグインで、CDNがある場合はCDNを利用すること。
- GoogleMapはifreamではなくjsで記述すること。
- プラグイン既存のjsファイルには触れない。カスタマイズは別のファイルで行うこと。
- どうしても解消できない場合はそのプラグインの使用を中止すること。
- 公開時には圧縮をかけること。また、圧縮前のファイルはバックアップとして残しておくこと。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

## 7.【WP】
基本的に共有しているWPのテンプレートをカスタマイズし、使用する。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 7-1. バージョン
常に最新バージョンを使用する。<br>
プラグインの相性、干渉の恐れもあるので<br>
本サイト公開後のアップデートは基本的に行わない。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 7-2. プラグイン
初期インストールプラグインは下記のとおりです。<br>
有効化にし、作業を行うこと。

--- まとめます。 ---

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

### 7-3. ビジュアルエディタ部分の書き出し
ビジュアルエディタで入力される内容は投稿者に依存します。<br>
故に、下記の内容を踏まえコーディングを行うこと。

- ビジュアルエディタで入力された内容が表示される部分はdivないし、article等で囲うこと。
　※pタグやhレベルのタグが入ってくる為。
- クラスでの制御、n番目など、中に生成される要素にクラスで制御したcssを付けないでください。
　※必ずしも投稿者がcssに記載した順番、ルールに沿ってに入力するとは限らない為。

<br>

<p><a href="./README.md#user-content-huvrid用コーディングガイドライン">ページ上部へ戻る</a></p>

<br>

---

<br>

以上です。
