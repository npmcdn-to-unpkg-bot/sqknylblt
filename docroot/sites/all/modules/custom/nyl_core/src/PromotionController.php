<?php

namespace Drupal\nyl_core;

class PromotionController {

  static function getHomepageFeatured() {
    $theme_path = base_path() . drupal_get_path('theme', 'nylottery');
    $query_replace = array(':status' => '1', ':type' => 'promotion');
    $promo_nids = db_query("SELECT nid FROM node WHERE status = :status AND type = :type " . " ORDER BY changed DESC LIMIT 0,2", $query_replace)->fetchCol();
    $nodes = node_load_multiple($promo_nids);
    $items = [];
    foreach ($nodes as $nid => $node) {
      // TODO get game node title from field_game
      $game_title = db_query("SELECT title FROM node WHERE nid = :nid ", array(':nid' => $node->field_game[LANGUAGE_NONE][0]['target_id']))->fetchCol()[0];
      $items[] = array(
        'title' => $node->title,
        'promo_subtitle' => $node->field_subtitle[LANGUAGE_NONE][0]['safe_value'],
        'promo_cta' => $node->field_cta_text[LANGUAGE_NONE][0]['safe_value'],
        'promo_logo' => file_create_url(GAME_IMAGE_DIRECTORY .'/'. str_replace(' ', '_', $game_title)) . '.png',
      );
    }
    return $items;
  }

  static function getPublishedPromotions() {
    $query_replace = array(':status' => '1', ':type' => 'promotion');
    $promo_nids = db_query("SELECT nid FROM node WHERE status = :status AND type = :type " . " ORDER BY changed DESC", $query_replace)->fetchCol();
    $nodes = node_load_multiple($promo_nids);
    $items = [];
    foreach ($nodes as $nid => $node) {
//      $game_title = db_query("SELECT title FROM node WHERE nid = :nid ", array(':nid' => $node->field_game[LANGUAGE_NONE][0]['target_id']))->fetchCol()[0];
      $game = node_load($node->field_game[LANGUAGE_NONE][0]['target_id']);
      $items[] = array(
        'promo_id' => $node->nid,
        'title' => $node->title,
        'promo_subtitle' => $node->field_subtitle[LANGUAGE_NONE][0]['safe_value'],
        'promo_cta' => $node->field_cta_text[LANGUAGE_NONE][0]['safe_value'],
        'promo_logo' => GAME_IMAGE_DIRECTORY .'/'. str_replace(' ', '_', $game->title) . '.png',
        'promo_cta_link' => url('node/' . $game->nid)
      );
    }
    return $items;
  }

  /*
   * $block_name: see \Drupal\nyl_promotion\PromotionBlocksController::getPromotionsEachBlock()
   */
  static function getBlockPromotionByBlock($block_name = NULL) {
    if (!is_null($block_name)) {
      $promos = [
        'promo1' => variable_get('nyl_promotion_'.$block_name.'_promo1_nid', ''),
        'promo2' => variable_get('nyl_promotion_'.$block_name.'_promo2_nid', ''),
      ];

      $variables = [];
      $variables['title'] = variable_get('nyl_promotion_home_title', '');
      $variables['cta_text'] = variable_get('nyl_promotion_home_cta_text', '');
      $variables['cta_link'] = url(variable_get('nyl_promotion_home_cta_link', ''));

      foreach ($promos as $promo_machine => $promo_nid) {
        $node = node_load($promo_nid);
        $game = node_load($node->field_game[LANGUAGE_NONE][0]['target_id']);

        $variables[$promo_machine . '_title'] = $node->title;
        $variables[$promo_machine . '_description'] = $node->field_subtitle[LANGUAGE_NONE][0]['safe_value'];
        $variables[$promo_machine . '_cta_text'] = $node->field_cta_text[LANGUAGE_NONE][0]['safe_value'];
        $variables[$promo_machine . '_cta_link'] = url('node/' . $game->nid);
        $img_uri = GAME_IMAGE_DIRECTORY .'/'. str_replace(' ', '_', $game->title) . '.png';
        $variables[$promo_machine .'_img_url'] = file_create_url($img_uri);
      }
      return $variables;
    }
    return FALSE;
  }
}
