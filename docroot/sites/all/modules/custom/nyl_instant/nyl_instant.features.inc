<?php
/**
 * @file
 * nyl_instant.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function nyl_instant_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function nyl_instant_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function nyl_instant_node_info() {
  $items = array(
    'instant_game' => array(
      'name' => t('Instant Game'),
      'base' => 'node_content',
      'description' => t('Instant/Scratch Game Content Type'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
