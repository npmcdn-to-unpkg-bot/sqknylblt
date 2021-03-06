<?php
/**
 * @file
 * nyl_winner_story.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function nyl_winner_story_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'featured_legend';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Featured Legend';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Home Page Featured Legend';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '1';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_node'] = FALSE;
  /* Field: Content: Winner Image */
  $handler->display->display_options['fields']['field_winner_image']['id'] = 'field_winner_image';
  $handler->display->display_options['fields']['field_winner_image']['table'] = 'field_data_field_winner_image';
  $handler->display->display_options['fields']['field_winner_image']['field'] = 'field_winner_image';
  $handler->display->display_options['fields']['field_winner_image']['label'] = '';
  $handler->display->display_options['fields']['field_winner_image']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_winner_image']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_winner_image']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_winner_image']['settings'] = array(
    'image_style' => 'large',
    'image_link' => '',
  );
  $handler->display->display_options['fields']['field_winner_image']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_winner_image']['delta_offset'] = '0';
  /* Field: Content: Winning Amount */
  $handler->display->display_options['fields']['field_winning_amount']['id'] = 'field_winning_amount';
  $handler->display->display_options['fields']['field_winning_amount']['table'] = 'field_data_field_winning_amount';
  $handler->display->display_options['fields']['field_winning_amount']['field'] = 'field_winning_amount';
  $handler->display->display_options['fields']['field_winning_amount']['label'] = '';
  $handler->display->display_options['fields']['field_winning_amount']['element_label_colon'] = FALSE;
  /* Sort criterion: Content: Winning Date (field_winning_date) */
  $handler->display->display_options['sorts']['field_winning_date_value']['id'] = 'field_winning_date_value';
  $handler->display->display_options['sorts']['field_winning_date_value']['table'] = 'field_data_field_winning_date';
  $handler->display->display_options['sorts']['field_winning_date_value']['field'] = 'field_winning_date_value';
  $handler->display->display_options['sorts']['field_winning_date_value']['order'] = 'DESC';
  /* Sort criterion: Content: Updated date */
  $handler->display->display_options['sorts']['changed']['id'] = 'changed';
  $handler->display->display_options['sorts']['changed']['table'] = 'node';
  $handler->display->display_options['sorts']['changed']['field'] = 'changed';
  $handler->display->display_options['sorts']['changed']['order'] = 'DESC';
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
    'winner_story' => 'winner_story',
  );
  /* Filter criterion: Content: Promoted to front page */
  $handler->display->display_options['filters']['promote']['id'] = 'promote';
  $handler->display->display_options['filters']['promote']['table'] = 'node';
  $handler->display->display_options['filters']['promote']['field'] = 'promote';
  $handler->display->display_options['filters']['promote']['value'] = '1';
  $export['featured_legend'] = $view;

  return $export;
}
