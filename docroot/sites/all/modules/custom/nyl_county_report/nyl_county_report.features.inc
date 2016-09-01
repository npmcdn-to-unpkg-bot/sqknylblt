<?php
/**
 * @file
 * nyl_county_report.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function nyl_county_report_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "feeds" && $api == "feeds_importer_default") {
    return array("version" => "1");
  }
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function nyl_county_report_node_info() {
  $items = array(
    'nyl_county_report' => array(
      'name' => t('County Report'),
      'base' => 'node_content',
      'description' => t('Benefitting New Yorker Report county-by-county breakdown.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
