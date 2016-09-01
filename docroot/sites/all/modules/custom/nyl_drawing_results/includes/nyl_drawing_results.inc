<?php


/**
 * @file
 * Demonstrations of AJAX with graceful degradation.
 */

define('NYL_DRAWING_RESULTS_SAVED_LIMIT', 5); // TODO ask user what should be the limit.
/**
 * @defgroup ajax_degradation_example Example: AJAX Graceful Degradation
 * @ingroup examples
 * @{
 * These examples show AJAX with graceful degradation when Javascript is not
 * available.
 *
 * In each of these the key idea is that the form is rebuilt different ways
 * depending on form input. In order to accomplish that, the formbuilder
 * function is in charge of almost all logic.
 */


/**
 * Form with 'add more' and 'remove' buttons.
 *
 * This example shows a button to "add more" - add another textfield, and
 * the corresponding "remove" button.
 *
 * It works equivalently with javascript or not, and does the same basic steps
 * either way.
 *
 * The $no_js_use argument is simply for demonstration: When set, it prevents
 * '#ajax' from being set, thus making the example behave as if javascript
 * were disabled in the browser.
 */
function nyl_drawing_results_form($form, &$form_state)
{
  // NY Lottery Draw Game.
  $node = menu_get_object();
  if(empty($node) || ! isset($node->field_draw_game_id)) {
    watchdog('debug', 'Missing Draw Game Id.');
    return;
  }

  $gameId = (int) $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];  // a required field.
  $count = $node->field_draw_pick_count[LANGUAGE_NONE][0]['value'];
  $min = $node->field_draw_pick_min[LANGUAGE_NONE][0]['value'];
  $max = $node->field_draw_pick_max[LANGUAGE_NONE][0]['value'];
  $options = isset($node->field_draw_game_options[LANGUAGE_NONE]) ? array_column($node->field_draw_game_options[LANGUAGE_NONE], 'value') : array();

  $form['#tree'] = TRUE;
  $form['key'] = array(
    '#type' => 'value',
    '#value' => $node->nid, // Used by "Previously Checked" block [DRUPAL_CACHE_PER_PAGE],
  );
  $form['description'] = array(
    '#markup' => '<div>' . t('Check My Numbers') . '</div>',
  );
  $form['start_date'] = array(
    '#type' => 'date_popup',
    '#date_format' => "m/d/Y",
    '#title' => t('Start date'),
    // '#date_label_position' => 'within',
    '#date_year_range' => '-9:now',
    '#date_label_position' => 'invisible',
  );
  $form['end_date'] = array(
    '#type' => 'date_popup',
    '#date_format' => "m/d/Y",
    '#title' => t('End date'),
    // '#date_label_position' => 'within',
    '#date_year_range' => '-9:now',
    '#date_label_position' => 'invisible',
  );

  $form['my_numbers'] = array(
    '#type' => 'fieldset',
    // '#title' => t('Check My Numbers'),
    // Set up the wrapper so that AJAX will be able to replace the fieldset.
    '#prefix' => '<div id="my-numbers-fieldset-wrapper">',
    '#suffix' => '</div>',
  );
  for ($j = 0; $j < $count; $j++) {
    // D7 Elements contrib module for HTML5.
    $form['my_numbers']['number_' . $j] = array(
      '#type' => 'numberfield',
      '#min' => $min,
      '#max' => $max,
      '#required' => TRUE,
      '#attributes' => array(
        'class' => array('number'),
        'style' => 'width: 5em; float: left;', // TODO move to CSS
      ),
      '#default_value' => isset($form_state['values']) ? $form_state['values']['my_numbers']['number_' . $j] : '',
    );
  }
  // Not all games have a bonus that you can choose (Lotto has a bonus that you don't choose).
  if (!empty ($node->field_draw_bonus_max[LANGUAGE_NONE])) {
    $bonus_max = $node->field_draw_bonus_max[LANGUAGE_NONE][0]['value'];
    $form['bonus'] = array(
      '#type' => 'numberfield',
      '#prefix' => ' + ',
      '#min' => $min,
      '#max' => $bonus_max,
      '#required' => TRUE,
      '#attributes' => array(
        'class' => array('bonus'),
        'style' => 'width: 5em; float: left;', // TODO move to CSS
      ),
    );
  }

  $form['save'] = array(
    '#value' => t("Save Number"),
    '#type' => 'submit',
    '#ajax' => array(
      'callback' => 'nyl_drawing_results_save_callback', // ajax_example_advanced_commands_after_callback',
    ),
    '#suffix' => "<div id='nyl_drawing_results_status'></div>",
  );


  // Attach code to the form.
  $module_path = drupal_get_path('module', 'nyl_drawing_results');
  $form['#attached']['css'] = array(
    $module_path . '/css/nyl_drawing_results.css' => array('scope' => 'footer',),
  );
  drupal_add_js($module_path . '/js/nyl_drawing_results.js');

  // JS to highlight selected numbers, depend on the game.
  if ($gameId == LOTTO) {
    drupal_add_js($module_path. '/js/nyl_drawing_results_lotto.js');
  }
  elseif ($gameId == MEGA) {
    drupal_add_js($module_path . '/js/nyl_drawing_results_mega.js');
  }
  elseif ($gameId == WIN || $gameId == NUMBERS) {
    // add wager type: straight, box, straight/ box, combination, or close enough
    $types = array(
      'str' => t('Straight'),
      'box' => t('Box'),
      'str_box' => t('Straight/Box'),
      'comb' => t('Combination'),
      'close_enough' => t('Close Enough')
    );
    $form['wagerType'] = array(
      '#type' => 'radios',
      '#title' => t('Wager Type'),
      '#options' => $types,
    );
    $form['order_matters'] = array('#type' => 'value', '#value' => true);
    drupal_add_js($module_path . '/js/nyl_drawing_results_wager.js');
  }
