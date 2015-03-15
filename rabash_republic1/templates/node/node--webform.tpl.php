<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see http://api.drupal.org/api/drupal/modules!node!node.tpl.php/7
 */
 
// We hide the comments and links now so that we can render them later.
hide($content['comments']);
hide($content['links']);
 
?>
<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>  
	  <?php if (!$page && $title): ?>
      <a href="<?php print $node_url; ?>" class="node__link" rel="bookmark">
        <?php print render($content['field_media']); ?>
  	  	<h2<?php print $title_attributes; ?>><?php print $title; ?></h2>  
      </a>  
	  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  <?php if ($unpublished): ?>
		<p class="meta meta--unpublished"><?php print t('Unpublished'); ?></p>
	<?php endif; ?>  
  
  <?php if ($page && $display_submitted): ?>
  <div class="meta meta--submitted">
    <?php print $submitted; ?>
  </div>
  <?php endif; ?>

	<div class="node__content">
		<?php print render($content);	?>
  </div>

</article><!-- /.node -->
