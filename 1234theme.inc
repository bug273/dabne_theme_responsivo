<?php // $Id$

/** 
* Sobrescribe el theme implementations
*
*/

function dabne_theme() {
   return array(
     'custom_links' => array( // esta funcion renderiza el menu con h2
       'variables' => array('links' => NULL, 'attributes' => NULL, 'heading' => NULL),
       ),
     'mega_menu' => array(
       'variables' => array('menu' => NULL),
     ),     
   );
}

/**
* Menu primario con h2 por cada item
*
*/

function dabne_custom_links($variables) {
  global $language_url;
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  $output = '';

    if (count($links) > 0) {
      $output = ''; 
      if(!empty($heading)){
        if (is_string($heading)){
          $heading = array(
            'text' => $heading,
            'level' => 'h2',
          );
        }
        $output .= '<' . $heading['level'];
        if(!empty($heading['class'])) {
          $output .= drupal_attributes(array('class' => $heading['class']));
        }
        $output .= '>' . check_plain($heading['text']) . '</' . $heading['level']. '>';
      }
    $output .= '<ul' . drupal_attributes($attributes). '>'; 
    
    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // añade la primera, la ultima y la clase activa de la lista de links 
      if($i == 1) {
        $class[] = 'first';
      }
      if($i == $num_links) {
        $class[] = 'last'; 
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page())) && (empty($link['language']) || $link['language']-> language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)). '><h2>';

      if (isset($link['href'])) {
        // Pasara en la variable $link como $options, entre ellas comparten la misma key
        $output .= l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Algunos links en realidad no son links, pero quedan dentro de la misma etiqueta <span>
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = ''; 
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>'; 
      }

      $i++;
      $output .= "</h2></li>\n";
    }
    $output .= "</ul>";
    }
  return $output;
}


/**
*  Mega drop down primary  links
* 
*/

function dabne_mega_menu($variables) {
  drupal_add_js(path_to_theme() . 'js/hoverintent.js');
  drupal_add_js(path_to_theme() . 'js/dabne_menu.js');

  $menu = $variables['menu'];
  $alt = theme_gete_settings('menu_alt_class');
  $output = '<ul class="megamenu-1>'; 

  $count_main_links = 1;

  foreach ($menu as $key => $value) {
    if($value['link']['hidden'] != 1) { // con esto mira si el link esta oculto
      $id = 'main-menu-title-' . $value['link']['mlid']; // le da un valor id unico 
      $options = array();
      if (isset($value['link']['options']['attributes']['title'])) {
        $options = array('attributes' => array('title'=> $value['link']['options']['attributes']['title']));
      }
      if (theme_get_settings('menu_headings') == 1) {
        $output .= '<li class="megamenu-li-first-level" id="' . $id . '"><h2>'. l($value['link']['link_title'], $value['link']['href'], $options);
      }
      elseif (theme_get_settings('menu_headings') == 2) {
        $output .= '<li class="megamenu-li-first-level" id="' . $id . '"><h2>'. l($value['link']['link_title'], $value['link']['href'], $options) . '</h2>';
      }

      $class = "";
      $altclass = "";

      if(in_array($count_main_links, $alt)) { //añade la clase alt basado en el setting del theme
        $altclass = " alt";
      }
      switch (count($value['below'])) {
        case 1:
        $class = 'one-col' . $altclass;
        break;
        case 2:
        $class = 'two-col' . $altclass;
        break;
        case 3:
        $class = 'three-col' . $altclass;
        break;
      }

      if(count($value['below']) > 0) {
        $output .= '<div class="mega ' . $class . '">';
        $output .= '<div class="megamenuWrapper">';
         foreach ($value['below'] as $key2 => $value2) {
           if ($value2['below']) {
             $output .= '<div class="menu-section">';
           }

            $id = 'menu-section-title-' . $value2['link']['mlid'];

            $options = array('class' => array('menu-section-link'));
            if (isset($value2['link']['options']['attributes']['title'])) {
              $options['attributes'] = array('title' => $value2['link']['options']['attributes']['title']);
            }
            if (theme_get_setting('menu_headings') == 1) { 
              $output .= '<ul class="megamenu-section">'; 
                          
              if ($value2['link']['hidden'] != 1) { 
                $output .= '<li class="menu-section-title" id="' . $id . '">' . l($value2['link']['link_title'], $value2['link']['href'], $options);
              }
            }
            elseif (theme_get_setting('menu_headings') == 2) { 
              if ($value2['link']['hidden'] != 1) { 
                $output .= '<h3>' . l($value2['link']['link_title'], $value2['link']['href'], $options) . '</h3>';
                }
              }
            if ($value2['below']) {
              $output .= '<ul class="megamenu-2">'; 
              foreach ($value2['below'] as $key3 => $value3) {
                $options = array('class' => array('menu-leaf-link'));
                if (isset($value3['link']['options']['attributes']['title'])) {
                  $options['attributes'] = array('title' => $value3['link']['options']['attributes']['title']);
                }
           
            

            if ($value3['link']['hidden'] != 1) { 
              $output .= '<li class="menu-leaf-list">' . l($value3['link']['link_title'], $value3['link']['href'], $options) . '</li>'; 
            }          
          
         $output .= '</ul>'; 

           if (theme_get_setting('menu_headings') == 1) { 
             $output .= '</li>'; 
             $output .= '</ul>'; 
           }
           $output .= '</div>'; 
         }
     }                                                                                                     
     $output .= '</div>';     
     $output .= '<div class="closepanel"><span class="close-panel" title="close this panel">' . t('close this panel') . '</span></div>';
     $output .= '</div>'; 
     } 
     $output .= '</li>'; 
     $count_main_links++;
     }
   } 
  $output .= '</ul>'; // close first level <ul>
  return $output;
}



   
   
   
  


