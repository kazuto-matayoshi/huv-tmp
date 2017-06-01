# css

## Điểm quan trọng

CSS là ngôn ngữ vô cùng đơn giản và phí giành cho người học cũng thấp hơn so với những ngôn ngữ khác。<br>
Tuy nhiên、với ngôn ngữ như 「oleoresin selector」 hoặc những Nest không hoạt động、đặc biệt là đối với những dự án lớn với số lượng người dùng nhiều、thì sẽ sớm gây ra những hỏng hóc, sai sótvà ảnh hưởng tới nền tảng Maintenance。<br>
Từ việc Css chú ý đến 「tính nhất quán」「ai đọc cũng có thể hiểu」「đơn giản」「tránh những khó hiểu, phức tạp」 sẽ giải thích qui tắc định nghĩa Css thông thường và những điều cán thiết của qui tắc。


---


## 1.tên class là thứ ngôn ngữ và dạng rút gọn dễ hiểu
### Bad
~~~
.navigation {
  margin: 0 0 1rem 2rem;
}
.atr {
  color: #93c;
}
~~~
### Good
~~~
.navi {
  margin: 0 0 1rem 2rem;
}
.author {
  color: #93c;
}
~~~

### Why?
> Tiết kiệm được size của file。<br>
> class dài = file có size lớn = nguy cơ mất UX。<br>
> tuy nhiên nếu rút gọn mà không hiểu nghĩa thì không nên rút gọn。<br>
> khi rút gọn ngôn ngữ nên tham chiếu hướng dẫn coding。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 2.định nghĩa về khả năng rút gọn các property
### Bad
~~~
.list-box {
  border-top-style: none;
  font-family: serif;
  font-size: 100%;
  line-height: 1.6;
  padding-bottom: 2em;
  padding-left: 1em;
  padding-right: 1em;
  padding-top: 0;
}
~~~
### Good
~~~
.list-box {
  border-top: 0;
  font: 100%/1.6 serif;
  padding: 0 1rem 2rem;
}
~~~

### Why?
> tiết kiệm size của file。<br>
> cắt giảm thời gian viết
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 3.Với những giá trị nhỏ thì bỏ 0 trước dấu phẩy
### Bad
~~~
.list-box {
  font-size: 0.8rem;
}
~~~
### Good
~~~
.list-box {
  font-size: .8rem;
}
~~~

### Why?
> Tiết kiệm size của file。<br>
> cắt giảm thời gian viết。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 4.16 với những số định nghĩa màu sắc, cố gắng viết bằng 3 hàng
### Bad
~~~
.list-box {
  color: #eebbcc;
}
~~~
### Good
~~~
.list-box {
  color: #ebc;
}
~~~

### Why?
> Tiết kiệm size của file。<br>
> Cắt giảm thời gian viết。
<br>

<p><a href="#">Lên đầu trang</a></p>

<br>

---

<br>

## 5.không sử dụng ID Selector
### Bad
~~~
#info-title {
  font-size: 3rem;
}
~~~
### Good
~~~
.info-title {
  font-size: 3rem;
}
~~~

