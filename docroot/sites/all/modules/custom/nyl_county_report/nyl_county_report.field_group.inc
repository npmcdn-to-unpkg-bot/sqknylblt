<?php
/**
 * @file
 * nyl_county_report.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function nyl_county_report_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_county_reports|node|nyl_county_report|form';
  $field_group->group_name = 'group_county_reports';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'nyl_county_report';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'County Reports',
    'weight' => '4',
    'children' => array(
      0 => 'field_county_report',
      1 => 'feeds',
    ),
    'format_type' => 'tabs',
    'format_settings' => array(
      'formatter' => '',
      'instance_settings' => array(
        'classes' => 'group-county-reports field-group-tabs',
        'id' => '',
      ),
    ),
  );
  $field_groups['group_county_reports|node|nyl_county_report|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_county_reprorts|node|nyl_county_report|form';
  $field_group->group_name = 'group_county_reprorts';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'nyl_county_report';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'County-by-County Reports',
    'weight' => '3',
    'children' => array(
      0 => 'field_county_report',
      1 => 'feeds',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'County-by-County Reports',
      'instance_settings' => array(
        'required_fields' => 1,
        'classes' => 'group-county-reprorts field-group-tab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $field_groups['group_county_reprorts|node|nyl_county_report|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_report_county|node|nyl_report|form';
  $field_group->group_name = 'group_report_county';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'nyl_report';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'County',
    'weight' => '21',
    'children' => array(
      0 => 'field_county_report',
      1 => 'feeds',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => '',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_report_county|node|nyl_report|form'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('County');
  t('County Reports');
  t('County-by-County Reports');

  return $field_groups;
}