//  elseif (in_array('order_matters', $options)) {
//    $form['order_matters'] = array('#type' => 'value', '#value' => true);
//    drupal_add_js($module_path . '/js/nyl_drawing_results_permutation.js');
//  }
  else {
    drupal_add_js($module_path. '/js/nyl_drawing_results_combination.js');
  }


  // Display table for results.
  // $table = _nyl_drawing_results_makeTable($node, $start_date , $end_date); // TODO
  $table = _nyl_drawing_results_makeTable($node);
  $form['table'] = array(
    '#theme' => 'table',
    '#header' => $table['header'],
    '#rows' => $table['rows'],
  );

  $form['#after_build'][] = 'nyl_drawing_results_after_build';
  return $form;
}


/**
 * An #after_build function to set the values prepopulated in the request.
 * to process REQUEST.
 */
function nyl_drawing_results_after_build($form, &$form_state) {
  if (isset($_REQUEST['myNumbers'])) {
    $ticket =  _nyl_drawing_results_parseTicket($_REQUEST['myNumbers']);
    foreach ($ticket['numbers'] as  $j => $number) {
      $form['my_numbers']['number_' . $j]['#value'] = (int)$number;
    }
    if (!empty($ticket['bonus'])) {
      $form['bonus']['#value'] = (int)$ticket['bonus'];
    }
  }
  //  if (isset($_REQUEST['start_date'])) {
  //    $form['start_date']['#default_value'] = '05/16/2016'; // $_REQUEST['start_date'];
  //  }
  //  if (isset($_REQUEST['end_date'])) {
  //    $form['end_date']['#default_value'] = '06/16/2016'; // $_REQUEST['end_date'];
  //  }

  return $form;
}

/**
 * @param $ticket
 * @return array
 */
function _nyl_drawing_results_parseTicket($ticket) {
  $split = preg_split("/[\s\+]/", $ticket);
  return array(
    'numbers' => explode('-', $split[0]),
    'bonus' => isset($split[1]) ? $split[1] : NULL,
  );
}

/**
 * @param $node
 * @return array
 */
