<?php
/**
 * @file
 * nyl_promotion.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function nyl_promotion_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function nyl_promotion_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function nyl_promotion_node_info() {
  $items = array(
    'promotion' => array(
      'name' => t('Promotion'),
      'base' => 'node_content',
      'description' => t('Promotion content type'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
