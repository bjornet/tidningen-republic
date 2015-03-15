<?php

/**
 * Preprocess functions
 *
 *
 */



/**
 * Preprocess html
 */

function rabash_republic1_preprocess_html(&$variables, $hook) {

  // Add Fonts.com js
   drupal_add_js('http://fast.fonts.net/jsapi/4e5a4fe7-ac4d-4474-a51c-488efb5e0d88.js', array(
    'type' => 'external',
    'scope' => 'header',
    'group' => JS_THEME,
    'every_page' => TRUE,
    'weight' => -1,
  ));

  # Republic: Björn [ NEW CODE: Till Moa:s font-deck ]

  // Add fontdeck js
  // drupal_add_js("WebFontConfig = { fontdeck: { id: '49857' } };
  // 	  (function() {
  // 	    var wf = document.createElement('script');
  // 	    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
  // 	    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  // 	    wf.type = 'text/javascript';
  // 	    wf.async = 'true';
  // 	    var s = document.getElementsByTagName('script')[0];
  // 	    s.parentNode.insertBefore(wf, s);
  // 	})();",
  //   array(
  //   'type' => 'inline',
  //   'scope' => 'header',
  //   'group' => JS_THEME,
  //   'every_page' => TRUE,
  //   'weight' => -1,
  // ));
}

/**
 * Preprocess node
 */

function rabash_republic1_preprocess_node(&$variables) {
  $node = $variables['node'];

  $created = format_date($variables['created']);
  $updated = format_date($variables['changed']);
  $variables['date'] = 'Publicerad ' . $created;
  $variables['date'] .= ($updated != $created) ? ' &nbsp;&nbsp; Uppdaterad ' . $updated : ''; 

  // Egen template för zitzertexter
  $zitzer = array('blogg', 'artikel', 'textblock');
  if (in_array($variables['type'], $zitzer)) {
    $variables['theme_hook_suggestions'][] = 'node__zitzer';
  }

  // Fix till Zitzers tema-sidor
  if ($variables['type'] == 'textblock' &&
      $variables['view_mode'] == 'full') {
    $variables['page'] = 1;

  }


}

/**
 * Process field
 */

function rabash_republic1_process_field(&$variables) {
  $element = $variables['element'];

  // Field type image
  if ($element['#field_type'] == 'image') {

    // Reduce number of images in teaser view mode to single image
    if ($element['#view_mode'] != 'full') {
      $item = reset($variables['items']);
      $variables['items'] = array($item);
    }
  }
}


/**
 * Theme functions
 *
 *
 */

/**
 * Göm tom varukorg
 */
function rabash_republic1_commerce_cart_empty_block() {
  return;
}

/**
 * Översätt Order total på Checkout-sida
 */
function rabash_republic1_commerce_price_formatted_components($variables) {

  // Build table rows out of the components.
  $rows = array();

  foreach ($variables['components'] as $name => $component) {
    if ($name == 'commerce_price_formatted_amount') {
      $component['title'] = t('Order total');
    }
    $rows[] = array(
      'data' => array(
        array(
          'data' => $component['title'],
          'class' => array('component-title'),
        ),
        array(
          'data' => $component['formatted_price'],
          'class' => array('component-total'),
        ),
      ),
      'class' => array(drupal_html_class('component-type-' . $name)),
    );
  }

  return theme('table', array('rows' => $rows, 'attributes' => array('class' => array('commerce-price-formatted-components'))));
}


/**
 * Theme form alter
 *
 * Sökknappar som bilder
 */

function rabash_republic1_form_alter(&$form, &$form_state, $form_id) {
  global $theme_key;
  $theme_name = $theme_key;

  $path_to_theme = drupal_get_path('theme', $theme_name);

  switch ($form_id) {

    case 'search_block_form':
      $form['search_block_form']['#title'] = t('Search on website'); // Change the text on the label element
      $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
      $form['search_block_form']['#attributes']['placeholder'] = t('Sök på Re:public');
      $form['actions']['submit']['#value'] = t('Search'); // Change the text on the submit button
      $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . 'sites/all/themes/rabash_republic1/images/placeholder.png');
      $form['actions']['submit']['#attributes']['alt'][] = t('Search');
    break;
  }
}

/**
 * Theme field uploads
 */

function rabash_republic1_file_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $url = file_create_url($file->uri);

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
    'attributes' => array(
      'type' => $file->filemime . '; length=' . $file->filesize,
    ),
    'html' => TRUE,
  );

  // Use the description as the link text if available.
  if (empty($file->description)) {
    $link_text = $file->filename;
  }
  else {
    $link_text = $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }

  return l('<i class="icon icon-cirkelpil" aria-hidden="true"></i><span>' . $link_text . '</span>', $url, $options);
}

/**
 * Theme links
 *
 * Lägg till ikoner i menyn
 */



/**
 * Teaser image
 */

function rabash_republic1_teaser_image($node, $field, $extract = FALSE) {
  $field_size = field_get_items('node', $node, 'field_puffstorlek');
  $size = $field_size['0']['value'];

  switch ($size) {

    case 1:
      return rabash_republic1_media_size($node, $field, 'teaser_xlarge', 'node', $extract);
    break;

    case 2:
      return rabash_republic1_media_size($node, $field, 'teaser_large', 'node', $extract);
    break;

    case 3:
      return rabash_republic1_media_size($node, $field, 'teaser', 'node', $extract);
    break;

    case 4:
      return rabash_republic1_media_size($node, $field, 'teaser_small', 'node', $extract);
    break;
  }
}

/**
 * Media size
 */

function rabash_republic1_media_size($node, $field, $size, $entity_type = 'node', $extract = FALSE) {

  $media = field_get_items($entity_type, $node, $field);

  if($extract) {
    $display_settings = array(
      'label' => 'hidden',
      'type' => 'field_extractor', // Name of the formatter,
      'settings' => array('field_name' => 'field_image', 'formatter' => 'file_rendered', 'settings' => array('file_view_mode' => $size))
    );

    $mediafield = field_view_field($entity_type, $node, $field, $display_settings);

    return render($mediafield);

  } elseif($media) {
    $display_settings = array(
      'label' => 'hidden',
      'type' => 'file_rendered', // Name of the formatter,
      'settings' => array('file_view_mode' => $size)
    );

    $mediafield = field_view_field($entity_type, $node, $field, $display_settings);

    return render($mediafield);

  } else {
    return;
  }
}

/**
 * Media type
 */

function rabash_republic1_media_type($node, $field, $entity_type = 'node') {

  $media = field_get_items($entity_type, $node, $field);
  if($media) {

    return $media[0]['type'];

  } else {
    return;
  }
}
