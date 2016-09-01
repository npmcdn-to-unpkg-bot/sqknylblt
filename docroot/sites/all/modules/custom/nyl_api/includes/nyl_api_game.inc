<?php
/**
 * @file
 * Contains nyl_api_game.inc
 */

const LOTTO = 8;
const NUMBERS = 9;
const TAKE5 = 10;
const MEGA = 12;
const CASH = 13;
const WIN = 14;
const POWER = 15;
const QUICK = 22;
const PICK = 27;

const GAME_TYPE_UNKNOWN = 0 ; // A generic game type for a game record that  does not fit into an other category
const GAME_TYPE_DRAW = 1; // A game that is draw based at certain intervals
const GAME_TYPE_INSTANT = 2 ; // A game that players can win instantly based  on scratching off a film on the ticket
const GAME_TYPE_SPECIAL = 3 ; // A game that is of a special type

CONST GAME_DETAIL_TYPE_SHORT_DESCRIPTION = 0 ; // A short description about a particular game,  used when space is limited
CONST GAME_DETAIL_TYPE_LONG_DESCRIPTION = 1; // A longer, fullOtext description of a particular  game used on expanded detail views
CONST GAME_DETAIL_TYPE_DISCLAIMER = 2; // Legal Text used to express any disclaimers or  other legal statements
CONST GAME_DETAIL_TYPE_WAYS_TO_WIN = 3; // A textual description of the possible ways to  win
CONST GAME_DETAIL_TYPE_ODDS = 4; // A textual description of the odds of winning a  particular game

CONST GAME_IMAGE_DIRECTORY = "public://image/game";

/**
Fetch All Games /w Descriptors & Recent Draws
Value	Notes
Endpoint	/games
Method	HTTP GET
Auth Type	Bearer / OAuth 2.0
Credential Type	Access Token	Access Token from TC01_5 OR TC04_1
Param Format	Query String
Params
 * 	  - descriptors	String; Value: "all"
 *    - draws	Integer; Value: 3
Response Format	JSON
Response Data	%ARRAY%	Array of multiple game objects
^ - Game Object
^ -- name	String; Name of Game
^ -- type	Integer; Type Identifier for Game
^ -- entitlements	Array of Strings; Entitlements/Permissions for a Game Object
^ -- rank	Integer; Display Order of Game
^ -- game_id	String; Unique Identifier for Game
^ -- short_name	String; Short Name of Game, used for some internal references
^ -- start_date	Double; Unix Timestamp of when game became available
^ -- end_date	Double; Unix Timestamp of when game will become unavailable
^ -- next_draw	Double; Unix Timestamp of next drawing
^ -- last_draw	Double; Unix Timestamp of last completed drawing
^ -- descriptors	Array of Dictionaries; Descriptor Objects
^ -- draws	Array of Dictionaries; Draw Objects
 */
function nyl_api_getDrawEntitlementOptions() {
  return array(
    "bonus_ball",
    "draw_significant",
    "draw_notifications",
    "generate_duplicates",
    "jackpot_notifications",
    "live_draw",
    "number_generator",
    "simple_numbers",
    "sum_ball",
  );
}

/**
 * Lists all available lottery games.
 * or Lists all available lottery games of a provided Type, an integer matching a GameType constant.
 *
 * @param $type
 * @param null $token
 * @return mixed
 */
function nyl_api_getGames($type, &$token = NULL) {
  if (empty($token)) {
    $token = nyl_api_getAccessToken();
  }
  $url = variable_get('nyl_api_server_url') . '/games';
  if (is_integer($type)) {
    $url .= "/{$type}";
  }
  $options = array (
    'headers' => array('Authorization' => "Bearer {$token}"),
    // 'data' =>  "descriptors={$descriptors}&draws={$draws}", // A string containing the request body, formatted as 'param=value&param=value&...'. Defaults to NULL.
  );

  $response =  drupal_http_request($url, $options);
  if ($response->code == 200) {
    // double wrapped data
    return json_decode($response->data)->data;
  }
  elseif ($response->code  == 401) {
    $token = NULL; // get new AccessToken;
    return nyl_api_getGames($type);
  }
}


