<?php
/**
 * @file
 * Contains nyl_draw_json.inc.
 */


define('PROGRESSIVE_JACKPOT', 'jackpot_notifications');
define('NYL_DRAW_CACHE_ID', 'draws_games');
define('NYL_DRAW_CACHE_EXPIRE_MAX', 60*60); // 1 hr
// TODO Update MAX to 12 hours.
///**
// *
// * retrieve data from memcache or
// * make an API Call and determine expiration data and cache.
// *
// * @param bool $refresh
// * @return mixed
// */
//function nyl_draw_getGames($refresh = FALSE) {
//  if ($refresh) {
//    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
//    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
//    cache_clear_all(NYL_DRAW_GAMES_CID, 'nyl_draw');
//  }
//  else {
//    dsm('nyl_draw_getGames : Memcache '.$cid);
//    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
//    // cache_get($cid, $bin = 'cache')
//    $cache = cache_get(NYL_DRAW_GAMES_CID, 'nyl_draw');
//    dsm($cache);
//    if (isset($cache->data)) {
//      return $cache->data;
//    }
//  }
//
//  $games = nyl_api_getGames(GAME_TYPE_DRAW);
//
//  if (!empty($games)) {
//    // Expire at earliest next_draw
//    $now = time() * 1000;
//    $expire = $now + (NYL_DRAW_GAMES_EXPIRE_MAX * 1000);
//    foreach ($games as $game) {
//      if ($game->next_draw < $expire && $game->next_draw > $now && $game->name != 'Quick Draw') {
//        $expire = $game->next_draw;
//      }
//    }
//    watchdog("debug", "Cached Draw until %d {$expire}", array('%d' => date('m/d/Y h:i:s e', $expire/1000) ));
//    // https://api.drupal.org/api/drupal/includes!cache.inc/function/cache_set/7.x
//    // cache_set($cid, $cache, $bin = 'cache', $expire = CACHE_PERMANENT)
//    cache_set(NYL_DRAW_GAMES_CID, $games, 'nyl_draw'); // , $expire/1000);
//  }
//  return $games;
//}

//
///**
// * Retrieve all current Draw games from memcache,
// * update if any expired by calling get NYL_API functions.
// */
//function _nyl_draw_getGamesCurrentDraw($gameId, $refresh = FALSE) {
//  global $token;
//  $cid = NYL_DRAW_CACHE_ID.':'.$gameId.':current';
//  if ($refresh) {
//    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
//    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
//    cache_clear_all($cid, 'cache_nyl_draw');
//  }
//  else {
//    dsm('nyl_draw_getGamesCurrentDraw : Memcache '.$cid);
//    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
//    // cache_get($cid, $bin = 'cache')
//    $cache = cache_get($cid, 'cache_nyl_draw');
//    dsm($cache);
//    if (isset($cache->data)) {
//      return array('draw' => $cache->data, 'expire' => $cache->expire);
//    }
//  }
//
//  $draw = nyl_api_getGameDrawsCurrent($gameId, $token);
//  if (!empty($draw)) {
//    $now = time();
//    $expire = $draw->resultDate/1000;
//    if ($now > $expire) {
//      // already expired.
//      $expire = $now + (int) variable_get('nyl_api_cache_expire_min', NYL_API_CACHE_EXPIRE_MIN);
//    }
//    else if ($expire > ($now + NYL_DRAW_CACHE_EXPIRE_MAX)) {
//      // more than max expiration.
//      $expire = $now + NYL_DRAW_CACHE_EXPIRE_MAX;
//    }
//    // https://api.drupal.org/api/drupal/includes!cache.inc/function/cache_set/7.x
//    // cache_set($cid, $data, $bin = 'cache', $expire = CACHE_PERMANENT)
//    cache_set($cid, $draw, 'cache_nyl_draw', $expire);
//    dsm( t("Cached %c until %d {$expire}", array(
//      '%c' => $cid,
//      '%d' => date('m/d/Y h:i:s e', $expire),
//    )));
//    watchdog("debug", "Cached %c until %d {$expire}", array(
//      '%c' => $cid,
//      '%d' => date('m/d/Y h:i:s e', $expire),
//    ));
//  }
//  return array('draw' => $draw, 'expire' => $expire);
//}

/**
 * @param $gameId
 * @param $expire
 * @param bool $refresh
 * @return array
 */
