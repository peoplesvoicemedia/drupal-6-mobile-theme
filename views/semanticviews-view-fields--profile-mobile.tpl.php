<?php
  //$picture = ($fields['picture']->raw);
  $fields = com_rep_get_render_fields($fields);
  $link = $fields['path'];
  $type = $fields['type'];
  switch($type) {
    case 'videos':
      if($fields['video'])  {
        $fields['image'] = "<img src=\"" . $fields['video'] . "\" />";
        $link = $fields['field_video_embed_1'];
      } else {
        $fields['image'] = $fields['video_upload'];
        $link = $fields['field_upload_youtube_fid_1'];
      }
      break;
    case 'story':
    case 'images':
        if($fields['image'])  {
          $fields['image']  =  "<img src=\"" . $fields['image'] . "\" />";
        } else  {
          $path  = path_to_theme();
          $fields['image'] = "<img src=\"/". $path . "/images/community-writer.png\" />";
          // 
        }
      break;
    case 'audio':
        if($fields['image'])  {
          $fields['image']  =  "<img src=\"" . $fields['image'] . "\" />";
        } else  {
          $path  = path_to_theme();
          $fields['image'] = "<img src=\"/". $path . "/images/community-audio.png\" />";
          // 
        }
      break;
    default:
      break;
  }
  switch($type) {
    case 'videos':
      $type = 'video';
      break; 
    case 'images':
      $type = 'image';
      break;
  }
?>
<!--<a rel="external" href="<?php echo $link; ?>">-->
<a href="<?php echo $link; ?>">
  <?php echo $fields['image'];?>
        <h3><?php echo $fields['title'];?></h3>
        <p><?php echo t("A " . $type );?></p></a>
<!--<a href="<?php echo $fields['path'];?>" rel="external" data-theme="b" data-transition="slideup"><?php echo $fields['title'];?></a>-->
<a href="<?php echo $fields['path'];?>" data-theme="b" data-transition="slideup"><?php echo $fields['title'];?></a>
