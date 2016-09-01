<?php
/**
 * @file
 * Contains nyl_vendors.inc
 */

define('NYL_VENDOR_CACHE_ID', 'nyl_vendors');
define('GMAP_API_KEY', 'AIzaSyCrqN8RsgYGe611Uc9EIvGG66AaxJ9ZiF4');
define ('NYL_EVENT_NEARBY_DISTANCE_UNIT', 'miles');
define ('NYL_EVENT_NEARBY_DISTANCE', '100');

/**
 * @param $form
 * @param $form_state
 * @param null $zipCode
 * @return mixed
 * @throws \Exception
 */
function nyl_vendors_form($form, &$form_state, $zipCode = NULL, $filter = NULL) {

  if (empty($zipCode)) {
    dsm('Localhost : default to NYC');
    $zipCode = 10036; // default to Times Square
  }
  $location = nyl_vendors_zipCode_load($zipCode);
  $events = module_exists('nyl_events') ? nyl_events_list($location) : array();
  $vendors = nyl_vendors_list($location);

  // FILTER results.
  switch (strtolower($filter)) {
    case 'draw':
      $vendors = array_filter($vendors, function($v) { return $v->type == GAME_TYPE_DRAW; });
      break;
    case 'instant':
      $vendors = array_filter($vendors, function($v) { return $v->type == GAME_TYPE_INSTANT; });
      break;
    case 'special':
      $vendors = array_filter($vendors, function($v) { return $v->type == GAME_TYPE_SPECIAL; });
      break;
    case 'quick_draw':
      $vendors = array_filter($vendors, function($v) { return in_array(QUICK, $v->games); });
      break;
    case 'lucky_retailer':
      $vendors = array_filter($vendors, function($v) { return $v->hot; });
      break;
    // TODO Remove the following test cases
    case 'pharmacy':
      $vendors = array_filter($vendors, function($v) { return stripos($v->name, 'pharmacy'); });
      break;
    case 'grocery':
      $vendors = array_filter($vendors, function($v) { return stripos($v->name, 'grocery'); });
      break;
    case 'deli':
      $vendors = array_filter($vendors, function($v) { return stripos($v->name, 'deli'); });
      break;
  }


  $form['zipCode'] = array(
    '#title' => t('Zip Code'),
    '#type' => 'textfield',
    '#size' => 5,
    '#max' => 10,
    '#required' => TRUE,
    '#attributes' => array(
      'class' => array('foobar'),
      'style' => 'Search by zip code',
    ),
    '#default_value' => isset($location['zipCode']) ? $location['zipCode'] : '',
  );

  $form['search'] = array(
    '#value' => t("Search"),
    '#type' => 'submit',
//    '#ajax' => array(
//      'callback' => 'nyl_vendors_search_callback', // ajax_example_advanced_commands_after_callback',
//    ),
//    '#suffix' => "<div id='nyl_vendors_status'></div>",
  );
  $module_path = drupal_get_path('module', 'nyl_vendors');
  $form['#attached']['css'] = array(
     $module_path .'/css/nyl_vendors.css',
  );
//  $form['#attached']['js'][] = array(
//    // 'data' => 'https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.js',
//    'data' => 'https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js',
//    'type' => 'external',
//  );
//  $form['isotope'] = array(
//      '#markup' => <<<EOF
//  <div class="button-group filter-button-group">SEE RETAILERS :
//    <button data-filter="*">All</button>
//    &nbsp;
//    <button data-filter=".game-1">Draw</button>
//    <button data-filter=".game-2">Instant</button>
//    <button data-filter=".game-3">Special (QuickDraw?)</button>
//    &nbsp;
//    <button data-filter=".lucky-retailer">Lucky Retailer</button>
//  </div>
//EOF
//  );

  $nyl_vendors_gmap = theme('nyl_vendors_gmap', array('center' => $location, 'markers' => $vendors));
  $form['gmap'] = array(
    '#markup' => render($nyl_vendors_gmap),
  );

  if (module_exists('nyl_event')) {
    $events = nyl_event_nearby_bylocation($location, NYL_EVENT_NEARBY_DISTANCE, NYL_EVENT_NEARBY_DISTANCE_UNIT);
    $nyl_event_nearby = theme('nyl_event_nearby_block', array('center' => $location, 'markers' => $vendors, 'events' => $events));
    $form['events'] = array(
      '#markup' => render($nyl_event_nearby),
    );
  }

  $nyl_vendors_list = theme('nyl_vendors_list', array('vendors' => $vendors));
  $form['list'] = array(
    '#markup' => render($nyl_vendors_list),
  );

  return $form;
}

function nyl_vendors_form_submit($form, &$form_state) {
  $values =  $form_state['values'];

  $form_state['redirect'] = array('Lottery_Locator/'. (int)$values['zipCode']);
}

/**
 * @param $location
 * @param bool $refresh
 * @return array
 */
function nyl_vendors_list($location, $refresh=TRUE) {

  if (!isset($location['lat']) || !isset($location['lon'])) {
    return NULL;
  }
  // cache result by zipcode.
  $cid = NYL_VENDOR_CACHE_ID.':'.$location['zipCode'];

  if ($refresh) {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_clear_all/7.x
    // cache_clear_all($cid = NULL, $bin = NULL, $wildcard = FALSE)
    cache_clear_all($cid, 'cache_nyl_vendors');
  }
  else {
    // https://api.drupal.org/api/drupal/includes%21cache.inc/function/cache_get/7.x
    // cache_get($cid, $bin = 'cache')
    $cache = cache_get($cid, 'cache_nyl_vendors');
    if (isset($cache->data)) {
      return $cache->data;
    }
  }

  // Compute the values.
  $query = array();
  $query['near'] = $location['lat'].','. $location['lon'];
  $query['distance'] = 200; // VENDOR_API_MAX_DISTANCE, // = 2147483647
  $query['size'] = 1000; // VENDOR_API_MAX_SIZE, // 2000

  $response = nyl_api_getVendors($query);
  $vendors = $response->content;

  $expire = CACHE_PERMANENT;
  // https://api.drupal.org/api/drupal/includes!cache.inc/function/cache_set/7.x
  // cache_set($cid, $data, $bin = 'cache', $expire = CACHE_PERMANENT)
  cache_set($cid, $vendors, 'cache_nyl_vendors', $expire);
  watchdog("debug", "Cached %c until %d {$expire}", array(
    '%c' => $cid,
    '%d' => date('m/d/Y h:i:s e', $expire),
  ));
  return $vendors;
}
/*
 * {
 * "name":"OLD MINI MART INC             ",
 * "type":0,
 * "longitude":-73.9953,
 * "latitude":40.6324,
 * "streetAddress":"5402 NEW UTRECHT AVE          ",
 * "city":"BROOKLYN            ",
 * "state":"NY",
 * "zipCode":"11219",
 * "phoneNumber":null,
 * "category":0,
 * "hot":false,
 * "description":null,
 * "games":[],
 * "id":19888
 * },
 */
//function theme_vendor_list() {
//  $header = array("")
//  $per_page = 10;
//// Initialize the pager
//  $current_page = pager_default_initialize(count($rows), $per_page);
//// Split your list into page sized chunks
//  $chunks = array_chunk($rows, $per_page, TRUE);
//// Show the appropriate items from the list
//  $output = theme('table', array('header' => $header, 'rows' => $chunks[$current_page]));
//// Show the pager
//  $output .= theme('pager', array('quantity',count($rows)));
//  return $output;
//}
//