### Why?
> vì có nhiều cách suy nghĩ khác nhau nên tùy vào người code mà có cách giải thích khác nhau。<br><br>
> Lý do 1 : không thể sử dụng lại ID<br>
> Cùng 1 ID thì chỉ dùng được 1 lần trên 1 trang của HTML。Nói cách khác giống như 1 danh từ riêng。<br>
> ID là viết tắt của từ「thông tin cá nhân」 nên việc tái sử dụng là không hiệu quả。<br><br>
> Lý do 2 : cần thiết về ưu tiên vị trí đối với các style thích hợp<br>
> CSS selector có ưu tiên về thứ tự。<br>
> về định nghĩa CSS phổ thông, title sẽ được định nghĩa từ trên xuống dựa trên những qui tắc trên、trong trường hợp muốn định nghĩa thứ tự một cách riêng biệt、thì thông thường sẽ tăng thêm lượng selector。<br>
> VìID selector đươc ưu tiên hơn class selector、nên xét từ những định nghĩa ở trên thì các selector con sẽ tăng lên, hay có những thay đổi ở những nơi lưu thông tin、cho đến khi maintenance thì có nguy cơ tăng thêm các công việc, thao tác và khó đọc hơn。<br>
> <br>
> Lý do 3 : không thể sử dụng rộng rãi<br>
> Giống như lý do 1,với việc thiết kế dùng chung thì tên được trừu tượng hóa nên sử dụng sẽ rất hiệu quả。<br>
> Như đã nói ở lý do 1, ID giống như 1 danh từ riêng,mang tính đặc thù、không mang tính trừu tượng。Chính vì vậy bắt buộc phải dung Class。<br><br>
> Trong trường hợp dùng các yếu tố ID thì khuyến khích phương pháp sử dụng giới hạn đường link trong trang hoặc Hook của JS。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 6.Không ghi type selector lên class 
### Bad
~~~
li.member-list {
  color: #06c;
}
~~~
### Good
~~~
.member-list {
  color: #06c;
}
~~~

### Why?
> dễ đọc。<br>
> Nâng cao độ chi tiết, không thể tái sửu dụng bằng những hình thức selector khác。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 7.Không gắn vị trí vào giá trị 0
### Bad
~~~
.example {
  margin: 0rem;
}
~~~
### Good
~~~
.example {
  margin: 0;
}
~~~

