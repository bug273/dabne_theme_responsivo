<?php

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
