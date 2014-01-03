<?php

/**
* @file
* contiene las funciones preprocess para el tema Dabne
*/

/**
* Implements hook_preprocess_html()
*
* Incluye CSS para las fuentes
*
*/

function dabne_preprocess_html(&$variables) {
  // añade css a las fuentes
  drupal_add_css(
    'http://fonts.googleapis.com/css?family=Montserrat+Alternates',
    array('type' => 'external')
  ); 
  $rendering_meta = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible', 
      'content' => 'IE=edge, chrome=1',
    )
  ); 
  // viewport tag para moviles
  $mobile_meta = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width',
    ),
  );

  // Include meta tags
  drupal_add_html_head($rendering_meta, 'rendering_meta');
  drupal_add_html_head($mobile_meta, 'responsive_meta');

  $variables['classes_array'][] = 'dabne';

}

/**
* Implements hook_preprocess_node().
*
* Reformat date info. See http://wiki.whatwg.org/wiki/Time_element.
*/
function dabne_preprocess_node(&$variables) {
  // Use Drupal's format_date function to reformat dates for the <time> element.
  $variables['date_time'] = format_date($variables['created'], 'custom', 'Y-m-d H:i:s');
  $variables['clean_date'] = format_date($variables['created'], 'custom', 'j M Y');
}



function dabne_pager($variables) {

  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_total;

  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('< previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next >')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  if ($pager_total[$element] > 1){
    if($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

    if($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }

    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'item' => $items,
      'attributes' => array('class' => array('pager')),
    ));
  }
}


/* 
* Funcion para el registro de los hooks del tema 
*
*/

function _dabne_theme_layouts() {
  $info = array();

  foreach (dabne_layouts_info() as $layout) {
    $hook = str_replace('-', '_', $layout['template']);
    $info[$hook] = array(
      'template' => $layout['template'],
      'path' => $layout['path'],
    );
  }

  return $info;
}


/*
* Layout preprocess para inicializar las variables por defecto
*/

function _dabne_preprocess_default_layout_variables(&$variables, $hook) {
  $classes = isset($variables['classes_array']) ? $variables['classes_array'] : array();
  template_preprocess($variables, $hook);
  $variables['classes_array'] = $classes;

  $layout = $variables['dabne_layout'];
  $variables['attributes_array']['class'][] = 'l-page';

  if($matches = preg_grep('/^sidebar/', array_keys($layout['info']['regions']))) {
    $count = count(array_intersect($matches, array_keys(array_filter($variables['page']))));
    $words = array('no', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');

    if(isset($words[$count])) {
      $variables['attributes_array']['class'][] = "has-{$words[$count]}-sidebar" . (($count !== 1) ? 's' : '' );
    }

    foreach ($matches as $name) {
      if(!empty($variables['page'][$name])) {
        $variables['attributes_array']['class'][] = 'has-' . str_replace('_', '-', $name);
      }
    }
  }
}



/**
* Theme callback para renderizar el layout del tema.
*/
function theme_dabne_page_layout($variables) {
      // Clean up the theme hook suggestion so we don't end up in an infinite loop.
  unset($variables['theme_hook_suggestion'], $variables['theme_hook_suggestions']);

  $layout = $variables['dabne_layout'];
  drupal_process_attached(array('#attached' => $layout['attached']));
  dabne_layout_load_theme_assets($layout['name']);

  $hook = str_replace('-', '_', $variables['dabne_layout']['template']);
  return theme($hook, $variables);
}
  
