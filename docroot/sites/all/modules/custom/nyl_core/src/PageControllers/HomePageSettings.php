<?php

namespace Drupal\nyl_core\PageControllers;

class HomePageSettings implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'admin/config/nyl/homepage';
  }

  public static function accessCallback() {
    return user_access('administer nodes');
  }

  public static function getDefinition() {
    return [
      'title' => t('NYL Home Page Settings'),
      'description' => t('Management options for Homepage.'),
      'type' => MENU_NORMAL_ITEM,
    ];
  }

  public static function pageCallback() {
    return \Drupal\nyl_core\FormControllers\HomePageSettings::getForm();
  }
}
