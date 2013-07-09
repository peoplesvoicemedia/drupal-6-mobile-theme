<?php
// $Id: node.tpl.php,v 1.1.2.1 2010/06/17 07:54:57 sociotech Exp $
?>

<div data-theme="c" id="node-<?php print $node->nid; ?>" class="node-content node <?php print $node_classes; ?>">
  <div class="inner">

    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>

    <div class="content clearfix">
    <?php echo views_embed_view('frontpage_mobile', 'block_2', array(arg(1)));?>
    </div>

    <?php if ($terms): ?>
    <div class="terms">
      <?php print $terms; ?>
    </div>
    <?php endif;?>

    <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
    <?php endif; ?>
  </div><!-- /inner -->

</div><!-- /node-<?php print $node->nid; ?> -->
