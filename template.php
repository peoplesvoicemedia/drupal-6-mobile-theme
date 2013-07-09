<?php
function creporter_mobile_preprocess(&$vars, $type) {
}
function creporter_mobile_remove_css(&$vars)  {
  unset($vars['css']['all']['module']['modules/node/node.css']);
  unset($vars['css']['all']['module']['modules/system/defaults.css']);
  unset($vars['css']['all']['module']['modules/system/system.css']);
  unset($vars['css']['all']['module']['modules/system/system-menus.css']);
  unset($vars['css']['all']['module']['modules/user/user.css']);
  unset($vars['css']['all']['module']['sites/all/modules/views_slideshow/contrib/views_slideshow_singleframe/views_slideshow.css']);
  unset($vars['css']['all']['module']['sites/all/modules/views_slideshow/contrib/views_slideshow_thumbnailhover/views_slideshow.css']);
  unset($vars['css']['all']['module']['sites/all/modules/admin/includes/admin.toolbar.base.css']);
  unset($vars['css']['all']['module']['sites/all/modules/admin/includes/admin.toolbar.css']);

  unset($vars['css']['all']['theme']['sites/communityreporter.co.uk/themes/fusion/fusion_core/css/superfish.css']);
  unset($vars['css']['all']['theme']['sites/communityreporter.co.uk/themes/fusion/fusion_core/css/superfish-navbar.css']);
  unset($vars['css']['all']['theme']['sites/communityreporter.co.uk/themes/fusion/fusion_core/css/superfish-vertical.css']);
  $vars['styles'] = drupal_get_css($vars['css']);
}
function creporter_mobile_remove_js(&$vars) {
  $scripts = drupal_add_js();
  // Remove jquery
  unset($scripts['core']['misc/jquery.js']);
  unset($scripts['core']['misc/collapse.js']);

  // Remove jquery.ui
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.core.min.js']);
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.tabs.min.js']);
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.accordion.min.js']);
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.draggable.min.js']);
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.resizable.min.js']);
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.droppable.min.js']);
  unset($scripts['module']['sites/all/libraries/jquery.ui/ui/minified/ui.sortable.min.js']);
  unset($scripts['module']['misc/collapse.js']);

  unset($scripts['module']['sites/all/modules/views_slideshow/contrib/views_slideshow_singleframe/views_slideshow.js']);
  unset($scripts['module']['sites/all/modules/views_slideshow/js/jquery.cycle.all.min.js']);
  unset($scripts['module']['sites/all/modules/views_slideshow/contrib/views_slideshow_thumbnailhover/views_slideshow.js']);

  unset($scripts['module']['sites/all/modules/admin/includes/jquery.drilldown.js']);
  unset($scripts['module']['sites/all/modules/admin/includes/admin.toolbar.js']);
  unset($scripts['module']['sites/all/modules/admin/includes/admin.menu.js']);

  $path = drupal_get_path('theme', 'fusion_core'); 
  unset($scripts['theme'][$path . '/js/jquery.bgiframe.min.js']);
  unset($scripts['theme'][$path . '/js/hoverIntent.js']);
  unset($scripts['theme'][$path . '/js/supposition.js']);
  unset($scripts['theme'][$path . '/js/supersubs.js']);
  unset($scripts['theme'][$path . '/js/superfish.js']);
  unset($scripts['theme'][$path . '/js/script.js']);
  $vars['script'] = drupal_get_js('header',$scripts);

}
function creporter_mobile_content_multiple_values($element) {
  $field_name = $element['#field_name'];
  $field = content_fields($field_name);
  $output = '';

  if($field_name == 'field_image')  {
    $field['multiple'] = 0;
  }
  if ($field['multiple'] >= 1) {
    $table_id = $element['#field_name'] .'_values';
    $order_class = $element['#field_name'] .'-delta-order';
    $required = !empty($element['#required']) ? '<span class="form-required" title="'. t('This field is required.') .'">*</span>' : '';

    $header = array(
      array(
        'data' => t('!title: !required', array('!title' => $element['#title'], '!required' => $required)),
        'colspan' => 2
      ),
      t('Order'),
    );
    $rows = array();

    // Sort items according to '_weight' (needed when the form comes back after
    // preview or failed validation)
    $items = array();
    foreach (element_children($element) as $key) {
      if ($key !== $element['#field_name'] .'_add_more') {
        $items[] = &$element[$key];
      }
    }
    usort($items, '_content_sort_items_value_helper');

    // Add the items as table rows.
    foreach ($items as $key => $item) {
      $item['_weight']['#attributes']['class'] = $order_class;
      $delta_element = drupal_render($item['_weight']);
      $cells = array(
        array('data' => '', 'class' => 'content-multiple-drag'),
        drupal_render($item),
        array('data' => $delta_element, 'class' => 'delta-order'),
      );
      $rows[] = array(
        'data' => $cells,
        'class' => 'draggable',
      );
    }

    $output .= theme('table', $header, $rows, array('id' => $table_id, 'class' => 'content-multiple-table'));
    $output .= $element['#description'] ? '<div class="description">'. $element['#description'] .'</div>' : '';
    $output .= drupal_render($element[$element['#field_name'] .'_add_more']);

    drupal_add_tabledrag($table_id, 'order', 'sibling', $order_class);
  }
  else {
    foreach (element_children($element) as $key) {
      $output .= drupal_render($element[$key]);
    }
  }

  return $output;
}

