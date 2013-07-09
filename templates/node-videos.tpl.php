<?php
// $Id: node.tpl.php,v 1.1.2.1 2010/06/17 07:54:57 sociotech Exp $
?>

<div data-theme="c" id="node-<?php print $node->nid; ?>" class="node-content node <?php print $node_classes; ?>">
  <div class="inner">

    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>

    <?php if ($submitted): ?>
    <?php endif; ?>

    <div class="content clearfix">
  <?php
  ?>
    <?php echo $video;?>
    <?php echo $description;?>
    <?php echo $node_footer;?>
    <?php //echo $content;?>
    </div>

    <?php if ($terms): ?>
    <?php endif;?>

    <?php if ($links): ?>
    <?php endif; ?>
  </div><!-- /inner -->

</div><!-- /node-<?php print $node->nid; ?> -->
