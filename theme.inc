<?php

/**
* Preprocess variables for page.tpl.php
*
* Most themes utilize their own copy of page.tpl.php. The default is located
* inside "modules/system/page.tpl.php". Look in there for the full list of
* variables.
*
* Uses the arg() function to generate a series of page template suggestions
* based on the current path.
*
* Any changes to variables in this preprocessor should also be changed inside
* template_preprocess_maintenance_page() to keep all of them consistent.
*
* @see drupal_render_page()
* @see template_process_page()
* @see page.tpl.php
*/
function dabne_preprocess_page(&$variables) {
  // Move some variables to the top level for themer convenience and template cleanliness.
  $variables['show_messages'] = $variables['page']['#show_messages'];

  foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {
    if (!isset($variables['page'][$region_key])) {
      $variables['page'][$region_key] = array();
    }
  }
// Set up layout variable.
  $variables['layout'] = 'none';
    if (!empty($variables['page']['sidebar_first'])) {
      $variables['layout'] = 'first';
    }
    if (!empty($variables['page']['sidebar_second'])) {
      $variables['layout'] = ($variables['layout'] == 'first') ? 'both' : 'second';
    }
  }


  $variables['base_path']         = base_path();
  $variables['front_page']        = url();
  $variables['feed_icons']        = drupal_get_feeds();
  $variables['language']          = $GLOBALS['language'];
  $variables['language']->dir     = $GLOBALS['language']->direction ? 'rtl' : 'ltr';
  $variables['logo']              = theme_get_setting('logo');
  $variables['main_menu']         = theme_get_setting('toggle_main_menu') ? menu_main_menu() : array();
  $variables['secondary_menu']    = theme_get_setting('toggle_secondary_menu') ? menu_secondary_menu() : array();
  $variables['action_links']      = menu_local_actions();
  $variables['site_name']         = (theme_get_setting('toggle_name') ? filter_xss_admin(variable_get('site_name', 'Drupal')) : '');
  $variables['site_slogan']       = (theme_get_setting('toggle_slogan') ? filter_xss_admin(variable_get('site_slogan', '')) : '');
  $variables['tabs']              = menu_local_tabs();
  if ($node = menu_get_object()) {
    $variables['node'] = $node;
  }

// Populate the page template suggestions.
 if ($suggestions = theme_get_suggestions(arg(), 'page')) {
   $variables['theme_hook_suggestions'] = $suggestions;
 }
 

/**
* Process variables for page.tpl.php
*
* Perform final addition of variables before passing them into the template.
* To customize these variables, simply set them in an earlier step.
*
* @see template_preprocess_page()
* @see page.tpl.php
*/
function template_process_page(&$variables) {
  if (!isset($variables['breadcrumb'])) {
  // Build the breadcrumb last, so as to increase the chance of being able to
  // re-use the cache of an already rendered menu containing the active link
  // for the current page.
  // @see menu_tree_page_data()
    $variables['breadcrumb'] = theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb()));
  }
  if (!isset($variables['title'])) {
    $variables['title'] = drupal_get_title();
  }

  // Generate messages last in order to capture as many as possible for the
  // current page.
  if (!isset($variables['messages'])) {
    $variables['messages'] = $variables['show_messages'] ? theme('status_messages') : '';
  }
}

