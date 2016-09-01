<?php
/**
 * @file
 * nyl_event.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function nyl_event_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'nyl_events';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'NYLottery Events';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Events';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['link_display'] = 'custom_url';
  $handler->display->display_options['group_by'] = TRUE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['query']['options']['distinct'] = TRUE;
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['expose_sort_order'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'node';
  /* Field: Content: Logo */
  $handler->display->display_options['fields']['field_event_logo']['id'] = 'field_event_logo';
  $handler->display->display_options['fields']['field_event_logo']['table'] = 'field_data_field_event_logo';
  $handler->display->display_options['fields']['field_event_logo']['field'] = 'field_event_logo';
  $handler->display->display_options['fields']['field_event_logo']['label'] = '';
  $handler->display->display_options['fields']['field_event_logo']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_logo']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_event_logo']['settings'] = array(
    'image_style' => 'thumbnail',
    'image_link' => 'content',
  );
  $handler->display->display_options['fields']['field_event_logo']['group_column'] = 'entity_id';
  /* Field: Content: Event Tags */
  $handler->display->display_options['fields']['field_event_tags']['id'] = 'field_event_tags';
  $handler->display->display_options['fields']['field_event_tags']['table'] = 'field_data_field_event_tags';
  $handler->display->display_options['fields']['field_event_tags']['field'] = 'field_event_tags';
  $handler->display->display_options['fields']['field_event_tags']['label'] = '';
  $handler->display->display_options['fields']['field_event_tags']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_event_tags']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_tags']['delta_offset'] = '0';
  /* Field: Content: Regions */
  $handler->display->display_options['fields']['field_event_regions']['id'] = 'field_event_regions';
  $handler->display->display_options['fields']['field_event_regions']['table'] = 'field_data_field_event_regions';
  $handler->display->display_options['fields']['field_event_regions']['field'] = 'field_event_regions';
  $handler->display->display_options['fields']['field_event_regions']['label'] = '';
  $handler->display->display_options['fields']['field_event_regions']['alter']['make_link'] = TRUE;
  $handler->display->display_options['fields']['field_event_regions']['alter']['path'] = 'events/[field_event_regions]';
  $handler->display->display_options['fields']['field_event_regions']['alter']['replace_spaces'] = TRUE;
  $handler->display->display_options['fields']['field_event_regions']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_regions']['type'] = 'taxonomy_term_reference_plain';
  $handler->display->display_options['fields']['field_event_regions']['delta_offset'] = '0';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Date */
  $handler->display->display_options['fields']['field_event_date']['id'] = 'field_event_date';
  $handler->display->display_options['fields']['field_event_date']['table'] = 'field_data_field_event_date';
  $handler->display->display_options['fields']['field_event_date']['field'] = 'field_event_date';
  $handler->display->display_options['fields']['field_event_date']['label'] = '';
  $handler->display->display_options['fields']['field_event_date']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_date']['settings'] = array(
    'format_type' => 'long',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
    'show_remaining_days' => 0,
    'show_repeat_rule' => 'hide',
  );
  $handler->display->display_options['fields']['field_event_date']['delta_offset'] = '0';
  /* Field: Content: Location */
  $handler->display->display_options['fields']['field_event_location']['id'] = 'field_event_location';
  $handler->display->display_options['fields']['field_event_location']['table'] = 'field_data_field_event_location';
  $handler->display->display_options['fields']['field_event_location']['field'] = 'field_event_location';
  $handler->display->display_options['fields']['field_event_location']['label'] = '';
  $handler->display->display_options['fields']['field_event_location']['element_label_colon'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['body']['type'] = 'text_summary_or_trimmed';
  $handler->display->display_options['fields']['body']['settings'] = array(
    'trim_length' => '600',
  );
  /* Sort criterion: Content: Date -  start date (field_event_date) */
  $handler->display->display_options['sorts']['field_event_date_value']['id'] = 'field_event_date_value';
  $handler->display->display_options['sorts']['field_event_date_value']['table'] = 'field_data_field_event_date';
  $handler->display->display_options['sorts']['field_event_date_value']['field'] = 'field_event_date_value';
  $handler->display->display_options['sorts']['field_event_date_value']['order'] = 'DESC';
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Contextual filter: Content: Regions (field_event_regions) */
  $handler->display->display_options['arguments']['field_event_regions_tid']['id'] = 'field_event_regions_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['table'] = 'field_data_field_event_regions';
  $handler->display->display_options['arguments']['field_event_regions_tid']['field'] = 'field_event_regions_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['field_event_regions_tid']['exception']['title_enable'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['exception']['title'] = '';
  $handler->display->display_options['arguments']['field_event_regions_tid']['title_enable'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['title'] = '%1 Events';
  $handler->display->display_options['arguments']['field_event_regions_tid']['default_argument_type'] = 'taxonomy_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['field_event_regions_tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['vocabularies'] = array(
    'ny_regions' => 'ny_regions',
  );
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['type'] = 'convert';
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['transform'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate']['fail'] = 'empty';
  /* Contextual filter: Content: Event Tags (field_event_tags) */
  $handler->display->display_options['arguments']['field_event_tags_tid']['id'] = 'field_event_tags_tid';
  $handler->display->display_options['arguments']['field_event_tags_tid']['table'] = 'field_data_field_event_tags';
  $handler->display->display_options['arguments']['field_event_tags_tid']['field'] = 'field_event_tags_tid';
  $handler->display->display_options['arguments']['field_event_tags_tid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['field_event_tags_tid']['title_enable'] = TRUE;
  $handler->display->display_options['arguments']['field_event_tags_tid']['title'] = '%1 %2 Events';
  $handler->display->display_options['arguments']['field_event_tags_tid']['default_argument_type'] = 'taxonomy_tid';
  $handler->display->display_options['arguments']['field_event_tags_tid']['default_argument_options']['term_page'] = FALSE;
  $handler->display->display_options['arguments']['field_event_tags_tid']['default_argument_options']['node'] = TRUE;
  $handler->display->display_options['arguments']['field_event_tags_tid']['default_argument_options']['limit'] = TRUE;
  $handler->display->display_options['arguments']['field_event_tags_tid']['default_argument_options']['vocabularies'] = array(
    'nyl_event_tag' => 'nyl_event_tag',
  );
  $handler->display->display_options['arguments']['field_event_tags_tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_event_tags_tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_event_tags_tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['field_event_tags_tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['field_event_tags_tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['field_event_tags_tid']['validate_options']['vocabularies'] = array(
    'nyl_event_tag' => 'nyl_event_tag',
  );
  $handler->display->display_options['arguments']['field_event_tags_tid']['validate_options']['type'] = 'convert';
  $handler->display->display_options['arguments']['field_event_tags_tid']['validate_options']['transform'] = TRUE;
  $handler->display->display_options['arguments']['field_event_tags_tid']['validate']['fail'] = 'ignore';
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
    'nyl_event' => 'nyl_event',
  );
  /* Filter criterion: Content: Date - end date (field_event_date:value2) */
  $handler->display->display_options['filters']['field_event_date_value2']['id'] = 'field_event_date_value2';
  $handler->display->display_options['filters']['field_event_date_value2']['table'] = 'field_data_field_event_date';
  $handler->display->display_options['filters']['field_event_date_value2']['field'] = 'field_event_date_value2';
  $handler->display->display_options['filters']['field_event_date_value2']['operator'] = '>=';
  $handler->display->display_options['filters']['field_event_date_value2']['granularity'] = 'hour';
  $handler->display->display_options['filters']['field_event_date_value2']['default_date'] = 'Yesterday';
  $handler->display->display_options['filters']['field_event_date_value2']['add_delta'] = 'yes';

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['path'] = 'events';

  /* Display: Block */
  $handler = $view->new_display('block', 'Block', 'block');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Upcoming Events';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'fields';
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Date Desc */
  $handler->display->display_options['fields']['field_eveny_date_desc']['id'] = 'field_eveny_date_desc';
  $handler->display->display_options['fields']['field_eveny_date_desc']['table'] = 'field_data_field_eveny_date_desc';
  $handler->display->display_options['fields']['field_eveny_date_desc']['field'] = 'field_eveny_date_desc';
  $handler->display->display_options['fields']['field_eveny_date_desc']['label'] = '';
  $handler->display->display_options['fields']['field_eveny_date_desc']['element_label_colon'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['body']['type'] = 'text_summary_or_trimmed';
  $handler->display->display_options['fields']['body']['settings'] = array(
    'trim_length' => '300',
  );
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  /* Contextual filter: Content: Regions (field_event_regions) */
  $handler->display->display_options['arguments']['field_event_regions_tid']['id'] = 'field_event_regions_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['table'] = 'field_data_field_event_regions';
  $handler->display->display_options['arguments']['field_event_regions_tid']['field'] = 'field_event_regions_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['field_event_regions_tid']['exception']['title_enable'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['exception']['title'] = '';
  $handler->display->display_options['arguments']['field_event_regions_tid']['title_enable'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['title'] = '%1 Events';
  $handler->display->display_options['arguments']['field_event_regions_tid']['default_argument_type'] = 'taxonomy_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['field_event_regions_tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['vocabularies'] = array(
    'ny_regions' => 'ny_regions',
  );
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['type'] = 'convert';
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['transform'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate']['fail'] = 'empty';

  /* Display: Attachment */
  $handler = $view->new_display('attachment', 'Attachment', 'attachment_1');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'FILTER BY';
  $handler->display->display_options['link_url'] = '%1/%2';
  $handler->display->display_options['defaults']['query'] = FALSE;
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'fields';
  $handler->display->display_options['row_options']['default_field_elements'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Event Tags */
  $handler->display->display_options['fields']['field_event_tags']['id'] = 'field_event_tags';
  $handler->display->display_options['fields']['field_event_tags']['table'] = 'field_data_field_event_tags';
  $handler->display->display_options['fields']['field_event_tags']['field'] = 'field_event_tags';
  $handler->display->display_options['fields']['field_event_tags']['label'] = '';
  $handler->display->display_options['fields']['field_event_tags']['alter']['make_link'] = TRUE;
  $handler->display->display_options['fields']['field_event_tags']['alter']['path'] = 'events/%1/[field_event_tags]';
  $handler->display->display_options['fields']['field_event_tags']['alter']['replace_spaces'] = TRUE;
  $handler->display->display_options['fields']['field_event_tags']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_tags']['type'] = 'taxonomy_term_reference_plain';
  $handler->display->display_options['fields']['field_event_tags']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_event_tags']['delta_offset'] = '0';
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  /* Contextual filter: Content: Regions (field_event_regions) */
  $handler->display->display_options['arguments']['field_event_regions_tid']['id'] = 'field_event_regions_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['table'] = 'field_data_field_event_regions';
  $handler->display->display_options['arguments']['field_event_regions_tid']['field'] = 'field_event_regions_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['field_event_regions_tid']['exception']['title_enable'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['exception']['title'] = '';
  $handler->display->display_options['arguments']['field_event_regions_tid']['default_argument_type'] = 'taxonomy_tid';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_event_regions_tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['field_event_regions_tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['vocabularies'] = array(
    'ny_regions' => 'ny_regions',
  );
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['type'] = 'convert';
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate_options']['transform'] = TRUE;
  $handler->display->display_options['arguments']['field_event_regions_tid']['validate']['fail'] = 'empty';
  $handler->display->display_options['displays'] = array(
    'page' => 'page',
    'default' => 0,
    'block' => 0,
  );
  $export['nyl_events'] = $view;

  return $export;
}
