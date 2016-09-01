<?php
/**
 * @file
 * nyl_core.features.menu_custom.inc
 */

/**
 * Implements hook_menu_default_menu_custom().
 */
function nyl_core_menu_default_menu_custom() {
  $menus = array();

  // Exported menu: menu-footer.
  $menus['menu-footer'] = array(
    'menu_name' => 'menu-footer',
    'title' => 'Footer',
    'description' => 'NYLottery Footer Menu (in yellow)',
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Footer');
  t('NYLottery Footer Menu (in yellow)');

  return $menus;
}
