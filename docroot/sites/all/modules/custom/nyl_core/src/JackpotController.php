<?php

namespace Drupal\nyl_core;

class JackpotController {

  static function getHomepageFeatured() {
    $nid = variable_get('jackpot_slide_selected', NULL);
    $items = JackpotController::_getJackpotSlides($nid);
    return $items;
  }

  static function _getJackpotSlides($nid = NULL) {
    $jackpots_available = self::availableJackPotGamesHomeSlider();
    $gids = db_query("SELECT gid.field_draw_game_id_value, n.title, n.nid FROM field_data_field_draw_game_id gid INNER JOIN node n ON gid.entity_id = n.nid "
                    ." WHERE gid.field_draw_game_id_value IN (:progressive) AND n.status = 1", array(':progressive' => array_keys($jackpots_available)));

    $items = array();
    foreach ($gids as $data) {
      $game_detail = JackpotController::_getGameDetails($data);
      $min = variable_get('nyl_main_slider_min_jackpot_'. $data->field_draw_game_id_value, 0) * 1000000;
      if ($game_detail != FALSE && isset($game_detail['jackpot_amount']) && $game_detail['jackpot_amount'] >= $min) {
        $items[] = $game_detail;
      }
    }
    return $items;
  }

  static function _getGameDetails($data){
    global $token;
    if(isset($data->title)) {
      $game_id = $data->field_draw_game_id_value;
      // $game = cache_get("draws_games:$game_id:draws", 'cache_nyl_draw');
      $game = _nyl_draw_getGameDraws($game_id); // Do an API call if not in cache.
      if (!empty($game['draws'])) {
        $upcoming = current($game['draws']);
        // $upcoming->jackpot = 123456789;
        $jackpot = ($upcoming->jackpot == 0) ? '0 Million' : nice_number($upcoming->jackpot, 0);
        list($jackpot_amount, $jackpot_cardinal) = explode(' ', $jackpot);

        $theme_path = base_path() . drupal_get_path('theme', 'nylottery');
        $game_img = strtolower(str_replace(" ", "", $data->title));
        $item = array(
          'title' => 'Jackpot is now',
          'image_path' => $theme_path . '/assets/img/logo-' . $game_img . '.svg',
          'jackpot_amount' => $jackpot_amount,
          'cardinal' => $jackpot_cardinal,
          'jackpot_cta_link' => url('node/' . $data->nid)
        );
        return $item;
      }
    }
    return FALSE;
  }

  static function availableJackPotGamesHomeSlider(){
    //array keys are api game keys
    $games = ['8' => 'Lotto', '15' => 'Powerball', '12' => 'Mega Millions'];
    return $games;
  }

}
