<?php

namespace Drupal\cool_examples\Controllers\BlockControllers;

class PromotionWaysToPlay extends \Drupal\cool\BaseBlock {

  public static function getId() {
    return 'nyl_promotion_ways_to_play';
  }

  public static function getAdminTitle($delta = '') {
    return t('NYL - Promotion Block - Ways To Play');
  }

  static public function getDefinition($delta = '') {
    return [
      'cache' => DRUPAL_CACHE_GLOBAL
    ];
  }

  public static function getContent($delta = '') {
    return theme('nyl_promotion_block', \Drupal\nyl_core\PromotionController::getBlockPromotionByBlock('ways_to_play'));
  }
}
