<?php
/**
 * @file
 * nyl_county_report.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function nyl_county_report_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: navigation_county-report:node/add/nyl-county-report.
  $menu_links['navigation_county-report:node/add/nyl-county-report'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/nyl-county-report',
    'router_path' => 'node/add/nyl-county-report',
    'link_title' => 'County Report',
    'options' => array(
      'attributes' => array(
        'title' => 'Benefitting New Yorker Report county-by-county breakdown.',
      ),
      'identifier' => 'navigation_county-report:node/add/nyl-county-report',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('County Report');

  return $menu_links;
}
