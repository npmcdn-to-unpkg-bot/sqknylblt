<?php
/**
 * @file
 * Contains nyl_drawing_results_json.inc
 */
define('NYL_DRAWING_RESULTS_CACHE_ID', 'probability');
define('NYL_DRAWING_RESULTS_CACHE_EXPIRE_MAX', 60*60); // 1 hr
/**
 * @param $gameId
 * @param $expire
 * @param bool $refresh
 * @return array
 */
function nyl_drawing_results_getProbability_json($gameId, $relativeDateTime = "90", $refresh = FALSE) {
  $cid = NYL_DRAWING_RESULTS_CACHE_ID.':'.$gameId.':'. $relativeDateTime;
  if ($refresh) {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
    cache_clear_all($cid, 'cache_nyl_draw');
  }
  else {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
    // cache_get($cid, $bin = 'cache')
    $cache = cache_get($cid, 'cache_nyl_drawing_results');
    if (isset($cache->data)) {
      return array('data' => $cache->data, 'expire' => $cache->expire);
    }
  }
  // Compute the values.
  $prob_results = array();
  $prob_bonus = array();
  $from = new DateTime('-'.$relativeDateTime.' days'); // '-90 days' or
  $to = new DateTime();
  $options = array(
    'from' => $from->getTimestamp(),
    'to' => $to->getTimestamp(),
    'size' => 360, // Quick pick is every 4 minutes.
  );
  $draws = nyl_api_getGameDraws($gameId, $options);
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

    // TODO Check status. or 0-0-...0

    $numbers = array_map(function($draw) {
      $results = explode('-', $draw->results);
      return array_map('intval', $results); // Some results have leading zeros
    }, $draws);
    $merged = array_merge(...$numbers); // PHP5.6, we have the ... operator
    $prob_results = array_count_values($merged);
    // ksort($prob_results);
    arsort($prob_results); // sorts an associative array in descending order, according to the value .. hard in JS
    // Chrome and Opera sorting JSON objects by Index ASC, if index is numerical
    array_walk($prob_results, function(&$v, $i) {
      $v = array('ball' => $i, 'count' => $v);
    });
    $prob_results = array_values($prob_results);

    // The bonus ball have a different range.
    $bonus = array_map(function($draw) {
      return (int)$draw->specialResult; // Some results have leading zeros
    }, $draws);
    $prob_bonus = array_count_values($bonus);
    // ksort($prob_bonus);
    arsort($prob_bonus); // hard to do this in JS
    array_walk($prob_bonus, function(&$v, $i) {
      $v =  array('ball' => $i, 'count' => $v);
    });
    $prob_bonus = array_values($prob_bonus);

    // https://api.drupal.org/api/drupal/includes!cache.inc/function/cache_set/7.x
    // cache_set($cid, $data, $bin = 'cache', $expire = CACHE_PERMANENT)
    cache_set($cid, array('results' => $prob_results, 'specialResult' => $prob_bonus), 'cache_nyl_drawing_results', $expire);
    watchdog("debug", "Cached %c until %d {$expire}", array(
      '%c' => $cid,
      '%d' => date('m/d/Y h:i:s e', $expire),
    ));
  }
  return array('data' => array('results' => $prob_results, 'specialResult' => $prob_bonus), 'expire' => $expire);
}


function nyl_drawing_results_probability_form($form, &$form_state, $node) {
  // $node = menu_get_object();
  $gameId = (int) $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];  // a required field.
  $freq = empty($node->field_draw_game_freq[LANGUAGE_NONE]) ? 0 : $node->field_draw_game_freq[LANGUAGE_NONE][0]['value'];
  switch ($freq) {
    case 0: // twice a week.
    case 1: // once a day
      $options = array(
        '30' => 'Last 30 days',
        '60' => 'Last 60 days',
        '90' => 'Last 90 days',
        '120' =>'Last 120 days',
      );
      $default = 90;
      break;

    case 2: // twice a day.
      $options = array(
        '30' => 'Last 30 days',
        '60' => 'Last 60 days',
        '90' => 'Last 90 days',
      );
      $default = 90;
      break;
    default: // Quickdraw.
      $options = array(
        '1' => 'Last day',
        '2' => 'Last 2 days',
        '3' => 'Last 3 days',
        '75' => 'Last 75 days',
      );
      $default = 75;
      break;
  }

  $module_path = drupal_get_path('module', 'nyl_drawing_results');
  $form['#attached']['js'] = array(
    $module_path . '/js/nyl_drawing_probability.js' => array('scope' => 'footer',),
  );

  $form['gameId'] = array(
    '#type' => 'hidden',
    '#value' => $gameId
  );
  $form['days'] = array(
    '#type' => 'select',
    '#default_value' => $default,
    '#options' => $options,
    '#description' => t('Global setting for the length of XML feed items that are output by default.'),
  );
  return $form;
}
// TODO validate JSON request (limit days)... after NYLAPI Data refresh,