function _nyl_draw_getGameDraws($gameId, $refresh = FALSE) {
  global $token;
  $expire = '';
  $cid = NYL_DRAW_CACHE_ID.':'.$gameId.':draws';
  if ($refresh) {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
    cache_clear_all($cid, 'cache_nyl_draw');
  }
  else {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
    // cache_get($cid, $bin = 'cache')
    $cache = cache_get($cid, 'cache_nyl_draw');
    if (isset($cache->data)) {
      return array('draws' => $cache->data, 'expire' => $cache->expire);
    }
  }

  $draws = nyl_api_getGameDraws($gameId, array(), $token);
  if (!empty($draws)) {
    $now = time();
    // expires after next drawing.
    $expire = $draws[0]->resultDate/1000;
    if ($now > $expire) {
      // already expired.
      $expire = $now + (int) variable_get('nyl_api_cache_expire_min', NYL_API_CACHE_EXPIRE_MIN);
    }
    else if ($expire > ($now + NYL_DRAW_CACHE_EXPIRE_MAX)) {
      // more than max expiration.
      $expire = $now + NYL_DRAW_CACHE_EXPIRE_MAX;
    }

    // https://api.drupal.org/api/drupal/includes!cache.inc/function/cache_set/7.x
    // cache_set($cid, $data, $bin = 'cache', $expire = CACHE_PERMANENT)
    cache_set($cid, $draws, 'cache_nyl_draw', $expire);
    watchdog("debug", "Cached %c until %d {$expire}", array(
      '%c' => $cid,
      '%d' => date('m/d/Y h:i:s e', $expire),
    ));
  }
  return array('draws' => $draws, 'expire' => $expire);
}



function nyl_draw_getGameDraws_json($gameId, $refresh = FALSE) {
  // $gameId = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
  $result = _nyl_draw_getGameDraws($gameId, $refresh);
  // nice_date_format($node->field_draw_game_freq[LANGUAGE_NONE])
  // nice_number($next->jackpot);
  return $result['draws'];
}

/**
 * @param bool $refresh
 * @return mixed
 */
function nyl_draw_getWaysToPlay_json($refresh = FALSE) {
  drupal_page_is_cacheable(false);
  $cid = NYL_DRAW_CACHE_ID.':WaysToPlay';
  $expire = time() + NYL_DRAW_CACHE_EXPIRE_MAX;
  if ($refresh) {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
    cache_clear_all($cid, 'cache_nyl_draw');
  }
  else {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
    // cache_get($cid, $bin = 'cache')
    $cache = cache_get($cid, 'cache_nyl_draw');
    if (isset($cache->data)) {
      return $cache->data;
    }
  }
  // Load all nyl_draw nodes that are published.
  $nodes = node_load_multiple(array(), array('type' => 'draw_game', 'status' => 1));
  foreach ($nodes as $nid=>$node) {
    $gameId = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];  // a required field.
    if ($gameId == QUICK)
      continue;

    // $result = _nyl_draw_getGamesCurrentDraw($gameId, $refresh);
    $result = _nyl_draw_getGameDraws($gameId, $refresh);
    $next = current($result['draws']);

    if ($expire > $result['expire']) {
      $expire = $result['expire'];
    }
    // $results[$gameId] = array('node' => $node, 'next' => $result['draw']); // theme this.
    $results[$gameId] =  theme('nyl_draw_WaysToPlay', array('node' => $node, 'next' => $next));
  }
  cache_set($cid, $results, 'cache_nyl_draw', $expire);
  watchdog('debug', "Cached %c until %d {$expire}", array(
    '%c' => $cid,
    '%d' => date('m/d/Y h:i:s e', $expire),
  ));

  return $results;
}

//
//
//function nyl_draw_getSuperNav_json($refresh = FALSE) {
//  drupal_page_is_cacheable(false);
//  $cid = NYL_DRAW_CACHE_ID.':SuperNav';
//  $expire = time() + NYL_DRAW_CACHE_EXPIRE_MAX;
//  if ($refresh) {
//    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
//    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
//    cache_clear_all($cid, 'cache_nyl_draw');
//  }
//  else {
//    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
//    // cache_get($cid, $bin = 'cache')
//    $cache = cache_get($cid, 'cache_nyl_draw');
//    if (isset($cache->data)) {
//      return $cache->data;
//    }
//  }
//  // Load all nyl_draw nodes that are published.
//  $nodes = node_load_multiple(array(), array('type' => 'draw_game', 'status' => 1));
//  foreach ($nodes as $nid => $node) {
//    $gameId = (int) $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];  // a required field.
//    $freq = $node->field_draw_game_freq[LANGUAGE_NONE][0]['value'];
//    if ($freq > 2) continue; // skip Quick Pick (every 4 minutes)
//
//    $result = _nyl_draw_getGameDraws($gameId, $refresh);
//
//    $next = current($result['draws']);
//    $past = array_slice($result['draws'], 1, ($freq == 2 ? 2 : 1));  // If draw is twice a day, then get two.
//
//    $theme = nice_date_format($node->field_draw_game_freq) . '_nav';
//
//    $results[$gameId] =  theme($theme, array('node' => $node, 'next' => $next, 'past' => $past));
//
//    if ($expire > $result['expire']) {
//      $expire = $result['expire'];
//    }
//  }
//  cache_set($cid, $results, 'cache_nyl_draw', $expire);
//  watchdog('debug', "Cached %c until %d {$expire}", array(
//    '%c' => $cid,
//    '%d' => date('m/d/Y h:i:s e', $expire),
//  ));
//  return $results;
//}
