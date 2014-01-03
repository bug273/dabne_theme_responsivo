<?php

/**
 * implementation of hook_panels_layouts
 */
// Plugin definition
$plugin = array(
  'title' => t('Dabne 3 columnas 25/50/25'),
  'category' => t('Columns: 3'),
  'icon' => 'threecol_25_50_25.png',
  'theme' => 'dabne',
  'theme arguments' => array('id', 'content'),
  'css' => 'dabne.css',
  'regions' => array(
    'left' => t('Left side'),
    'middle' => t('Middle column'),
    'right' => t('Right side')
  ),
);

