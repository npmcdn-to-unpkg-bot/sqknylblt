<?php

namespace Drupal\nyl_core\PageControllers;

class SiteSettings implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'admin/config/nyl/site-settings';
  }

  public static function accessCallback() {
    return user_access('administer nodes');
  }

  public static function getDefinition() {
    return [
      'title' => t('NYL Site Settings'),
      'description' => t('Management options for New York Lottery website.'),
      'type' => MENU_NORMAL_ITEM,
    ];
  }

  public static function pageCallback() {
    return \Drupal\nyl_core\FormControllers\SiteSettings::getForm();
  }
}
