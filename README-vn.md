# HUVRID hướng dẫn coding
Hướng dẫn coding của HUVRID


- Phụ lục

1. [OS, device,size màn hình đối ứng](#1os-devicesize-màn-hình-đối-ứng)
    1. [1-1. OS](#1-1-os)
    1. [1-2. Browser](#1-2-browser)
    1. [1-3. Size màn hình](#1-3-size-màn-hình)
1. [môi trường thiết lập](#2môi-trường-thiết-lập)
    1. [2-1. Design tool](#2-1-design-tool)
    1. [2-2. Editor](#2-2-editor)
    1. [2-3. Build tools](#2-3-build-tools)
    1. [2-4. Quản lí Git](#2-4-quản-lí-git)
    1. [2-5. Cấu tạo Directory](#2-5-cấu-tạo-directory)
1. [qui tắc cơ bản](#3qui-tắc-cơ-bản)
    1. [3-1. Encoding](#3-1-encodeing)
    1. [3-2. Indent (thụt đầu dòng)](#3-2-indent-thụt-đầu-dòng)
    1. [3-3. qui tắc đặt tên](#3-3-qui-tắc-đặt-tên)
        1. [3-3-1.Qui tắc đặt tên của Bem](#3-3-1-qui-tắc-đặt-tên-của-bem)
    1. [3-4. chữ to/chữ nhỏ](#3-4-chữ-tochữ-nhỏ)
    1. [3-5. Comment](#3-5-comment)
1. [HTML](#4html)
    1. [4-1. qui tắc cơ bản](#4-1-qui-tắc-cơ-bản)
    1. [4-2. Protocol](#4-2-protocol)
    1. [4-3. phân loại](#4-3-phân-loại)
    1. [4-4. HTML tag](#4-4-html-tag)
1. [CSS](#5css)
    1. [5-1. qui tắc đặt tên-Qui luật](#5-1-qui-tắc-đặt-tên-qui-luật)
    1. [5-2. Breakpoint](#5-2-breakpoint)
1. [JavaScript](#6javascript)
    1. [6-1. Qui luật](#6-1-qui-luật)
1. [WP](#7wp)
    1. [7-1. Version](#7-1-version)
    1. [7-2. Plugin](#7-2-plugin)
    1. [7-3. Tiêu đề cho phần Visual Editor](#7-3-tiêu-đề-cho-phần-visual-editor)

<br>

---

<br>

## 1.【OS, device,size màn hình đối ứng】
về cơ bản áp dụng trên những phiên bản mới nhất。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 1-1. OS
■ PC
- Windows 8.1 - 10
- Mac OSX phiên bản mới nhất

■ mobile
- iOS phiên bản mới nhất
- Android phiên bản mới nhất

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 1-2. Browser
Ứng dụng trên những phiên bản mới nhất

■ PC
- Google Chrome
- Firefox
- Safari
- Microsoft Edge
- Interne Explorer 11 （xác nhận tỷ lệ user và trong hệ thống）

■ mobile
- Google Chrome
- Safari

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 1-3. Size màn hình

■ PC<br>
set up bảng tham chiếu độ phân giải hình ảnh đang được sư dụng rộng rãi。<br>
không tham chiếu biểu thị bằng Projector。<br>
về cơ bản là biểu thị bắng Full HD（1920 x 1080）。

■ Tablet<br>
iPad。<br>
768 x 1024

■ mobile<br>
iPhone 6。<br>
Android thì chủ yếu là Xperia hoặc Galaxy、tham chiếu những thiết bị đang được dùng phổ biến.。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

## 2.【môi trường thiết lập】
Coding là việc sử dụng các tool sau trước khi đi vào thực hiện công việc。

- Design tool
- Editor
- Quản lí Git
- Build tool

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 2-1. Design tool
Sử dụng đồng dạng các tool mà designer sử dụng。
Nội dung bài viết thì sẽ được thực hiện băng Inplug và SX。
Cơ bản là như dưới đây。

- Adobe Photoshop CC
- Adobe Illustrator CC
- Adobe Experience Design CC （XD）
- Adobe Fireworks CS6 （Legacy skim）

<br>
<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 2-2. Editor
Cố gắng sử dụng những Editor dưới đây khi Code。

- Visual Studio Code
- Sublime Text 3
- Atom
- Brackets
- Adobe Dreamweaver CC


với những editor trên thì đưa những dạng chức năng như bên dưới vào trước。

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

Trong trường hợp tất cả các chức năng trên đã được thực hiện、hay trường hợp Indent có kèm theo những Plugin tương tự thì sử dụng những chức năng trên。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 2-3. Build tools
Sử dụng 「Prepros」như là kết hợp giữa build của Sass/Scss。<br>
Sử dụng 「gulp.js」、「Gruntnhu」của Task runner cũng ok。<br>
có thể dùng các Web service như 「TinyPng」để thu nhỏ hình ảnh。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 2-4. Quản lí Git
Sử dụng tool GUI 「SourceTree」của Git。<br>
Hoặc trong trường hợp nhiều người cùng sử dụng thì lập project trên 「Backlog」、sử dụng Remote Repository。<br>
※việc lập 「SourceTree」trên WordPress、được ghi trong phụ lục của WordPress。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 2-5. Cấu tạo Directory
về cơ bản giống như dưới đây。<br>

/ - document root -<br>
　┝ css/<br>
　│　┝ normalize.css - default -<br>
　│　┝ common.css - site dùng chung css -<br>
　│　└pagename.css - css của trang -<br>
　┝ img/<br>
　│　┝ pagename/ - thiết lập Directory như ở dưới -<br>
　┝ js/ - JSDirectory -<br>
　│ 　└ common.js - setJS jquery về cơ bản là trên load-của CDN -<br>
　┝ scss/ - hoàn tất file scss trên trang hoặc Directory -<br>
　│　┝ common.scss - site dùng chung scss -<br>
　│　└ pagename.scss - scss của trang -<br>
　┝ index.html - top page -<br>
　└ pagename.html - HTMLcủa trang -

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

## 3.【qui tắc cơ bản】

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 3-1. Encoding
chỉ dùng UTF-8。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 3-2. Indent (thụt đầu dòng)
Lùi vào 2 indent cho mỗi kí tự nửa chữ-hankaku。<br>
Cần dùng phím Tab để tạo Editor。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 3-3. qui tắc đặt tên
「BEM」được thực hiện dựa trên qui tắc đặt tên。

■ BEM
- Ngôn ngữ sử dụng: Block。
- Block và Element được kết nối bằng 「underscore:2 (__)」。
- Block hoặc Element và Modifier được kết nối bằng 「hyphen:2 (--)」。

### 3-3-1. Qui tắc đặt tên của BEM
- Ngôn ngữ sử dụng là những thuật ngữ phù hợp bằng tiếng anh。
- Nếu có thể viết dạng ngắn thì để dưới dạng[(\*1)](#1-dạng-viết-tắt)
- Tránh sử dụng kết hợp trên 3 loại ngôn ngữ
- Không được lưu độclập loại ngôn ngữ đã sử dụng Modifier。
- Trong trường hợp viết bằng camel case thì có phân tách giữa các từ。<br>
(VD: box__subtitle ⇒ box__subTitle)


#### Ví dụ

【HTML】
~~~html
<!-- Block + Element -->
<div class="box">
    <h2 class="box__ttl">Title</h2>
    <p class="box__txt">content</p>
</div>

<!-- Block + Modifier -->
<div class="box box--white">
    <h2 class="box__ttl">tiêu đề trên nền có nội dung màu trắng</h2>
</div>

<!-- Block + Element + Modifier -->
<div class="box">
    <h2 class="box__ttl">chuẩn</h2>
    <h2 class="box__ttl box__ttl--big">to</h2>
    <h2 class="box__ttl box__ttl--small">nhỏ</h2>
</div>

<!-- Block + Element + Element -->
<div class="box">
    <div class="box__inner">
        <h2 class="box__inner__ttl">tiêu đề</h2>
        <p class="box__inner__txt">nội dung</p>
    </div>
</div>

<!-- Block + Modifier + Element -->
<div class="box box--white">
    <h2 class="box__ttl box--white__ttl">tiêu đề</h2>
</div>

【※Bổ sung】
Sử dụng trong trường hợp muốn định nghĩa những phần, yếu tố đã được mở rộng bằng Modifier。
Sử dụng trong trường hợp chỉ định cụ thể như đã đề cập lúc trước 『Block + Modifier』。

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

##### *1. dạng viết tắt
|Loại|Quy tắc|
|:--:|:--:|
|Tranh、sơ đồ、ảnh|img|
|ảnh động|mov|
|banner|bnr|
|Thumbnail|thumb|
|icon|ico|
|main visual|mv|
|navi|nav|
|button|btn|
|tiêu đề、title|ttl|
|text|txt|
|giải thích|desc,descript|
|category|cat|
|template|tmp,tmpl|
|number|num|
|background|bg|
|previous|prev|
|next|next|
|error|err|
|messenger|msg|


<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 3-4. chữ to/chữ nhỏ
chỉ sử dụng phông chữ nhỏ。<br>
tên file cũng sử dụng đồng bộ。

- giá trị thể hiện bằng chữ 
- camelcase

Không bao gồm những trường hợp trên。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 3-5. Comment
Việc tìm kiếm sẽ diễn ra ngay tại file nên hãy thường xuyên lưu lại。

#### Ví dụ
【HTML】
~~~html
<div class="box">
    <h2 class="box__ttl">title</h2>
    <p class="box__txt">text</p>
</div>
<!-- /.box -->

<div id="box">
    <h2 class="box__ttl">title</h2>
    <p class="box__txt">text</p>
</div>
<!-- /#box -->

【Qui tắc】
・/(Slash) sẽ được đưa vào trước.
・sau /(Slash) sẽ hiển thị yếu tố class hoặc iD。
　→giống với Selector của css、trong trường hợp của Class thìlà.(Dot)、vớiID thì là #(Hash)
~~~

【SCSS】
~~~scss
Sau khi đã tổng hợp,dòng comment // sẽ ko còn lưu lại trên css。
/**/ phạm vi comment。sau khi đã tổng hợp, comment se lưu lại trên css。

【qui tắc】
Trong trường hợp Nest sâu hơn hay trở nên phức tạp hơn thì nên lưu lại ở nhiều nơi。
~~~

【CSS】<br>
Dạng viếtlược bỏ bằng scss
<br>
<br>

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

## 4.【HTML】
Sau khi hoàn thành phải kiểm tra xem có lỗi hay không thông qua Debugger trên 「[W3C](https://validator.w3.org/)」
trong trường hợp như được chỉ định bởi Plugin của Editor thì có thể sư dụng plugin trên.
<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 4-1. qui tắc cơ bản
- HTML sẽ được hiểu là HTML5。
- biểu thị của img về cơ bản là sử dụng đuôi"img"。<br>
chỉ hiển thị phông nền trong trường hợp có phần trang trí。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 4-2. Protocol
Ngoài trường hợp ko dùng được file của http và https dựa trên Protocol của cả 2、<br>
ảnh, những Media file và style sheet khác、<br>
hoặc là từ những URL chỉ định Script, thì rút gọn Protocol。

~~~html
<!-- Deprecated -->
<script src="http://localhost/js/xxx.js"></script>
<!-- Recommendation -->
<script src="//localhost/js/xxx.js"></script>
~~~

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 4-3. Phân loại
type của stylesheet và script được rút gọn。<br>
đối với HTML5 thì không cần thiết phải xử lí bằng Default。

~~~html
/* css */
<!-- Deprecated -->
<link rel="stylesheet" href="//localhost/css/xxx.css" type="text/css">
<!-- Recomendation -->
<link rel="stylesheet" href="//localhost/css/xxx.css">

/* js */
<!-- Deprecated -->
<script src="//localhost/js/xxx.js" type="text/javascript"></script>
<!-- Recomendation -->
<script src="//localhost/js/xxx.js"></script>
~~~

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 4-4. HTML Tag
|ý nghĩa・sử dụng|HTML tag|giải thích|
|-|-|-|
|Tiêu đề|h1～6|dùng để viết tiêu đề。<br><br>trong trường hợp nhầm lẫn về cách dùng giữa các item dt<br>đánh giá dựa trên những tiêu chí cơ bản dưới đây。<br><ul><li>có phù hợp với Phụ lục các trang của text khong</li><li>Có nội dung phù hợp với Text không</li></ul>trong trường hợp cấu trúc các đoạn văn của bài được thể hiện trên phần Tag của HTML5、<br>với tiêu đề thì có thể dùng bất cứ số nào từ 1 đến 6、<br>tuy nhiên bởi vì khi đọc code sẽ khó thay đổi đoạn、<br>nên dù có dùng phần Tag thì số sẽ tăng lên để phù hợp với đoạn văn。|
|ĐOạn văn|p|sử dụng đới với đoạn văn（được tạo nên từ nhiều câu văn）。<br><br>với những trường hợp ko được xem là đoạn văn、<br>chắc chắn sẽ có những text có đuôi không phù hợp、<br>khi đó sử dụng đuôi div hoặc span。|
|List|ul > li|dùng cho những list không theo trình tự（viết theo mục）。<br><br>xem lại đoạn văn,xem có phải là nội dung được viết theo mục hay không(không chứa những câu văn dài)、<br>đánh giá xem có viết theo trình tự hay ko thì mark up。|
|List theo trình tự|ol > li|dùng cho list theo trình tự（viết theo mục)。<br><br>ulTùy thuộc vào Tag mà thêm vào cách đánh dấu, phân chia。<br>những＝olcó đánh số thì không phải là đuôi、<br>đầu tiên sau khi đánh giá xem có phù hợp với việc viết theo mục hay không thì đánh giá việc có thích hợp viết theo tình tự hay không。|
|định nghĩa list|dl > dt + dd|dùng cho những câu văn được tạo nên từ ngôn ngữ sử dụng và giải thích đi kèm。<br><br>ngoài ngôn ngữ sử dụng, những thông tin mới về ngày tháng năm（đuôidt） và về nội dung（đuôidd） cùng với những câu văn có dạng ngôn ngữ tương ứng（đuôidt）và nội dung tương ứng（đuôidd）cũng có thể sử dụng được。<br>vì là đuôi rất tiện lợi nhờ vào tính linh hoạt cao, phạm vi sử dụng rộng rãi、<br>nên nếu không có đuôi nào phù hợp có thể xem xét sử dụng。|
|Lưu ý, chi tiết|small|phải chú ý chi tiết tới các trọng điểm như qui định・cảnh báo・qui định về pháp luật・quyền nguyên tác・license。<br>một điều hay có ở tất cả các website thường là có được cho phép thực hiện Copyright hay không。|
|bài báo|article|đuôi này được dùng cho những nội dung đã được đánh dấu và hoạt động đọc lập。<br><br>đối tượng là những bài Blog, tin tức, những thông tin mới cập nhật。 Vì khá khó để đánh giá nội dung nào đó là có thể hoạt động độc lâp hay không、nên hãy dựa vào những tiêu chí dưới đây。<br><ul><li>có phải là nội dung bằng chữ trên RSS hay không</li><li>khi chỉ tách lấy nội dung trên và dán vào Word 、<br>thì có hiểu được đang nói về vấn đề gì hay không</li></ul>nếu không thì không được sử dụng。|
|thông tin bổ sung|aside|mặc dù không phải là nội dung cơ bản、<br>sử dụng đối với những câu văn, thông báo hay sản phẩm mang tính chất bổ sung。<br><br>vì nêu không thể hiểu được ý đồ của câu văn và lối suy nghĩ của người viết thì sẽ hiểu sai, khó sử dụng đuôi này。<br>đánh giá dựa theo những tiêu chí dưới đây、không sử dụng cho những trường hợp không rõ về cách sử dụng。<ul><li>trong trường hợp những câu văn đã được đánh dấu bằng đuôi này thì nội dung có bị thiếu hụt hay không。</li></ul>|
|bảng phụ lục về các form|label|dùng cho bảng phụ lục về các thông tin xuất nhập với đuôi như input hay select。<br><br>sau khi click vào những nội dung đã được đánh dấu bằng đuôi này、<br>để Focus chuyển sang những thành phần đối tượng thì chỉ định cho for。|

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

## 5.【CSS】

- dễ dự đoán
- dễ tái sử dụng
- dễ lưu trữ
- dễ mở rộng

dựa trên những kết quả trên thực hiện coding trên CSS。

- tính nhất quán
- ai đọc cũng hiểu
- đơn giản
- tránh những phức tạp

CSS về cơ bản được thực hiện bằng 「SCSS。

thêm vào đó, khi thì có thể thực hiện nén file。<br>
file trước khi nén sẽ được back up và lưu giữ lại。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 5-1. qui tắc đặt tên-Qui luật
- tên id là đường link của trang hoặc là Hook của JS、ngoài input thì không sử dụng。<br>
về cơ bản không sử dụng style。
- Tên ID và class thì không viết bằng type selector。
- Tham chiếu vào Performance để tránh những Selector con không cần thiết。
- Chỗ nào có thể thì viết tắt các thuộc tính(property)。
- Nest của css selector thì có 3。
- reset của CSS thì sử dụng normalize.css。
- !important thì không sử dụng。
- không sử dụng tới file CSS của những Plug in hiện có。Customize sẽ được thực hiện ở file riêng biệt khác。<br>
thêm vào đó, chỉ trong trường hợp điều chỉnh Style cực kỳ khó khăn thì cho phép sử dụng!important。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 5-2. Breakpoint
[Ứng dụng trên các thiết bị đã được đa dạng hóa！cách định nghĩa những Breakpoint dễ sử dụng bằng CSS](https://goo.gl/64dMl6)<br>
Dựa vào nội dung các bài viết trên để thiết lập。

- 600px
- 900px
- 1200px

Dựa vào PC Design chứ không phải Mobile First để thiết lập。
mediaquery sẽ giống như miêu tả dưới đây。

~~~css
@media screen and (max-width: 600px) {
  /* code... */
}
~~~

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

## 6.【JavaScript】

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 6-1. Qui luật
-trong trường hợp có CDN thì sử dụng CDN qua Plugin của Jquery。
- GoogleMap thì được viết bằng Js chứ không phải ifream。
- Không sử dụng file JS của Plugin hiện có.Customize sẽ được thực hiện ở file riêng biệt khác 。
-Trong trường hợp không thể hủy được Plugin đó thì ngưng sử dụng。
- Khi công bố thì sẽ nén file。File trước khi nén sẽ Back up để lưu lại。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lền đầu trang</a></p>

<br>

---

<br>

## 7.【WP】
Về cơ bản những Template của WP sẽ được Customize và đưa vào sử dụng。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 7-1. Version
Ứng dụng trên những phiên bản mới nhất。<br>
Vì có lo sợ về tình trạng Plugin、bị khô<br>
Sau khi công bố Site thì cơ bản không thực hiện Update。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 7-2. Plugin
Việc install Plugin trong giai đoạn đầu sẽ giống như bên dưới đây。<br>
Được hiệu quả hóa và thực hiện tác nghiệp。

--- Kết luận。 ---

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

### 7-3. Tiêu đề cho phần Visual Editor
Nội dung được nhập vào bằng Visual Editor sẽ phụ thuộc vào contributor。<br>
Thêm vào đó, dựa trên nội dung dưới đây để thực hiện coding。

- Phần hiển thị của nội dung được nhập bằng Visual Editor không phải là div、 giới hạn ở article。
　※Bao gồm đuôi P và level h của đuôi HTML。
- Đối với những thành phần được tạo ra từ class, n thì không gắn CSS được quản lí bởi Class。
　※Và các contributor cũng phải được nhập tuân thủ theo trình tự, qui tắc đã ghi trên CSS。

<br>

<p><a href="./README-vn.md#huvrid-hướng-dẫn-coding">lên đầu trang</a></p>

<br>

---

<br>

Hết。
