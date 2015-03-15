<?php
/**
 * @file
 * Returns the HTML for a node in the search result view mode.
 *
 * Complete documentation for this file is available online.
 * @see http://api.drupal.org/api/drupal/modules!node!node.tpl.php/7
 */
 
// We hide the comments and links now so that we can render them later.
hide($content['comments']);
hide($content['links']);
 
?>
<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($content['field_bild']); ?>

  <div class="node__wrapper">
  
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <div class="node__content">      
      <?php print render($content); ?>test
    </div>

  </div>
  
  <footer>
  	<p class="meta meta--search-info">
  		<?php print $human_readable_type; ?>
  	</p>
  </footer>
  
</article><!-- /.node -->
