<?php
function creporter_mobile_preprocess_node_videos(&$vars) {
  $vars['video']=<<<EOD
EOD;
  /*
  if($vars['field_choose_video'][0]['safe'] ==  'embeddcode') {
    foreach($vars['field_video'] as $video) {
      $vars['video'].= $video['view'];
    }
  } else  {
    foreach($vars['field_upload_youtube'] as $video) {
      $vars['video'].= $video['view'];
    }

  } 
  */
  $f = array('width="425"','height="350"');
  $r = array('width="610"','height="360"');
  if($vars['field_upload_youtube_rendered']) {
    $vars['video'] = str_replace($f, $r, $vars['field_upload_youtube_rendered']);
  } else  { 
    foreach($vars['field_video'] as $video) {
      $vars['video'] = str_replace($f, $r, $video['view']);
    }
  } 

}
function creporter_mobile_preprocess_node_images(&$vars)  {
  foreach($vars['field_image'] as $image) {
    $attributes = array('width' => '100%');
    $vars['image'] = theme('imagecache', 'mobile_image', $image['filepath'], $vars['title'], $vars['title'], $attributes, FALSE);
    //$vars['image'].=  $image['view'];
  }
}
function creporter_mobile_preprocess_node_audio(&$vars) {
  global $base_url;


  $js = drupal_get_path('theme', 'creporter_mobile') . '/js/jplayer.min.js';
  $path = drupal_get_path('theme', 'creporter_mobile') . '/js/';
  $file = $vars['field_audio'][0]['filepath'];
  $js = "<script type=\"text/javascript\" src=\"/$js\"></script>";
  $mp3  = $base_url .'/' . $file  ;
  $audio  = $vars['field_audio'][0]['view'];
  $vars['audio']=<<<EOD
$audio
EOD;
}
function creporter_mobile_preprocess_node_story(&$vars) {
  $vars['image'] = $vars['field_image_rendered'];
}
