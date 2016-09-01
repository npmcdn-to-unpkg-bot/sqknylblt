<?php

namespace Drupal\nyl_core\PageControllers;

class Homepage implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'homepage';
  }

  public static function accessCallback() {
    return TRUE;
  }

  public static function getDefinition() {
    return [];
  }

  public static function pageCallback() {
//    $vars = [];
//    $vars['user'] = $GLOBALS['user'];
//    return theme('nyl_core_homepage', $vars);
    return '';
  }
}