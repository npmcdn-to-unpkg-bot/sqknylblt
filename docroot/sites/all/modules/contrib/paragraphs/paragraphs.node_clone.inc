<?php

/**
 * @file
 * Holds relevant functions for paragraph's node clone integration.
 */

/**
 * Implements hook_clone_node_alter().
 */
function paragraphs_clone_node_alter(&$node, $context) {
  foreach (field_info_fields() as $field_name => $field) {
    if ($field['type'] == 'paragraphs' && isset($node->$field_name)) {
      $language = $node->language;
      foreach ($node->$field_name as $key => $values) {
        paragraphs_clone_items('node', $node, $field_name, $language);
      }
    }
  }
}

/**
 * Implements hook_form_alter().
 */
function paragraphs_form_node_form_alter(&$form, &$form_state, $form_id) {
  // Alter the node edit forms for cloned nodes.
  if (('clone' == arg(2)) && ('_node_form' == substr($form_id, -10))) {
    // Go through all fields.
    foreach ($form_state['field'] as &$field_config) {
      $language = key($field_config);
      // Only find fields containing paragraphs items.
      if (isset($field_config[$language]['field']['type']) && ($field_config[$language]['field']['type'] == 'paragraphs')) {
        // Unset the item_id and revision_id of each paragraphs item so
        // that new items are created on save.
        foreach ($field_config as $language => $items) {
          if (isset($items['entity']) && count($items['entity'])) {
            foreach ($items['entity'] as $paragraph_item) {
              $paragraph_item->item_id = NULL;
              $paragraph_item->revision_id = NULL;
            }
          }
        }
      }
    }
  }
}

/**
 * Clone a Paragraphs item. Helper function for hook_clone_node_alter().
 */
function paragraphs_clone_items($entity_type, &$entity, $field_name, $language = LANGUAGE_NONE) {
  $entity_wrapper = entity_metadata_wrapper($entity_type, $entity);
  $old_items = $entity_wrapper->{$field_name}->value();
  if (!is_array($old_items)) {
    $old_items = array($old_items);
  }

  unset($entity->{$field_name}[$language]);

  foreach ($old_items as $old_item) {
    list( , , $bundle) = entity_extract_ids('paragraphs_item', $old_item);

    /* @var $new_item ParagraphsItemEntity */
    $new_item = entity_create('paragraphs_item', array('bundle' => $bundle, 'field_name' => $field_name));
    $new_item->setHostEntity($entity_type, $entity, $language);

    // Check if any of the fields in the newly cloned fc item is a paragraph.
    foreach (field_info_instances('paragraphs_item', $bundle) as $new_field_name => $new_field_instance) {
      if (!empty($old_item->{$new_field_name})) {
        $new_item->{$new_field_name} = $old_item->{$new_field_name};
        $field_info = field_info_field($new_field_name);
        if ($field_info['type'] == 'paragraphs') {
          paragraphs_clone_items('paragraphs_item', $new_item, $new_field_name, $language);
        }
      }
    }
  }
}