<?php
/**
 * HUV_xxx_shareのxxx部分は
 * widgets/HUV_sns_shares.phpの
 * $use_sns_arrayの中と同じ
 */
function HUV_Twitter_share( $url, $content ) {
  $text     = 'text';
  $hashtags = 'あいうえお,test';
  return '<a href="http://twitter.com/share?text='.$text.'%0D%0A&url='.$url.'&hashtags='.$hashtags.'" rel="nofollow" target="_blank">'.$content.'</a>';
}
function HUV_Facebook_share( $url, $content ) {
  return '<a href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank">'.$content.'</a>';
}
function HUV_LINE_share( $url, $content ) {
  $title = 'title';
  return '<a href="http://line.me/R/msg/text/?'.$title.'%0D%0A'.$url.'" target="_blank">'.$content.'</a>';
}
function HUV_hatena_share( $url, $content ) {
  return '<a href="http://b.hatena.ne.jp/add?mode=confirm&url='.$url.'" rel="nofollow" target="_blank">'.$content.'</a>';
}
function HUV_Google_share( $url, $content ) {
  return '<a href="https://plus.google.com/share?url='.$url.'" rel="nofollow" target="_blank">'.$content.'</a>';
}
function HUV_pocket_share( $url, $content ) {
  return '<a href="http://getpocket.com/edit?url='.$url.'" rel="nofollow" target="_blank">'.$content.'</a>';
}