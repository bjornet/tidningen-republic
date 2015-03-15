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
<div class="layout--top">
	<div class="layout__inner">
  	<?php print $content['top']; ?>
  </div>
</div>

<div class="layout--middle">
	<div class="layout__inner">
  	<?php print $content['middle']; ?>
  </div>
</div>

<div class="layout--bottom">
	<div class="layout__inner">
  	<?php print $content['bottom']; ?>
  </div>
</div>
