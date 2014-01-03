<?php

/**
* @file
* Default theme implementation to display a node.
*
* @see template_preprocess()
* @see template_preprocess_node()
* @see template_process()
*/

?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; if (!$page): print ' not-page'; endif; ?>" <?php print $attributes; ?>>

  <?php if (!$page): ?>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>"><?php print $title; ?></a></h2>
    <?php print render($title_suffix); ?>
  <?php endif; ?>
  <div class="meta">
    <?php if ($submitted): ?>
      <time class="submitted writer-date" datetime="<?php print $date_time; ?>"><?php print $clean_date; ?></time>
    <?php endif; ?>
  </div>
  <div class="content"<?php print $content_attributes; ?>>
    <?php 
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
   </div>
   <?php print render($content['links']); ?>
   <?php print render($content['comments']); ?>
</div>

