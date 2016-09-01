<?php
/**
 * @file
 * Contains nyl_api_vendor.inc
 *
 * VENDORS API  The Vendors API features endpoints related to the searching and references of specific vendors  for NYL games.
ACCESS
All endpoints of the Vendors API are readOonly.  Users should not be permitted to modify any  aspect of the vendor records.
DEFINITIONS
Endpoint
Methods

/vendor/{id}
GET
Obtains a single Vendor object matching the provided ID.
 */

CONST VENDOR_API_MAX_DISTANCE = 2147483647 ;
CONST VENDOR_API_MAX_SIZE = 2000 ;




/*
Description
/vendors
GET
Returns an array of Vendor objects matching search criteria provided in the query string of the request.
Criteria
near: A geospatial coordinate pair passed as x,y
Ex: api.sample.com/v1/vendors?near=-39.1000,21.1000 games: A comma-separated list of game IDs the vendor sells
Ex: api.sample.com/v1/vendors?games=1,5,9,8 categories: A comma separated list of category IDs to limit the vendors to
Ex: api.sample.com/v1/vendors?categories=9,15,25,2

"statusCode": 400,
"errorCode": 40001,
"Required String parameter 'near, games, distance' is not present",
*/

function nyl_api_getVendors($query = array(), &$token = NULL) {
  if (empty($token)) {
    $token = nyl_api_getAccessToken();
  }
  $server_url = variable_get('nyl_api_server_url');
  $url = url($server_url . '/vendors', array('query' => $query));
  $options = array (
    'headers' => array(
      'Authorization' => "Bearer {$token}",
      'Accept' => 'application/json',
      'Content-Type' => 'application/json',
    ),
  );

  $response = drupal_http_request($url, $options);
  if ($response->code == 200) {
    $data = json_decode($response->data);
    return $data->data;
    return property_exists($data, 'data') ? $data->data : $data;  // isset() with null
  }
  elseif ($response->code  == 401) {
    $token = NULL; // get new AccessToken;
    return nyl_api_getVendors($query, $token);
  }
  else {
    drupal_set_message($response->data, 'error');
  }
}
//
///*
// * /vendor/{id}
// * GET
// * Obtains a single Vendor object matching the provided ID.
// */
//function nyl_api_getVendor($id, &$token = NULL) {
//  if (empty($token)) {
//    $token = nyl_api_getAccessToken();
//  }
//  $url = variable_get('nyl_api_server_url', 'https://staging.nylgames.mrmdigital.com/nyl/v1') . '/vendor/'.$id;
//  $options = array (
//    'headers' => array(
//      'Authorization' => "Bearer {$token}",
//      'Accept' => 'application/json',
//      'Content-Type' => 'application/json',
//    ),
//  );
//
//  $response = drupal_http_request($url, $options);
//  return $response;
//
//  if ($response->code = 200) {
//    // double wrapped data
//    return $response->data;
//  }
//  elseif ($response->code  == 401) {
//    $token = NULL; // get new AccessToken;
//    return nyl_api_getVendors($token);
//  }
//  else {
//    drupal_set_message($response->data, 'error');
//  }
//}

/** http://nylottery.local/devel/php
 *
$param = array(
'near' => '40.7527277,-74.0089612',
);
$response = nyl_api_getVendors($param);
dsm($response);
 * dsm($response);
 *
 */