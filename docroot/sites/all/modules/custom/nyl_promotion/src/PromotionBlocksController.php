<?php

namespace Drupal\nyl_promotion;

class PromotionBlocksController {

  static function getAvailablePromotionBlocks() {
    $blocks = [
      'home' => t('Homepage'),
      'ways_to_play' => t('Ways to Play'),
      'game_details' => t('Game Details'),
    ];
    return $blocks;
  }

  static function getPromotionsEachBlock() {
    $promos = [
      'promo1' => t('Promotion 1'),
      'promo2' => t('Promotion 2'),
    ];
    return $promos;
  }

}
