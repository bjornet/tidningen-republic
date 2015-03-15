<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see http://api.drupal.org/api/drupal/modules!node!node.tpl.php/7
 */
 
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php print render($title_prefix); ?> 
 
  <?php if(!empty($ad_link)): // Länka om det är en bild ?>

  	<a href="<?php print $ad_link; ?>">
			<?php print render($content['field_media']); ?>
		</a>
	
	<?php else: ?>	
		<?php print render($content['field_media']); ?>	
	<?php endif; ?>
	
<?php print render($title_suffix); ?>
</div>