function creporter_mobile_preprocess_page(&$vars) {
  creporter_mobile_remove_js($vars); 
  creporter_mobile_remove_css($vars);
  creporter_mobile_removetab('Users', $vars);
  creporter_mobile_removetab('Posts', $vars);
  creporter_mobile_removetab('Devel', $vars);
  creporter_mobile_removetab('Track', $vars);
  creporter_mobile_removetab('File browser', $vars);
  if($vars['is_front']) {
    // Set title here rather then in theme
    if ($vars['logo'] || $vars['site_name'] || $vars['site_slogan']) {
      if ($vars['logo']) {
      }
      if ($vars['site_name'] || $vars['site_slogan']) {
        $url = check_url($vars['front_page']);
        $title  = t('Home');
        $vars['title']=<<<EOD
<span id="site-name">
  <a href="$url" title="$title"><span>{$vars['site_name']}</span></a></span>
EOD;
      }
    }
    unset($vars['content']);
  }
}
function creporter_mobile_preprocess_block(&$vars) {
}
function creporter_mobile_preprocess_node(&$vars) {
  if($vars['field_description'][0]['view'] !='')  {
    $vars['description']  = $vars['field_description'][0]['view'];
  } else  {
    $vars['description'] = $vars['node']->content['body']['#value'];
  }
  $vars['description'] =  preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $vars['description']);
  include_once 'preprocess/template.preprocess.node.functions.php';
  $function = 'creporter_mobile_preprocess_node'.'_'. $vars['node']->type;
  if (function_exists($function)) {
    $function($vars);
  }
  $vars['node_footer'] = creporter_mobile_preprocess_node_footer(&$vars);
}
function creporter_mobile_preprocess_node_footer(&$vars) {
  return <<<EOD
{$vars['picture']}
{$vars['name']}
{$vars['disqus_comments']}
EOD;
}
function phptemplate_menu_tree($tree) {
  return <<<EOD
<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b"> 
$tree
</ul>

EOD;
}
function creporter_mobile_views_mini_pager($tags = array(), $limit = 10, $element = 0, $parameters = array(), $quantity = 9) {
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.


  $li_previous = theme('pager_previous', (isset($tags[1]) ? $tags[1] : t('Previous Page')), $limit, $element, 1, $parameters);
  if (empty($li_previous)) {
    $li_previous = "&nbsp;";
  }

  $li_next = theme('pager_next', (isset($tags[3]) ? $tags[3] : t('Next Page')), $limit, $element, 1, $parameters);
  if (empty($li_next)) {
    $li_next = "&nbsp;";
  }
  if ($pager_total[$element] > 1) {
    $items[] = array(
      'class' => 'pager-previous',
      'data' => $li_previous,
    );

    $items[] = array(
      'class' => 'pager-current',
      'data' => t('@current of @max', array('@current' => $pager_current, '@max' => $pager_max)),
    );

    $items[] = array(
      'class' => 'pager-next',
      'data' => $li_next,
    );
    $return = '<fieldset class=\"ui-grid-a\">';
    $i = array('a', 'b', 'b');
    foreach($items as $key => $item)  {
      if($key != 1 && $item['data']!='&nbsp;') {
        $return .= "<div data-theme=\"c\" data-role=\"button\" class=\"ui-block-{$i[$key]}\">{$item['data']}</div>";
      } else  {
        //$return .= "<div class=\"ui-block-{$i[$key]}\">{$item['data']}</div>";
      }
    }
    $return .= "</fieldset>";
    return $return;
    //return theme('item_list', $items, NULL, 'ul', array('class' => 'mini-pager'));
  }
}
function creporter_mobile_removetab($label, &$vars) {
  $tabs = explode("\n", $vars['tabs']);
  $vars['tabs'] = '';

  foreach ($tabs as $tab) {
    if (strpos($tab, '>' . $label . '<') === FALSE) {
      $vars['tabs'] .= $tab . "\n";
    }
  }
}
function creporter_mobile_item_list($items = array(), $title = NULL, $type = 'ul', $attributes = NULL) {
  $output = '';
  if (isset($title)) {
    $output .= '<h3>'. $title .'</h3>';
  }
  if (!empty($items)) {
    $output .= "<$type". drupal_attributes($attributes) .'>';
    $num_items = count($items);
    foreach ($items as $i => $item) {
      $attributes = array();
      $children = array();
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        $data .= theme_item_list($children, NULL, $type, $attributes); // Render nested list
      }
      if ($i == 0) {
        $attributes['class'] = empty($attributes['class']) ? 'first' : ($attributes['class'] .' first');
      }
      if ($i == $num_items - 1) {
        $attributes['class'] = empty($attributes['class']) ? 'last' : ($attributes['class'] .' last');
      }
      $output .= '<li'. drupal_attributes($attributes) .'>'. $data ."</li>\n";
    }
    $output .= "</$type>";
  }
  return $output;
}
function creporter_mobile_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t(); 
  $output = '';
  $required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }
  $output .= " $value\n";

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">'. $element['#description'] ."</div>\n";
  }
  switch ($element['#type']) {
    case 'textarea':
    case 'textfield':
    case 'select':
      $output = '<div data-role="fieldcontain">' . $output . '</div>';
      break;
    case 'imagefield_widget':
      $id = $element['#id'];
      $output = '<div id="' . $id . '" data-role="fieldcontain">' . $output . '</div>';
      break;
  }
  return $output;
}
function creporter_mobile_imagefield_widget($element) {
  drupal_add_css(drupal_get_path('module', 'imagefield') .'/imagefield.css');
  $element['#id'] .= '-upload'; // Link the label to the upload field.
  return theme('form_element', $element, $element['#children']);
} 

