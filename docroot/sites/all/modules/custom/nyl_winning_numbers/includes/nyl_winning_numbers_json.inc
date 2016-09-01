<?php

define ('NYL_WINNING_NUMBERS_CACHE_BIN', 'cache_nyl_winning_numbers');

function nyl_winning_numbers_getOverlay_json($refresh = FALSE) {
  drupal_page_is_cacheable(false);
  $cid = NYL_DRAW_CACHE_ID.':nyl_winning_numbers_overlay';
  $expire = time() + NYL_DRAW_CACHE_EXPIRE_MAX;
  if ($refresh) {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
    cache_clear_all($cid, NYL_WINNING_NUMBERS_CACHE_BIN);
  }
  else {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
    // cache_get($cid, $bin = 'cache')
    $cache = cache_get($cid, NYL_WINNING_NUMBERS_CACHE_BIN);
    if (isset($cache->data)) {
      return $cache->data;
    }
  }
  // We don't care about the order/rank.
  $nodes = node_load_multiple(array(), array('type' => 'draw_game', 'status' => 1));
  $cacheIt = TRUE;
  foreach ($nodes as $node) {
    $name = strtolower(str_replace(' ', '', $node->title));
    $gameId = (int)$node->field_draw_game_id[LANGUAGE_NONE][0]['value'];  // a required field.
    $result = _nyl_draw_getGameDraws($gameId, $refresh);
    if (!isset($result['draws'])) {
      // No JSON entry, so info-container is not replaced and do not cache.
      watchdog('debug', '$result["draws"] missing.');
      $cacheIt = FALSE;
      continue;
    }

    if ($expire > $result['expire']) {
      $expire = $result['expire'];
    }

    $draws = in_array($name, array('win4', 'numbers')) ? array_slice($result['draws'], 0, 3) :  array_slice($result['draws'], 0, 2);
    $results[$name.'-sm'] = theme("nyl_winning_numbers_{$name}_draw", array('node' => $node, 'size' => 'sm', 'draws' => $draws));
    $results[$name.'-lg'] = theme("nyl_winning_numbers_{$name}_draw", array('node' => $node, 'size' => 'lg', 'draws' => $draws));

    // TODO remove field_draw_game_freq from Draw Game content type... [WC : Aug.23]
  }

  if ($cacheIt) {
    cache_set($cid, $results, NYL_WINNING_NUMBERS_CACHE_BIN, $expire);
    watchdog('debug', "Cached %c until %d {$expire}", array(
      '%c' => $cid,
      '%d' => date('m/d/Y h:i:s e', $expire),
    ));
  }
  return $results;

}