### Why?
> Việc chỉnh sửa JS và CSS cố gắng không gây ảnh hưởng tới đối tượng 2 bên nhờ vào khớp nối lỏng。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 8.Indent và cách dòng, chèn comment, sắp xếp vị trí ban đầu của các block
### Bad
~~~
.header{margin:0rem;}
.member__box,.friend__box{color:#fec;background-color:#006;}
.nav
{
color:#ff0;
}
~~~
### Good
~~~
// .header
.header {
  margin: 0rem;
}

// CSS dùng chung
.member__box,
.friend__box {
  color: #fec;
  background-color: #006;
}

// .nav
.nav {
  color: #ff0;
}
~~~

### Why?
>dễ đọc, dễ theo dõi。<br>
> dễ điều chỉnh, sửa chữa。<br>
> ※trên là giới thiệu việc sử dụng tổng hợp CSS Pre-processor của Sass(Scss)và LESS。<br>
> tùy vào doanh nghiêp hay cá nhân mà có những khác biệt、do đó cần thiết phải tổng hợp những nội dung phức tạp, khó hiểu hiện tạiđể hợp thức hóa việc dùng chung。<br>
> ví dụ, có thể tiến hành theo như dưới đây。<br>
> 1. gắn Indent bằng đơn vị block<br>
> 2. gắn 「;」 vào cuối của mỗi Property<br>
> 3. sau dấu 「:」giữa các giá trị của Property, phải để Space<br>
> 4. Mỗi Selector và Property được viết bằng nhiều hàng<br>
> 5. mỗi qui tắc CSS thì cách nhau 1 hàng
> 6. Giữa 2 dấu ngoặc nhọn phải để space
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 9.cách sử dụng Universal selector
### Bad
~~~
* {
  font-size: .8rem;
}
~~~
### Good
~~~
html,body {
  font-size: .8rem;
}
~~~

### Why?
> dễ đọc, dễ theo dõi。<br>
> để mở rộng phạm vi ảnh hưởng, cần chú ý cao độ khi sử dụng。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 10.Không đặt những tên có liên quan đến chủ đề của Selector
### Bad
~~~
.blue--text {
  color: #00f;
}
~~~
### Good
~~~
.highlighted--text {
  color: #00f;
}
~~~

### Why?
> Xét về mặt maintenance và việc tái sử dụng、nếu đặt những tên liên quan đến style thì khi có những thay đổi sau đó có thể dẫn đến những trường hợp bất thường về ý nghĩa và style。<br>
> trường hợp xấu nhất có thể giống như bên dưới đây。<br>
> .blue--text {<br>
> 　color: red;<br>
> }<br>
> nếu giống như thế này thì sẽ rất phức tạp、nên đặt tên có từ chỉ 「mục đích」trước tên đó。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 11.KHông để Nest sâu、cắt tách riêng selector từ cấu trúc của HTML
### Bad
~~~
.content #intro .icon { … }
.header > nav > li > button { … }
~~~
### Good
~~~
.intro__icon { … }
.header__button { … }
~~~

### Why?
> CSS có độ chi tiết, nếu viết Selector càng cụ thể chi tiết thì tính đặc thù càng cao, do vậy độ khó càng gia tăng và khó đọc hơn。<br>
> Khi sử dụng!important và ID Selector thì có nguy cơ bị mở、vì vậy cố gắng không để Nest sâu。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 12.Thứ tự của selector sẽ được viết phù hợp với thứ tự cấu trúc của HTML
### Bad
~~~
.footer { … }
.header { … }
~~~
### Good
~~~
.header { … }
.footer { … }
~~~

### Why?
> Rendering của HTML/DOM tree về cơ bản sắp xếp theo chiều thuận từ trên xuống dưới。Đối với CSS thì cũng tương tự như vậy, nên phù hợp với HTML tree。<br>
> ※Nếu có style linh hoạt được ghi vào trước sẽ tăng tính maintenance、nhưng không bắt buộc。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 13.Những Selector có tính đặc thù thì để thứ tự sau
### Bad
~~~
.list-item:first-child { … }
.list-item { … }
.list-item:last-child { … }
~~~
### Good
~~~
.list-item { … }
.list-item:first-child { … }
.list-item:last-child { … }
~~~

### Why?
> Nếu để những selector có tính đặc thù lên trước thì code sẽ không đọc được、và tùy vào trường hợp mà vẫn bị đưa lên trước、vì thế mà gây nhiễu loạn trong việc hiểu và phạm vi ảnh hưởng。<br>
> Selector có tính linh hoạt nên đưa lên trước,Selector có tính đặc thù để sau。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## 14.Với những selector về trang và component thì nên bắt đầu bằng từ ngữ giống nhau
### Bad
~~~
.front__page__title { … }
.intro__home { … }
.home__text { … }
~~~
### Good
~~~
.home__title { … }
.home__intro { … }
.home__text { … }
~~~

### Why?
> Dễ đọc, dễ theo dõi。<br>
> Phần viết ở trên là tên Selector sử dụng cho tất cả「top page」。<br>
> ví dụ như 「front」「index」「intro」「home」 nếu cái nào cũng được dùng với ý nghĩa top page thì ngôn ngữ sẽ bị loạn、đặc biệt khi có nhiều người cùng thực hiện hoặc CSS được chia làm nhiều file sẽ trở nên khó quản lí。<br>
> Nếu dùng chung ngôn ngữ thì dù ở trang nào hay vị trí nào thì cũng dễ hiểu hơn。<br>
> ※ Nếu HTMLvà CSS cùng dùng chung tên file thì cũng dễ hiểu hơn。
<br>

<p><a href="#">lên đầu trang</a></p>

<br>

---

<br>

## các bài tham khảo
- [Maintainable CSS | Công ty Cổ phần Cyber Agent](http://web.archive.org/web/20160702044546/https://www.cyberagent.co.jp/techinfo/techreport/report/id=7926)
- [8 CSS selectors DO’s and DON’Ts](https://medium.com/@aljullu/8-css-selectors-dos-and-don-ts-1e0d23fcf96c)
- [Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.html)
- [Hướng dẫn coding（HTML5）ver1.0](http://met.hanatoweb.jp/guideline/html5/)
Hết。
