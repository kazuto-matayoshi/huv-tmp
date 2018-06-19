(function($){

  var _allNum = 0;
  // ------------------------------------------------------
  // ready - ここから
  // ------------------------------------------------------
    $(function(){
      $.each( $('.MVslide__item'), function( i, target ){
        $( this )
        .attr( 'data-slide_n', i )
        .append( '<span class="MVslide__view__ttl">MV Item' + ( i + 1 ) + '</span>' );
      });
      $.each( $('.MVControl__item'), function( i, target ){
        $( this )
        .attr( 'data-slide_n', i );
      });

      _allNum = $('.MVslide__item').length;
    });
  // ------------------------------------------------------
  // ready - ここまで
  // ------------------------------------------------------


  // ------------------------------------------------------
  // メディアアップローダー - ここから
  // ------------------------------------------------------

    var custom_uploader,$rootBox,operation_n,unique_n;

    /*##############################*/
    /* 画像選択ボタンがクリックされた場合の処理。*/
    /*##############################*/
    $(document).on( 'click', '.MVControl__uiBtn__item--add button, .MVControl__uiBtn__item--change button', function( e ) {
      var target   = $( '.MVControl__wrapper' ).children();
      $rootBox     = $( this ).closest( '.MVControl__uiBox' );

      operation_n  = target.has( this ).index();
      unique_n     = $rootBox.parents( '.MVControl__item' ).attr( 'id' ).split( '--' )[1];

      e.preventDefault();

      if (custom_uploader) {
        custom_uploader.open();
        return;
      }

      custom_uploader = wp.media({
        title: 'Choose Image',
        // 以下のコメントアウトを解除すると画像のみに限定される。

        library: {
          type: 'image'
        },

        button: {
          text: 'Choose Image'
        },

        multiple: false // falseにすると画像を1つしか選択できなくなる
      });

      custom_uploader.on( 'select', function() {
        var images = custom_uploader.state().get( 'selection' );
        images.each( function(file) {
          var img_src;
          var img_id = file.toJSON().id;

          // /.MVControl__item
          $rootBox.find( '.MVControl__views' ).css({
            'background-image': 'url(' + file.toJSON().url + ')',
          });

          $rootBox.find( 'input[name*=img]' ).val( file.toJSON().url );
          $rootBox.find( '.MVControl__uiBtn__item--add' ).hide();
          $rootBox.find( '.MVControl__uiBtn__item--change' ).show();
          $rootBox.find( '.MVControl__uiBtn__item--del' ).show();


          // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
          // 画像が変更されたときのMV Demoの処理 - 開始
          // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
            var _val     = {};

            $.each( $rootBox.parent().find( 'input[name*=img]' ), function( i, target ){
              var type   = $( this ).attr( 'name' ).split( '[' )[0];
              _val[type] = $( this ).val();
            });

            var MVHtml = '';
            $.each( _val, function( key, val ){
              if ( val ) {
                MVHtml += '<span class="MVslide__view MVslide__view--' + key + '" style="background-image: url(' + val + ')"></span>';
              }
            });
            MVHtml += '<span class="MVslide__view__ttl">MV Item' + ( Number( unique_n ) + 1 ) + '</span>';

            // 該当のIDがない場合
            if ( $( '#MVslide__item--' + unique_n ).length === 0 ) {

              //  '.MVslide__item' )が存在しない場合
              if ( $( '.MVslide__item' ).length === 0 ) {
                $( '.MVslide__inner' ).append( '<li class="MVslide__item swiper-slide" id="MVslide__item--' + unique_n + '" data-slide_n="' + operation_n + '">' + MVHtml + '</li>' );
              }

              //  operation_n === 0 の場合
              else if ( operation_n === 0 ) {
                $( '.MVslide__inner' ).prepend( '<li class="MVslide__item swiper-slide" id="MVslide__item--' + unique_n + '" data-slide_n="0">' + MVHtml + '</li>' );
              }

              //  '.MVslide__item' )が存在し、inde === 0 じゃない場合
              else {
                var flag    = false;
                var slide_n = 0;
                for ( i = operation_n; i >= 0; --i ) {
                  if ( $( '.MVslide__item[data-slide_n="' + ( i - 1 ) + '"]' ).length !== 0 ) {
                    flag = true;
                    slide_n = i - 1;
                    break;
                  }
                }

                if ( flag ) {
                  $( '.MVslide__item[data-slide_n="' + slide_n + '"]' ).after( '<li class="MVslide__item swiper-slide" id="MVslide__item--' + unique_n + '" data-slide_n="' + operation_n + '">' + MVHtml + '</li>' );
                }
              }
              swiper.update();
            }
            else {
              $( '.MVslide__item[data-slide_n="' + operation_n + '"]' ).html();
              $( '.MVslide__item[data-slide_n="' + operation_n + '"]' ).html( MVHtml );
            }
            reassign();
          // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
          // 画像が変更されたときのMV Demoの処理 - 終了
          // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        });
      });
      custom_uploader.open();
    });

    /*##############################*/
    /* 画像削除がクリックされた場合の処理。*/
    /*##############################*/
    $(document).on( 'click', '.MVControl__uiBtn__item--del button', function( e ) {
      e.preventDefault();
      e.stopPropagation();
      $rootBox = $( this ).closest( '.MVControl__uiBox' );
      $rootBox.find( '.MVControl__views' ).css({
        'background-image': 'none',
      });

      $rootBox.find( 'input[name*=img]' ).val( '' );
      $rootBox.find( '.MVControl__uiBtn__item--del' ).hide();
      $rootBox.find( '.MVControl__uiBtn__item--change' ).hide();
      $rootBox.find( '.MVControl__uiBtn__item--add' ).show();

      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
      // 画像が変更されたときのMV Demoの処理 - 開始
      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        var target = $( '.MVControl__wrapper' ).children();
        var operation_n  = target.has( this ).index();
        var _val   = {};
        $.each( $rootBox.parent().find( 'input[name*=img]' ), function( i, target ){
          var type = $( this ).attr( 'name' ).split( '[' )[0];
          _val[type] = $( this ).val();
        });

        var MVHtml = '';
        $.each( _val, function( key, val ){
          if ( val ) {
            MVHtml += '<span class="MVslide__view MVslide__view--' + key + '" style="background-image: url(' + val + ')"></span>';
          }
        });

        if ( MVHtml === '' ) {
          // swiper -> mv_control.js
          $( '.MVslide__item[data-slide_n="' + operation_n + '"]' ).remove();
          swiper.update();
          // swiper.removeSlide( operation_n );
        }
        else {
          $( '.MVslide__item[data-slide_n="' + operation_n + '"]' ).html();
          $( '.MVslide__item[data-slide_n="' + operation_n + '"]' ).html( MVHtml );
        }
      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
      // 画像が変更されたときのMV Demoの処理 - 終了
      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
    });

  // ------------------------------------------------------
  // メディアアップローダー - ここまで
  // ------------------------------------------------------

  // ------------------------------------------------------
  // コンテンツ追加 - ここから
  // ------------------------------------------------------

    $(document).on( 'click', '.MVControl__addBox button', function( e ) {
      e.preventDefault();
      e.stopPropagation();
      ++_allNum;

      // var l = $( '.MVControl__item' ).length;
      var l = _allNum;

      var html = '';

      html += '<div class="MVControl__item" id="MVControl__item--' + l + '" data-slide_n="' + l + '">';
        html += '<div class="MVControl__item__head">';
          html += '<h3 class="MVControl__item__ttl">MV Item' + ( l + 1 ) + '<a href="#"></a></h3>';
          html += '<ul class="MVControl__item__thumbnail"></ul>';
        html += '</div>';

        html += '<div class="MVControl__item__inner" style="display: none;">';
          html += '<div class="MVControl__uiArea">';
            html += '<div class="MVControl__uiBox MVControl__uiBox--pc">';
              html += '<h4 class="MVControl__uiTtl">PC</h4>';

              html += '<p class="MVControl__views" style=""></p>';

              html += '<ul class="MVControl__uiBtn">';
                html += '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--add"><button type="button" class="button-primary">PC用の画像を選択</button></li>';
                html += '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--change"><button type="button" class="button-primary">PC用の画像を変更</button></li>';
                html += '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--del"><button type="button">PC用の画像を削除</button></li>';
              html += '</ul>';

              html += '<input type="hidden" name="img_pc[' + l + ']" value="">';

            html += '</div>';

            html += '<div class="MVControl__uiBox MVControl__uiBox--sp">';
              html += '<h4 class="MVControl__uiTtl">SP</h4>';

              html += '<p class="MVControl__views" style=""></p>';

              html += '<ul class="MVControl__uiBtn">';
                html += '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--add"><button type="button" class="button-primary">SP用の画像を選択</button></li>';
                html += '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--change"><button type="button" class="button-primary">SP用の画像を変更</button></li>';
                html += '<li class="MVControl__uiBtn__item MVControl__uiBtn__item--del"><button type="button">SP用の画像を削除</button></li>';
              html += '</ul>';

              html += '<input type="hidden" name="img_sp[' + l + ']" value="">';
            html += '</div>';
          html += '</div>';
          html += '<div class="MVControl__inputArea">';
            html += '<div class="MVControl__input__anchor">';
              html += '<p class="MVControl__input__link"><label>リンク : <input type="url" name="link[' + l + ']" value="" autocomplete></label></p>';

              html += '<p class="MVControl__input__blank"><label><input type="checkbox" name="blank[' + l + ']" value="true">blank</label></p>';
            html += '</div>';
          html += '</div>';
          html += '<p class="MVControl__delBox"><button type="button">コンテンツを削除</button></p>';
        html += '</div>';
      html += '</div>';

      $html = $( html );
      $( '.MVControl__wrapper' ).append( $html );

      // append Callback
      $html.ready(function(){
        $html.find( '.MVControl__item__inner' ).slideDown();
      });
    });

  // ------------------------------------------------------
  // コンテンツ追加 - ここまで
  // ------------------------------------------------------

  // ------------------------------------------------------
  // delete - ここから
  // ------------------------------------------------------

    $(document).on( 'click', '.MVControl__delBox button', function( e ) {
      $target = $( this ).parents( '.MVControl__item' );
      var slide_n = $target.attr( 'data-slide_n' );
      $target.slideUp( 'normal', function(){
        $target.remove()
        $( '.MVslide__item[data-slide_n="' + slide_n + '"]' ).remove();
        swiper.update();
        reassign();
      });


      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
      // 画像が変更されたときのMV Demoの処理 - 開始
      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-

      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
      // 画像が変更されたときのMV Demoの処理 - 終了
      // -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
    });

  // ------------------------------------------------------
  // delete - ここまで
  // ------------------------------------------------------

  // ------------------------------------------------------
  // slideToggle - ここから
  // ------------------------------------------------------

    $(document).on( 'click', '.MVControl__item__ttl a', function( e ) {
      var $rootBox = $( this ).parents( '.MVControl__item' );

      e.preventDefault();
      e.stopPropagation();

      $rootBox.find( '.MVControl__item__inner' ).stop().slideToggle();
      $( this ).toggleClass( 'open' );

      if ( $( this ).hasClass( 'open' ) ) {
        var _val     = {};

        $.each( $rootBox.find( 'input[name*=img]' ), function( i, target ){
          var type   = $( this ).attr( 'name' ).split( '[' )[0];
          _val[type] = $( this ).val();
        });

        var thumbHtml = '';
        $.each( _val, function( key, val ){
          if ( val ) {
            thumbHtml += '<li class="' + key + '" style="background-image: url(' + val + ')"></li>';
          }
          else {
            thumbHtml += '<li class="no_img ' + key + '" style=""><span>No Img...</span></li>';
          }
        });
        // if ( _val['img_pc'] ) {
        //   thumbHtml += '<li class="" style="background-image: url(' + _val['img_pc'] + ')"></li>';
        // }
        // else {
        //   thumbHtml += '<li class="no_img" style=""><span>No Img...</span></li>';
        // }

        $rootBox.find( '.MVControl__item__thumbnail' ).append( thumbHtml );
      }
      else {
        $rootBox.find( '.MVControl__item__thumbnail' ).html( '' );
      }
      return false;
    });

  // ------------------------------------------------------
  // slideToggle - ここまで
  // ------------------------------------------------------


  // ------------------------------------------------------
  // sortable - ここから
  // ------------------------------------------------------

    $( '.MVControl__wrapper' ).sortable({
      tolerance: 'pointer',
      sort: function( event, ui ) {
        // console.log( ui );
        $( '.ui-sortable-placeholder' ).css({
          'height': ui.item.height(),
        });
      },
      update: function( event, sortableItem ) {
        var prev_n   = sortableItem.item.prev().attr( 'data-slide_n' );
        var unique_n = sortableItem.item.attr( 'id' ).split( '--' )[1];
        var next_n   = sortableItem.item.next().attr( 'data-slide_n' );
        var html     = $( '#MVslide__item--' + unique_n );

        html.remove();

        if ( prev_n === undefined ) {
          // console.log( 'prev_n : ' + prev_n );
          $( '.MVslide__inner' ).prepend( html );
        }
        else if ( next_n === undefined ) {
          // console.log( 'next_n : ' + next_n );
          $( '.MVslide__inner' ).append( html );
        }
        else {
          // console.log( 'else' );
          $( '.MVslide__item[data-slide_n=' + next_n + ']' ).before( html );
        }

        swiper.update();
        reassign();
      },
    });

  // ------------------------------------------------------
  // sortable - ここまで
  // ------------------------------------------------------


  // ------------------------------------------------------
  // View Demo - ここから
  // ------------------------------------------------------
    $(document).on( 'click', '.MVControl__createMV__btn button', function( e ) {
      $( '.MVControl__createMV__modal' ).css({
        'visibility':'visible',
      });

      var top = $( '.MVslide' ).offset().top + $( '.MVslide' ).height();
      $( '.MVControl__createMV__modal--close' ).css({
        'top' : top + 20,
      });
    });

    $(document).on( 'click', '.MVControl__createMV__modal', function( e ) {
      e.preventDefault();
      $( '.MVControl__createMV__modal' ).attr( 'style', '' );
    });

    $(document).on( 'click', '.MVslide', function( e ) {
      e.stopPropagation();
    });

    $(window).on( 'resize', function(){
      var top = $( '.MVslide' ).offset().top + $( '.MVslide' ).height();
      $( '.MVControl__createMV__modal--close' ).css({
        'top' : top + 20,
      });
    });
  // ------------------------------------------------------
  // View Demo - ここまで
  // ------------------------------------------------------







  function reassign() {
    $.each( $( '.MVslide__item' ), function( i, target ) {
      $( this ).attr( 'data-slide_n', i );
    });
    $.each( $( '.MVControl__item' ), function( i, target ) {
      $( this ).attr( 'data-slide_n', i );
    });
  }



  // 歯抜けした配列を詰める関数 (phpから輸入)
  function array_values(input) {
    var tmp_arr = [],
        key = '';

    if ( input && typeof input === 'object' && input.change_key_case ) {
      return input.values();
    }

    for ( key in input ) {
      tmp_arr[tmp_arr.length] = input[key];
    }

    return tmp_arr;
  }
})(jQuery);