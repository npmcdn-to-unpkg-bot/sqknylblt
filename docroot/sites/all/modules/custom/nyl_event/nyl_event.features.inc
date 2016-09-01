<?php
/**
 * @file
 * nyl_event.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function nyl_event_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function nyl_event_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function nyl_event_node_info() {
  $items = array(
    'nyl_event' => array(
      'name' => t('Event'),
      'base' => 'node_content',
      'description' => t('NY Lottery Events with general location and date/time range.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