function nyl_api_getGame($game_id, &$token = NULL, $field = NULL, $query = array()) {
  if (empty($token)) {
    $token = nyl_api_getAccessToken();
  }
  $path = variable_get('nyl_api_server_url') . "/game/". (int)$game_id;
  if (!empty($field)) {
    $path .= "/{$field}";
  }
  $url = url($path, array('query' => $query));

  $options = array (
    'headers' => array('Authorization' => "Bearer {$token}"),
  );
  $response =  drupal_http_request($url, $options);
  if ($response->code == 200) {
    // double wrapped data
    $data = json_decode($response->data);
    return $data->data;
  }
  elseif ($response->code  == 401) {
    $token = NULL; // get new AccessToken;
    return nyl_api_getGames($game_id, $field, $token);
  }
  else {
    // 404 : Not Found
    drupal_set_message(json_encode($response), 'error');
  }
}

/**
 * Obtains a High Resolution PNG image of the game’s logo
 */
function nyl_api_getGameLogo($game_id, $name="temp.png", &$token = NULL) {

  if (empty($token)) {
    $token = nyl_api_getAccessToken();
  }
  $url = variable_get('nyl_api_server_url') . "/game/{$game_id}/logo";
  $options = array (
    'headers' => array('Authorization' => "Bearer {$token}"),
  );
  $response =  drupal_http_request($url, $options);
  $data = $response->data;

  // save binary data to permanent file.
  $directory = GAME_IMAGE_DIRECTORY;
  $filename =  GAME_IMAGE_DIRECTORY."/{$name}";
  file_prepare_directory($directory, FILE_CREATE_DIRECTORY  | FILE_MODIFY_PERMISSIONS);
  file_save_data($data, $filename, FILE_EXISTS_REPLACE);
  return $filename;
}

/**
 * Obtains all specific details such as descriptions, ways to win, legal text, and rules for a specific game matching a provided ID
 */
function nyl_api_getGameDetails($game_id, &$token = NULL) {
  return nyl_api_getGame($game_id, $token, 'details');
}

/**
 * Obtains a specific detail record that matches as provided ID
 */
function nyl_api_getGameDetail($game_id, $detail_id, &$token = NULL) {
  return nyl_api_getGame($game_id, $token, "detail/{$detail_id}");
}

/**
 * Obtains a list of GameDraw objects for a specified timeframe for a specific game with ID.
 */
function nyl_api_getGameDraws($game_id, $query = array(), &$token = NULL) {
  return nyl_api_getGame($game_id, $token, 'draws', $query);
}

/**
 * Obtains a specific GameDraw record matching a provided ID.
 * -- DO NOT CONFUSE: $draw->id and $draw->drawNumber
 */
function nyl_api_getGameDraw($game_id, $draw_id, &$token = NULL) {
  return nyl_api_getGame($game_id, $token, 'draw/'. (int)$draw_id);
}

/**
 * Obtains the GameDraw record for the most recent completed draw.
 */
function nyl_api_getGameDrawsLast($game_id, &$token = NULL) {
  return nyl_api_getGame($game_id, $token, 'draws/last');
}

/**
 * Obtains the GameDraw record for the next/upcoming draw.
 */
function nyl_api_getGameDrawsCurrent($game_id, &$token = NULL) {
  return nyl_api_getGame($game_id, $token, 'draws/current');
}


/*****
 * $token = nyl_api_getAccessToken();
$response = nyl_api_getGameDetail('9', 1, $token);
$response = nyl_api_getGameDetail('9', 2, $token);
$response = nyl_api_getGameDetail('9', 3, $token);
$response = nyl_api_getGameDetail('9', 4, $token);
$response = nyl_api_getGameDetail('9', 5, $token);
$response = nyl_api_getGameDetail('9', 6, $token);
 */