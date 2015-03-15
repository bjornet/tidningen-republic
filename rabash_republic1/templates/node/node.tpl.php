<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see http://api.drupal.org/api/drupal/modules!node!node.tpl.php/7
 */

// We hide the comments and links now so that we can render them later.
hide($content['field_bild']);

hide($content['links']);

?>
<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($content['field_bild']); ?>

  <div class="node__wrapper">
  
    <?php print render($title_prefix); ?>
    <?php if (!$page && $title): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <div class="node__content">
      <?php if($view_mode == 'full' && $display_submitted): ?>
      <div class="node__meta">
        <?php print $date; ?>
      </div>
      <?php endif; ?>
      
      <?php print render($content); ?>
    </div>

    <?php if($view_mode == 'full'): ?>
      <ul class="socialcount" data-url="<?php print $share_url; ?>" data-counts="true" data-share-text="<?php print $title . ' ' . $share_url; ?>">
        <li class="facebook first"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php print urlencode($share_url); ?>" title="Gilla på Facebook"><span class="count">Gilla</span></a></li>
        <li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php print urlencode($title . ' ' . $share_url); ?>" title="Dela på Twitter"><span class="count">Tweeta</span></a></li>
        <li class="googleplus last"><a href="https://plus.google.com/share?url=<?php print urlencode($share_url); ?>" title="Dela på Google Plus"><span class="count">Google+</span></a></li>
      </ul>
    <?php endif; ?>

  </div>

</article><!-- /.node -->
