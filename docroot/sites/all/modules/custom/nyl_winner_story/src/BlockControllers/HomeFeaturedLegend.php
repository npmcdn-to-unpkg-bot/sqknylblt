<?php

namespace Drupal\cool_examples\Controllers\BlockControllers;

class HomeFeaturedLegend extends \Drupal\cool\BaseBlock {

  public static function getId() {
    return 'nyl_ws_featured_legend_home';
  }

  public static function getAdminTitle($delta = '') {
    return t('NYL - Home - Winner Story - Featured Legend');
  }

  static public function getDefinition($delta = '') {
    return [
      'cache' => DRUPAL_CACHE_GLOBAL
    ];
  }

  public static function getContent($delta = '') {
    $vars = \Drupal\nyl_core\LegendController::getHomepageFeatured();
    return theme('nyl_winner_story_home', $vars);
  }
}
