<?php
/**
 * @file
 * nyl_draw.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function nyl_draw_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_image_default_styles().
 */
function nyl_draw_image_default_styles() {
  $styles = array();

  // Exported image style: game_logo.
  $styles['game_logo'] = array(
    'label' => 'Game Logo',
    'effects' => array(
      1 => array(
        'name' => 'image_scale',
        'data' => array(
          'width' => 130,
          'height' => 60,
          'upscale' => 0,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function nyl_draw_node_info() {
  $items = array(
    'draw_game' => array(
      'name' => t('Draw Game'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
