<?php

namespace Drupal\cool_examples\Controllers\BlockControllers;

class HomeMainSlider extends \Drupal\cool\BaseBlock {

  public static function getId() {
    return 'nyl_core_home_main_slider';
  }

  public static function getAdminTitle($delta = '') {
    return t('NYL - Home Main Slider');
  }

  static public function getDefinition($delta = '') {
    return [
      'cache' => DRUPAL_CACHE_GLOBAL
    ];
  }

  public static function getContent($delta = '') {
    $variables['theme_path'] = base_path() . drupal_get_path('theme', 'nylottery');
    $variables['featured_jackpots'] = \Drupal\nyl_core\JackpotController::getHomepageFeatured();
    return theme('nyl_core_home_main_slider', $variables);
  }
}
