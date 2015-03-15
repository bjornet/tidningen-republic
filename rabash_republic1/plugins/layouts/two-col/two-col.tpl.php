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


<div class="row content-top">
  <div class="col-lg-12">
    <?php print $content['top_content']; ?>
  </div>
</div>

<div class="row content-main" role="main">
  <div class="col-md-8 col-sm-12 sidebar-left">
    <?php print $content['content']; ?>
  </div>
  <div class="col-md-4 sidebar-right">
    <?php print $content['secondary']; ?>
  </div>
</div>
  

<?php if($content['bottom']): ?>
  <div class="row content-featured">
    <div class="col-lg-12">
      <?php print $content['bottom']; ?>
    </div>
  </div>
<?php endif; ?>
