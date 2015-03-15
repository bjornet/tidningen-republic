<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * each column roughly equal in width.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 */
?>

<div class="layout--full clearfix region region--main layout--one-col<?php if (!empty($css_id)) print ' ' . $css_id; ?>" role="main">
	<?php print $content['content']; ?>
</div>

<?php if($content['bottom']): ?>
<div class="layout--full layout--bottom layout--one-col clearfix">
  <?php print $content['bottom']; ?>
</div>
<?php endif; ?>

<?php if($content['charts']): ?>
<div class="layout--full layout--charts layout--one-col clearfix">
  <?php print $content['charts']; ?>
</div>
<?php endif; ?>
