<?php

/**
 * implementation of hook_panels_layouts
 */
// Plugin definition
$plugin = array(
  'title' => t('Dorado Three column 25/50/25'),
  'category' => t('Columns: 3'),
  'icon' => 'threecol_25_50_25.png',
  'theme' => 'dorado',
  'theme arguments' => array('id', 'content'),
  'css' => 'dorado.css',
  'regions' => array(
    'left' => t('Left side'),
    'middle' => t('Middle column'),
    'right' => t('Right side')
  ),
);

