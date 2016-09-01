<?php
/**
 * @file
 * nyl_draw.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function nyl_draw_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_draw_game_setting|node|draw_game|form';
  $field_group->group_name = 'group_draw_game_setting';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'draw_game';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Draw Game Setting',
    'weight' => '8',
    'children' => array(
      0 => 'field_draw_game_freq',
      1 => 'field_draw_pick_count',
      2 => 'field_draw_pick_min',
      3 => 'field_draw_pick_max',
      4 => 'field_draw_bonus_max',
      5 => 'field_draw_game_options',
      6 => 'field_draw_game_rank',
      7 => 'field_draw_bonus_name',
      8 => 'field_draw_multiplier_name',
      9 => 'field_draw_drawing_descr',
      10 => 'field_draw_drawing_desc',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-draw-game-setting field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_draw_game_setting|node|draw_game|form'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Draw Game Setting');

  return $field_groups;
}
