<?php
/**
 * @file
 * nyl_winner_story.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function nyl_winner_story_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'create winner_story content'.
  $permissions['create winner_story content'] = array(
    'name' => 'create winner_story content',
    'roles' => array(
      'administrator' => 'administrator',
      'editor' => 'editor',
      'publisher' => 'publisher',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete any winner_story content'.
  $permissions['delete any winner_story content'] = array(
    'name' => 'delete any winner_story content',
    'roles' => array(
      'administrator' => 'administrator',
      'editor' => 'editor',
      'publisher' => 'publisher',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own winner_story content'.
  $permissions['delete own winner_story content'] = array(
    'name' => 'delete own winner_story content',
    'roles' => array(
      'administrator' => 'administrator',
      'editor' => 'editor',
      'publisher' => 'publisher',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit any winner_story content'.
  $permissions['edit any winner_story content'] = array(
    'name' => 'edit any winner_story content',
    'roles' => array(
      'administrator' => 'administrator',
      'editor' => 'editor',
      'publisher' => 'publisher',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own winner_story content'.
  $permissions['edit own winner_story content'] = array(
    'name' => 'edit own winner_story content',
    'roles' => array(
      'administrator' => 'administrator',
      'editor' => 'editor',
      'publisher' => 'publisher',
    ),
    'module' => 'node',
  );

  return $permissions;
}
