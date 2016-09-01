<?php
/**
 * @file
 * nyl_winner_story.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function nyl_winner_story_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function nyl_winner_story_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function nyl_winner_story_node_info() {
  $items = array(
    'winner_story' => array(
      'name' => t('Winner Story'),
      'base' => 'node_content',
      'description' => t('Winner articles'),
      'has_title' => '1',
      'title_label' => t('Winner Name'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
