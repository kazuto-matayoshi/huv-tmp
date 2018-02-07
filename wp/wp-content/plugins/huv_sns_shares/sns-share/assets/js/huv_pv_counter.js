// CSS create
var DIR = '/wp/wp-content/plugins/huv_add_plugins/pv-count/assets/'; //←実際はここを変化させます 
var css = document.createElement( 'link' );
css.setAttribute( 'rel', 'stylesheet' );
css.setAttribute( 'href', DIR + 'css/huv_pv_counter.css' );

document.getElementsByTagName('head')[0].appendChild(css);



window.onload = function(){
  /*-----*\
   tabの切り替え処理
  \*-----*/
  var tab_item = document.querySelectorAll( '.pv_archives__tab__item' );
  [].forEach.call( tab_item, function( el, i ) {
    h  = el.children[0].clientHeight + el.children[1].clientHeight;
    el.children[1].style = 'top : ' + el.children[0].clientHeight + 'px';
    el.style = 'height : ' + h + 'px';
    el.addEventListener( 'click', function(e) {

      $this = this.parentNode.childNodes;
      // reset
      [].forEach.call( $this, function( $el, i ) {
        if ( $el.nodeValue === null ) {
          $el.style = '';
          $el.children[0].classList.remove( 'on' );
        }
      }, false);
      h = this.children[0].clientHeight + this.children[1].clientHeight;
      this.style = 'height : ' + h + 'px';
      this.children[1].style = 'top : ' + this.children[0].clientHeight + 'px';
      this.children[0].classList.add('on');
    });
  });
};