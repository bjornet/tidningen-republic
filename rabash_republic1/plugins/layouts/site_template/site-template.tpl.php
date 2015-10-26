<?php global $user; ?>

<div<?php print $css_id ? " id=\"$css_id\"" : ''; ?> class="layout--page <?php print $classes; ?>">

<div class="header-wrapper">
  <div class="container">
    <div class="row header">
      <header class="col-sm-5" role="banner">
        <?php print render($content['header']); ?>    
      </header>
      <div class="header-block col-sm-7 hidden-xs">
        <div class="header-block-inner pull-right clearfix">
          <?php print render($content['header_block']); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container main-content">
  <?php if (!empty($content['help'])): ?>
    <div class="layout--fixed region--help clearfix">
      <?php print render($content['help']); ?>
    </div>
  <?php endif; ?>

  <a id="main-content"></a>
  <?php print $content['content']; ?>

  <?php if (!empty($content['footer'])): ?>
    <footer class="footer row" role="contentinfo">
      <div class="col-lg-12">
        <a id="menu"></a>
        <?php print render($content['footer']); ?>
      </div>
    </footer>
  <?php endif; ?>
</div>

<?php # LYBE: Björn [Popup: Scripts] ?>
<?php if (strstr($_SERVER['REQUEST_URI'], 'hem-till-byn')): ?>
	<?php include(dirname(__FILE__)."/../../../bjorn_popup.php"); ?>
<?php endif ?>