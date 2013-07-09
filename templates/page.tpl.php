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
$(function() {
  // Resize videos dynamically
  $(document).ready(function() {
   // put all your jQuery goodness in here.
    var $allVideos = $("object[data^='http://www.youtube.com']");
    var $allStoryImages = $(".node-type-story img");
    var $fluidEl = $(".node-content .content");
    $(window).resize(function() {
      $allVideos.each(function() {
        $(this)
          .removeAttr('height')
          .removeAttr('width');
      });
    });
  });
});
</script>
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
.emvideo-youtube, .field-type-video-upload  {
    height: 0;
    overflow: hidden;
    padding-bottom: 56.25%;
    padding-top: 30px;
    position: relative;
}
.field-type-video-upload  iframe, .field-type-video-upload  object, .field-type-video-upload embed,
.media-youtube iframe, .media-youtube object, .media-youtube embed {
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}

</style>
</head> 
<body style="min-height:800px" onload="setTimeout(function() {window.scrollTo(0, 1)}, 100)"> 
<div data-role="page" data-theme="b" class="largeLogo" id="page"> 
  <div data-role="header" class="bB">
    <h1 style="white-space: normal"><?php echo $title;?></h1>
    <a href="/" data-icon="home" data-iconpos="notext" rel="external" class="ui-btn-right jqm-home" title="Home" data-theme="b">Home</a>
  </div><!-- /header -->

  <div data-role="content" style="overflow:hidden;" id="main-content">
  <?php echo $messages;?>
  <?php echo $content;?>
  </div> <!-- /content -->


  <div data-role="footer" data-theme="b">
    <div class="ui-grid-a">
      <div class="ui-block-a">
      <div data-role="button" data-theme="c"><?php echo mobile_tools_block_message();?></div>

      </div>
      <div class="ui-block-b">
      <div class="disclaimer"><?php echo $footer_message;?></div>
      </div>
    </div><!-- /grid-a -->
  </div>
<?php if($tabs):?>
<?php echo $tabs;?>
<?php endif;?>
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
