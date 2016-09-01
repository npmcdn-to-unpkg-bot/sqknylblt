<?php

namespace Drupal\nyl_promotion\PageControllers;

class PromotionBlocksSettings implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'admin/config/nyl/promotion-blocks-settings';
  }

  public static function accessCallback() {
    return user_access('administer nodes');
  }

  public static function getDefinition() {
    return [
      'title' => t('NYL Promotion Blocks Settings'),
      'description' => t('Management options for Promotion Blocks available at Homepage, Ways To Play and Game Details.'),
      'type' => MENU_NORMAL_ITEM,
    ];
  }

  public static function pageCallback() {
    return \Drupal\nyl_promotion\FormControllers\PromotionBlocksSettings::getForm();
  }
}
