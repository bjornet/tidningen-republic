<?php

// Plugin definition
$plugin = array(
  'title' => t('One column'),
  'category' => t('Custom'),
  'icon' => 'one-col.png',
  'theme' => 'one-col',
  'regions' => array(  	
    'content' => t('Main content'),
    'bottom' => t('Bottom'),
    'charts' => t('Statistics')
  ),
);