function creporter_mobile_checkbox($element) {
  $checkbox = '<input ';
  $checkbox .= 'type="checkbox" ';
  $checkbox .= 'name="'. $element['#name'] .'" ';
  $checkbox .= 'id="'. $element['#id'] .'" ' ;
  $checkbox .= 'value="'. $element['#return_value'] .'" ';
  $checkbox .= $element['#value'] ? ' checked="checked" ' : ' ';
  $checkbox .= drupal_attributes($element['#attributes']) .' />';
/*
  if (!is_null($element['#title'])) {
    $checkbox = $checkbox . "\n" .'<label class="option" for="'. $element['#id'] .'">'. $element['#title'] .'</label>';
  }

  unset($element['#title']);
*/
  return theme('form_element', $element, $checkbox);
}


function creporter_mobile_checkboxes($element) {
  $element['#children'] = !empty($element['#children']) ? $element['#children'] : '';
  
  if ($element['#title'] || $element['#description']) {
    unset($element['#id']);
    return '<div data-role="fieldcontain"><fieldset data-role="controlgroup">' . theme('form_element', $element, $element['#children']) . '</fieldset></div>';
  }
  else {
    return '<div data-role="fieldcontain"><fieldset data-role="controlgroup">' . $element['#children'] . '</fieldset></div>';
  }
}
function phptemplate_menu_local_task($link, $active = FALSE) {
  return '<li data-icon="' . theme_get_setting('menu_item_icon') . '">'. $link ."</li>\n";
}
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= "<div data-role=\"navbar\"><ul>\n". $primary ."</ul></div>\n";
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= "<div data-role=\"navbar\"><ul>\n". $secondary ."</ul></div>\n";
  }

  return $output;
}
function phptemplate_menu_links_allow(&$link) {
  global $user;
  $uid  = $user->uid;
  switch($link['link_title']) {
    default;
      break;
  }
}
function phptemplate_menu_item_link($link) {
  global $user;
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  // Change Animation
  $link['localized_options']['attributes']['data-transition'] = 'slidedown';
  if($link['link_title'] == 'Add Content' || $link['link_title'] == 'Your Account') {
    //$link['localized_options']['attributes']['rel'] = 'external';
  }
  phptemplate_menu_links_allow($link);
  
  return l($link['title'], $link['href'], $link['localized_options']);
}
function phptemplate_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  return '<li class="'. $class .'" data-icon="' . theme_get_setting('menu_item_icon') . '">'. $link . $menu ."</li>\n";
}
