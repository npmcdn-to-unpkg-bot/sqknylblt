<?php

namespace Drupal\cool_examples\Controllers\BlockControllers;

class PromotionGameDetails extends \Drupal\cool\BaseBlock {

  public static function getId() {
    return 'nyl_promotion_game_details';
  }

  public static function getAdminTitle($delta = '') {
    return t('NYL - Promotion Block - Game Details');
  }

  static public function getDefinition($delta = '') {
    return [
      'cache' => DRUPAL_CACHE_GLOBAL
    ];
  }

  public static function getContent($delta = '') {
    return theme('nyl_promotion_block', \Drupal\nyl_core\PromotionController::getBlockPromotionByBlock('game_details'));
  }
}
