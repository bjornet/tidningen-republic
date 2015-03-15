<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <?php // Dela upp i rows, för styling och bootstrap-grid ?>
  <?php if (strpos($classes_array[$id], 'odd')) print '<div class="row">'; ?>
    <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
      <?php print $row; ?>
    </div>
    <?php if (strpos($classes_array[$id], 'even') && !strpos($classes_array[$id], 'last')) print '<hr class="hidden-xs">'; ?>

  <?php if (strpos($classes_array[$id], 'even') || strpos($classes_array[$id], 'last')) print '</div>'; ?>
<?php endforeach; ?>