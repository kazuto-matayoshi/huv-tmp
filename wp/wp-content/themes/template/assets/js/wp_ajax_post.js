(function($){
  var get_posts = function( $target, $data, $args ) {
    var domain   = location.hostname;
    var protocol = window.location.protocol;

    var option = {
      ajaxurl       : protocol + '//' + domain + '/wp/wp-admin/admin-ajax.php',
      type          : 'add', // 'add' or 'change'
      action        : null,
      init          : function(){},
      moreEnd       : function(){},
      noneObj       : function(){},
      htmlContent   : function(){},
      ajaxLoadStart : function(){},
      ajaxLoadEnd   : function(){},
      ajaxLoadError : function(){},
    };

    // extend
    var setting = Object.extend(
      true,
      option,
      $args
    );

    // ERROR
    if ( setting.action === null ) {
      console.error( 'Need setting "$args.action".\nThis value is the function name of php you want to execute.' );
    }

    var jqXHR = $.ajax({
      type: 'POST',
      url : setting.ajaxurl,
      data: {
        action : setting.action,
        data   : $data,
      },
    });

    setting.ajaxLoadStart();

    jqXHR.done( function( response ) {
      // console.log( response );
      setting.init();

      var jsonData = JSON.parse( response ), el = '';

      $.each( jsonData, function( i, val ) {
        // jsonデータのkeyに'end'が入っていない場合
        if ( i === 'end' ) {
          setting.moreEnd();
        }
        else if ( i === 'noneObj' ) {
          setting.noneObj();
        }
        else {
          var html = setting.htmlContent(val);

          // デバック
          if ( html === undefined ) {
            console.error('Please do "retrun" when using "htmlContent(val)".');
          }

          el += html;
        }
      });

      switch ( setting.type ) {

        // setting.type === 'change'
        case 'change':
          // $targetを空にした後、エレメントを追加。
          $target.empty().append(el);
          break;

        // setting.type === 'add'
        case 'add':
          // $targetにエレメントを追加。
          $target.append(el);
          break;

        // else
        default:
          break;
      }

      setting.ajaxLoadEnd();
    });

    jqXHR.fail( function( data ) {
      setting.ajaxLoadError();

      console.error('We couldn\'t get it. Please also review php.');

      setting.ajaxLoadEnd();
    });

    this.get_settings = setting;
  };

  // カプセル化した後外から呼ばれたときに呼び出せるようにした処理
  window.get_posts = get_posts;

  // jQueryのextendを移植
  Object.extend = function() {
    var toString = Object.prototype.toString;
    var options, name, src, copy, copyIsArray, clone,
        target = arguments[ 0 ] || {},
        i = 1,
        length = arguments.length,
        deep = false;

      // Handle a deep copy situation
      if ( typeof target === "boolean" ) {
        deep = target;

        // Skip the boolean and the target
        target = arguments[ i ] || {};
        i++;
      }

      // Handle case when target is a string or something (possible in deep copy)
      // if ( typeof target !== "object" && !jQuery.isFunction( target ) ) {
      if ( typeof target !== "object" && toString.call( target ) !== '[object Function]' ) {
        target = {};
      }

      // Extend jQuery itself if only one argument is passed
      if ( i === length ) {
        target = this;
        i--;
      }

      for ( ; i < length; i++ ) {

        // Only deal with non-null/undefined values
        if ( ( options = arguments[ i ] ) != null ) {

          // Extend the base object
          for ( name in options ) {
            src = target[ name ];
            copy = options[ name ];

            // Prevent never-ending loop
            if ( target === copy ) {
              continue;
            }

            // Recurse if we're merging plain objects or arrays
            // if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
            if ( deep && copy && ( toString.call( copy ) === '[object Object]' ||
              ( copyIsArray = Array.isArray( copy ) ) ) ) {

              if ( copyIsArray ) {
                copyIsArray = false;
                clone = src && Array.isArray( src ) ? src : [];

              } else {
                // clone = src && jQuery.isPlainObject( src ) ? src : {};
                clone = src && toString.call( src ) === '[object Object]' ? src : {};
              }

              // Never move original objects, clone them
              target[ name ] = Object.extend( deep, clone, copy );

            // Don't bring in undefined values
            } else if ( copy !== undefined ) {
              target[ name ] = copy;
            }
          }
        }
      }

      // Return the modified object
      return target;
  };
})(jQuery);