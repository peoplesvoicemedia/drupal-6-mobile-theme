<!doctype html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="cleartype" content="on">
  <link rel="apple-touch-icon-precomposed" href="/sites/communityreporter.co.uk/themes/creporter_mobile/images/apple-touch-icon-precomposed.png">
  <title><?php echo $head_title;?></title>
  <link rel='canonical' href='' /> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4/jquery.mobile-1.0a4.min.css" />
  <script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
  <script>
  $(document).bind("mobileinit", function(){
    $.mobile.ajaxFormsEnabled = false;
    $.mobile.ajaxLinksEnabled = false;
  });
  </script>
  <script src="http://code.jquery.com/mobile/1.0a4/jquery.mobile-1.0a4.min.js"></script>
  <?php print $styles; ?>


<style>
.m_imgThumb {max-width:80px;vertical-align: top;margin-right: 10px;float:left;}
</style>
</head> 
<body> 
<div data-role="page" data-theme="b" class="largeLogo" id="page"> 
  <div data-role="header" data-backbtn="false" class="bB">
  <?php
  $path = drupal_get_path('theme', 'creporter_mobile');
  ?>
  <img src="/<?php echo $path;?>/images/o2012_logo_600px.png" class="static" alt="2012" id="imgOLogo" />
  </div><!-- /header -->

  <div data-role="content" style="overflow:hidden;">
    <?php echo $messages;?>
    <?php echo $content_mobile_top;?> 
    <?php echo $content;?>
  </div> 
  <footer>
  <img id="pvmLogo"  src="/<?php echo $path;?>/images/voice.png">
  <div class="disclaimer" data-role="button" data-theme="c"><?php echo mobile_tools_block_message();?></div>
  <div class="disclaimer"><?php echo $footer_message;?></div>
  </footer>
</div>
<?php print $script; ?>
<script type="text/javascript">
  addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
  function hideURLbar(){
  window.scrollTo(0,1);
  }
</script>

</body> 
</html> 