function _nyl_drawing_results_makeTable ($node) {
  $gameId = (int) $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];  // a required field.
  $freq = empty($node->field_draw_game_freq[LANGUAGE_NONE]) ? 0 : $node->field_draw_game_freq[LANGUAGE_NONE][0]['value'];
  $result = _nyl_draw_getGameDraws($gameId);

  $columns = array(
    'resultDate' => t('Date (Payout Info)'),
    'drawNumber' => ($freq > 2) ? t('Draw Number') : FALSE,
    'drawPeriod' => ($freq == 2) ? t('Draw Period') : FALSE,
    'results' => t('Winning Numbers Drawn'),
    'specialResult' => empty($node->field_draw_bonus_name[LANGUAGE_NONE]) ? FALSE : $node->field_draw_bonus_name[LANGUAGE_NONE][0]['value'],
  );
  $columns = array_filter($columns);
  $fields = array_keys($columns);
  $header = array_values($columns);

  // TODO test its status before removing.
  if (!isset($result['draws'])) {
    $result['draws'] = array();
  }

  array_shift($result['draws']); // remove next.

  $rows = array();
  foreach ($result['draws'] as $draw) {
    foreach ($fields as $field) {
      $data[$field] = array(
        'data' => $draw->$field,
        'class' => $field
      );
    }
    // format date field.
    $timestamp = $data['resultDate']['data']/1000;
    $data['resultDate']['data'] = format_date($timestamp, 'long');
    $data['resultDate']['class'] .= ' '. format_date($timestamp, 'custom', 'm-d-Y');

    $numbers = explode('-', $data['results']['data']);
    $spans = '';
    foreach ($numbers as $index => $value) {
      $spans .=  " <span class='number number_{$index}'>". (int) $value ."</span> ";
    }
    $data['results']['data'] = $spans;

    // Compute Lucky Sum
    if (isset($columns['specialResult']) && $columns['specialResult'] == 'Lucky Sum') {
      $data['specialResult']['data'] = array_sum($numbers);
    }
    if (isset($data['drawPeriod']['data'])) {
      $data['drawPeriod']['data'] = ($data['drawPeriod']['data'] == 2) ? t('Evening') : t('Midday');
    }

    // Row with attributes on the row and some of its cells.
    $rows[] = array(
      'data' => $data,
      'class' => array($draw->drawNumber),
    );
  }
  return array('header' => $header, 'rows' => $rows);
}
/**
 * Callback for ajax-enabled buttons, to replace/update the Previously Checked list
 * see ajax_example_advanced.inc
 *
 *
 */
function nyl_drawing_results_save_callback($form, &$form_state) {
  $nid =  $form_state['values']['key'];
  $tickets = empty($_COOKIE['Drupal_visitor_myNumbers'.$nid]) ? array() : json_decode($_COOKIE['Drupal_visitor_myNumbers'.$nid]);

  $my_numbers = array_values($form_state['values']['my_numbers']);
  if (! isset($form_state['values']['order_matters'])) {
    sort($my_numbers); // not 'Numbers','Win4'
  }
  $ticket = implode('-', $my_numbers); // todo add bonus ball

  if (isset($form_state['values']['bonus'])) {
    $ticket .= '+'. $form_state['values']['bonus'];
  }

  // add ticket to top os the list and remove duplicates and limit size.
  array_unshift($tickets, $ticket);
  $tickets = array_slice(array_unique($tickets), 0, NYL_DRAWING_RESULTS_SAVED_LIMIT); // Cookies had a finite size

  user_cookie_save(array('myNumbers'.$nid => json_encode($tickets)));

  $notes = nyl_drawing_results_getNotes($tickets);

  $previous = theme('nyl_drawing_results_previously_checked', array('tickets' => $tickets, 'path' => 'node/'.$nid, 'notes' => $notes));
  $status = 'Updated previously checked '. date('r');

  $commands = array();
  $commands[] = ajax_command_replace("#nyl_drawing_results_previous", "<div id='nyl_drawing_results_previous'>". render($previous) ."</div>" . 'updated '. date('r') );
  // $commands[] = ajax_command_replace("#nyl_drawing_results_previous", "<div id='nyl_drawing_results_previous'>?</div>" . 'updated '. date('r') );
  $commands[] = ajax_command_replace("#nyl_drawing_results_status", "<div id='nyl_drawing_results_status'>". $status . "</div>");
  return array('#type' => 'ajax', '#commands' => $commands);
}

/**
 * Return notes associated with numbers.
 * @param $tickets
 * @return array
 */
function nyl_drawing_results_getNotes($tickets) {
  // TODO : implement notes (ex. 'This is a winner in 1984')
  return array('0' => t('new'));
}
