<?php
/**
 * @file
 * nyl_roles_permission.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function nyl_roles_permission_user_default_roles() {
  $roles = array();

  // Exported role: administrator.
  $roles['administrator'] = array(
    'name' => 'administrator',
    'weight' => 2,
  );

  // Exported role: editor.
  $roles['editor'] = array(
    'name' => 'editor',
    'weight' => 4,
  );

  // Exported role: publisher.
  $roles['publisher'] = array(
    'name' => 'publisher',
    'weight' => 3,
  );

  return $roles;
}
