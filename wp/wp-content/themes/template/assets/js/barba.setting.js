(function($){
  console.log('load');
  Barba.Pjax.start();

  //head内のタグを更新
  Barba.Dispatcher.on( 'newPageReady', function( currentStatus, oldStatus, container, newPageRawHTML ) {
    /**
     * header
     */
    var $newPageHead = $( '<head />' ).html(
      $.parseHTML(
        newPageRawHTML.match( /<head[^>]*>([\s\S.]*)<\/head>/i )[ 0 ],
        document,
        true
      )
    );

    // 更新が必要なタグ
    var headTags = [
      'link[rel="stylesheet"]',
      'link[rel="canonical"]',
      'meta[name="keywords"]',
      'meta[name="description"]',
      'meta[name^="twitter"]',
      'meta[property^="og"]',
      'meta[itemprop]',
    ].join( ',' );

    // タグを削除
    $( 'head' ).find( headTags ).remove();

    // タグを追加
    $newPageHead.find( headTags ).appendTo( 'head' );

    /**
     * footer
     */
    var $newPageScript = $( '#barba-scripts' ).html(
      $.parseHTML(
        newPageRawHTML.match( /<div[^>]*id="barba-scripts"[^>]*>([\s\S.]*)<\/div>/i )[ 0 ],
        document,
        true
      )[0].innerHTML
    );

    return false;
  });
})(jQuery);