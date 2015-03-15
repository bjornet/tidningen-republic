<?php

// Plugin definition
$plugin = array(
  'title' => t('Two columns'),
  'category' => t('Custom'),
  'icon' => 'two-col.png',
  'theme' => 'two-col',
  'regions' => array(  	
    'top_content' => t('Top content'),
    'content' => t('Main content'),
    'secondary' => t('Secondary content'),
    'bottom' => t('Bottom')
  ),
);
