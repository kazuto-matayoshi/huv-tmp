(function($){
  console.log('common');
  // var swiper = new Swiper('.mv');

  /* smooth scroll */
  $('a[href *= "#"]').on('click',function(){
    var speed     = 700;

    var target    = $(this).attr('href').split('#');
    target        = target ? "#" + target[1] : "#";

    if ( target !== "#" && $( target ).length === 0 ) {
      return;
    }

    var targetTop = target != "#" ? $( "#" + target[1] ).offset().top : 0;

    $('html,body').stop().animate({
        scrollTop: targetTop,
      },
      {
        'duration': speed,
        'easing': 'swing',
    });

    return false;
  });
})(jQuery);