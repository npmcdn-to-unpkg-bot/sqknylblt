<?php

namespace Drupal\cool_examples\Controllers\BlockControllers;

class PromotionHome extends \Drupal\cool\BaseBlock {

  public static function getId() {
    return 'nyl_promotion_home';
  }

  public static function getAdminTitle($delta = '') {
    return t('NYL - Promotion Block - Home');
  }

  static public function getDefinition($delta = '') {
    return [
      'cache' => DRUPAL_CACHE_GLOBAL
    ];
  }

  public static function getContent($delta = '') {
    return theme('nyl_promotion_block', \Drupal\nyl_core\PromotionController::getBlockPromotionByBlock('home'));
  }
}
