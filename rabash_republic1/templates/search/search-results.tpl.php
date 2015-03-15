<?php

/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 *
 *
 * @see template_preprocess_search_results()
 */
?>
<div class="layout--inner--wrapper">
<?php if ($search_results): ?>
  <h2 class="search__title"><?php print t('Search results');?></h2>
  <p class="search__count"><?php print $search_totals; ?></p>
  <ol class="search__results search__results--<?php print $module; ?>">
    <?php print $search_results; ?>
  </ol>
  <?php print $pager; ?>
<?php else : ?>
  <h2><?php print t('Your search yielded no results');?></h2>
  <div class="search__help">
  	<?php print search_help('search#noresults', drupal_help_arg()); ?>
  </div>
<?php endif; ?>
</div>
