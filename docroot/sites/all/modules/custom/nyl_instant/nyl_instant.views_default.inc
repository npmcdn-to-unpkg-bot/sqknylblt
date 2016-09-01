<?php
/**
 * @file
 * nyl_instant.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function nyl_instant_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'instant_games';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Instant Games';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Instant Games';
  $handler->display->display_options['use_ajax'] = TRUE;
  $handler->display->display_options['use_more'] = TRUE;
  $handler->display->display_options['use_more_always'] = TRUE;
  $handler->display->display_options['use_more_text'] = 'Load More';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'better_exposed_filters';
  $handler->display->display_options['exposed_form']['options']['reset_button'] = TRUE;
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'All Prices';
  $handler->display->display_options['exposed_form']['options']['autosubmit'] = TRUE;
  $handler->display->display_options['exposed_form']['options']['bef'] = array(
    'general' => array(
      'allow_secondary' => 0,
      'secondary_label' => 'Advanced options',
      'collapsible_label' => NULL,
      'combine_rewrite' => NULL,
      'reset_label' => NULL,
      'bef_filter_description' => NULL,
      'any_label' => NULL,
      'filter_rewrite_values' => NULL,
    ),
    'field_instant_game_price_value' => array(
      'bef_format' => 'bef',
      'more_options' => array(
        'bef_select_all_none' => 0,
        'bef_collapsible' => 0,
        'is_secondary' => 0,
        'any_label' => 'All Prices',
        'bef_filter_description' => '',
        'tokens' => array(
          'available' => array(
            0 => 'global_types',
            'secondary_label' => NULL,
            'collapsible_label' => NULL,
            'combine_rewrite' => NULL,
            'reset_label' => NULL,
            'bef_filter_description' => NULL,
            'any_label' => NULL,
            'filter_rewrite_values' => NULL,
          ),
          'secondary_label' => NULL,
          'collapsible_label' => NULL,
          'combine_rewrite' => NULL,
          'reset_label' => NULL,
          'bef_filter_description' => NULL,
          'any_label' => NULL,
          'filter_rewrite_values' => NULL,
        ),
        'rewrite' => array(
          'filter_rewrite_values' => '',
          'secondary_label' => NULL,
          'collapsible_label' => NULL,
          'combine_rewrite' => NULL,
          'reset_label' => NULL,
          'bef_filter_description' => NULL,
          'any_label' => NULL,
        ),
        'secondary_label' => NULL,
        'collapsible_label' => NULL,
        'combine_rewrite' => NULL,
        'reset_label' => NULL,
        'filter_rewrite_values' => NULL,
      ),
      'secondary_label' => NULL,
      'collapsible_label' => NULL,
      'combine_rewrite' => NULL,
      'reset_label' => NULL,
      'bef_filter_description' => NULL,
      'any_label' => NULL,
      'filter_rewrite_values' => NULL,
    ),
    'secondary_label' => NULL,
    'collapsible_label' => NULL,
    'combine_rewrite' => NULL,
    'reset_label' => NULL,
    'bef_filter_description' => NULL,
    'any_label' => NULL,
    'filter_rewrite_values' => NULL,
  );
  $handler->display->display_options['exposed_form']['options']['input_required'] = 0;
  $handler->display->display_options['exposed_form']['options']['text_input_required_format'] = 'filtered_html';
  $handler->display->display_options['pager']['type'] = 'mini';
  $handler->display->display_options['pager']['options']['items_per_page'] = '8';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['style_plugin'] = 'grid';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Relationship: Entity Reference: Referencing entity */
  $handler->display->display_options['relationships']['reverse_field_instant_game_ref_node']['id'] = 'reverse_field_instant_game_ref_node';
  $handler->display->display_options['relationships']['reverse_field_instant_game_ref_node']['table'] = 'node';
  $handler->display->display_options['relationships']['reverse_field_instant_game_ref_node']['field'] = 'reverse_field_instant_game_ref_node';
  $handler->display->display_options['relationships']['reverse_field_instant_game_ref_node']['required'] = TRUE;
  /* Field: Content: Price */
  $handler->display->display_options['fields']['field_instant_game_price']['id'] = 'field_instant_game_price';
  $handler->display->display_options['fields']['field_instant_game_price']['table'] = 'field_data_field_instant_game_price';
  $handler->display->display_options['fields']['field_instant_game_price']['field'] = 'field_instant_game_price';
  $handler->display->display_options['fields']['field_instant_game_price']['label'] = '';
  $handler->display->display_options['fields']['field_instant_game_price']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_instant_game_price']['type'] = 'list_default';
  /* Field: Content: Logo */
  $handler->display->display_options['fields']['field_instant_game_logo']['id'] = 'field_instant_game_logo';
  $handler->display->display_options['fields']['field_instant_game_logo']['table'] = 'field_data_field_instant_game_logo';
  $handler->display->display_options['fields']['field_instant_game_logo']['field'] = 'field_instant_game_logo';
  $handler->display->display_options['fields']['field_instant_game_logo']['label'] = '';
  $handler->display->display_options['fields']['field_instant_game_logo']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_instant_game_logo']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_instant_game_logo']['settings'] = array(
    'image_style' => 'game_logo',
    'image_link' => 'content',
  );
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Categories */
  $handler->display->display_options['fields']['field_instant_game_categories']['id'] = 'field_instant_game_categories';
  $handler->display->display_options['fields']['field_instant_game_categories']['table'] = 'field_data_field_instant_game_categories';
  $handler->display->display_options['fields']['field_instant_game_categories']['field'] = 'field_instant_game_categories';
  $handler->display->display_options['fields']['field_instant_game_categories']['label'] = '';
  $handler->display->display_options['fields']['field_instant_game_categories']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_instant_game_categories']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_instant_game_categories']['delta_offset'] = '0';
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Contextual filter: Content: Categories (field_instant_game_categories) */
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['id'] = 'field_instant_game_categories_tid';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['table'] = 'field_data_field_instant_game_categories';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['field'] = 'field_instant_game_categories_tid';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['default_argument_type'] = 'taxonomy_tid';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['validate_options']['vocabularies'] = array(
    'instant_game_categories' => 'instant_game_categories',
  );
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['validate_options']['type'] = 'convert';
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['validate_options']['transform'] = TRUE;
  $handler->display->display_options['arguments']['field_instant_game_categories_tid']['validate']['fail'] = 'ignore';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'instant_game' => 'instant_game',
  );
  /* Filter criterion: Content: Price (field_instant_game_price) */
  $handler->display->display_options['filters']['field_instant_game_price_value']['id'] = 'field_instant_game_price_value';
  $handler->display->display_options['filters']['field_instant_game_price_value']['table'] = 'field_data_field_instant_game_price';
  $handler->display->display_options['filters']['field_instant_game_price_value']['field'] = 'field_instant_game_price_value';
  $handler->display->display_options['filters']['field_instant_game_price_value']['operator'] = 'or';
  $handler->display->display_options['filters']['field_instant_game_price_value']['exposed'] = TRUE;
  $handler->display->display_options['filters']['field_instant_game_price_value']['expose']['operator_id'] = 'field_instant_game_price_value_op';
  $handler->display->display_options['filters']['field_instant_game_price_value']['expose']['label'] = 'Price';
  $handler->display->display_options['filters']['field_instant_game_price_value']['expose']['operator'] = 'field_instant_game_price_value_op';
  $handler->display->display_options['filters']['field_instant_game_price_value']['expose']['identifier'] = 'field_instant_game_price_value';
  $handler->display->display_options['filters']['field_instant_game_price_value']['expose']['multiple'] = TRUE;
  $handler->display->display_options['filters']['field_instant_game_price_value']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    11 => 0,
    21 => 0,
    16 => 0,
  );
  /* Filter criterion: Field: Cash Deadline (field_instant_game_deadline) */
  $handler->display->display_options['filters']['field_instant_game_deadline_value']['id'] = 'field_instant_game_deadline_value';
  $handler->display->display_options['filters']['field_instant_game_deadline_value']['table'] = 'field_data_field_instant_game_deadline';
  $handler->display->display_options['filters']['field_instant_game_deadline_value']['field'] = 'field_instant_game_deadline_value';
  $handler->display->display_options['filters']['field_instant_game_deadline_value']['relationship'] = 'reverse_field_instant_game_ref_node';
  $handler->display->display_options['filters']['field_instant_game_deadline_value']['operator'] = 'empty';

  /* Display: Block */
  $handler = $view->new_display('block', 'Block', 'block');
  $handler->display->display_options['block_caching'] = '8';
  $export['instant_games'] = $view;

  return $export;
}
