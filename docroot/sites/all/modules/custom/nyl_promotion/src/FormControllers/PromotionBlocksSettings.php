<?php

namespace Drupal\nyl_promotion\FormControllers;

class PromotionBlocksSettings extends \Drupal\cool\BaseSettingsForm {

  static public function getId() {
    return 'nyl_core_promotion_blocks_settings';
  }

  static private function getBlocksList() {
    return \Drupal\nyl_promotion\PromotionBlocksController::getAvailablePromotionBlocks();
  }

  static private function getPromosList() {
    return \Drupal\nyl_promotion\PromotionBlocksController::getPromotionsEachBlock();
  }
  
  static private function getPromoNodes() {
    return \Drupal\nyl_core\PromotionController::getPublishedPromotions();
  }

  static public function build() {

    drupal_add_js(drupal_get_path('module', 'nyl_promotion') . '/js/promotion-block-settings.js',
      array('type' => 'file', 'scope' => 'footer')
    );

    $form = parent::build();

    $available_blocks = self::getBlocksList();
    $promos = self::getPromosList();
    $promo_nodes = self::getPromoNodes();

    //getting default/selected values
    foreach ($available_blocks as $block_machine => $block_name) {
      foreach ($promos as $promo_machine => $promo_name) {
        $current_selected_promo = variable_get("nyl_promotion_{$block_machine}_{$promo_machine}_nid", '');
        if(!empty($current_selected_promo)) {
          $selected_promos[$block_machine][$current_selected_promo] = TRUE;
          $selected_position[$block_machine][$current_selected_promo] = substr($promo_machine, -1);
        }
      }
    }

    //header and options for table select, table will be for all promo blocks
    $header = [
      'position' => t('Position'),
      'title' => t('Title'),
      'subtitle' => t('Subtitle'),
      'cta' => t('Call To Action'),
      'logo' => t('Logo'),
    ];

    $iteration_blocks = 0;
    $block_collapsed = TRUE;
    foreach ($available_blocks as $block_machine => $block_name) {

      //first fieldset will always be open, others will be closed
      if ($iteration_blocks == 0) {
        $block_collapsed = FALSE;
      }

      $form[$block_machine] = array(
        '#type' => 'fieldset',
        '#title' => t('Promotion Settings for @block_name', ['@block_name' => $block_name]),
        '#collapsible' => TRUE,
        '#collapsed' => $block_collapsed,
      );

      $form[$block_machine]["nyl_promotion_{$block_machine}_title"] = array(
        '#type' => 'textfield',
        '#title' => t('Main Block Title'),
        '#default_value' => variable_get("nyl_promotion_{$block_machine}_title", ''),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
      );
      $form[$block_machine]["nyl_promotion_{$block_machine}_cta_text"] = array(
        '#type' => 'textfield',
        '#title' => t('Call to Action Text'),
        '#description' => t('Text for the link below the main title of the promotion block'),
        '#default_value' => variable_get("nyl_promotion_{$block_machine}_cta_text", ''),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
      );
      $form[$block_machine]["nyl_promotion_{$block_machine}_cta_link"] = array(
        '#type' => 'textfield',
        '#title' => t('Call to Action Link'),
        '#description' => t('Please provide a full URL with <strong>http://</strong>, <strong>https://</strong> or and internal drupal path, like <strong>/path/to/page</strong>'),
        '#default_value' => variable_get("nyl_promotion_{$block_machine}_cta_link", ''),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
      );

      $options = [];
      foreach ($promo_nodes as $promo_node_item) {
        $position_defaul_value = 0;
        if(isset($selected_position[$block_machine][$promo_node_item['promo_id']])) {
          $position_defaul_value = $selected_position[$block_machine][$promo_node_item['promo_id']];
        }
        $position_promo['data'] = array(
          '#type' => 'select',
          '#options' => [0 => '-select-', 1 => 'Left', 2 => 'Right'],
          '#name' => $block_machine . '_position' . '[' . $promo_node_item['promo_id'] . ']',
          '#value' => $position_defaul_value,
        );
        $options[$promo_node_item['promo_id']] = [
          'position' => $position_promo,
          'title' => $promo_node_item['title'],
          'subtitle' => $promo_node_item['promo_subtitle'],
          'cta' => $promo_node_item['promo_cta'],
          'logo' => theme('image_style', ['style_name' => 'thumbnail','path' => $promo_node_item['promo_logo']]),
        ];
      }
      $form[$block_machine . '_position'] = array (
        '#type' => 'value',
      );
      $default_selected = (isset($selected_promos[$block_machine])) ? $selected_promos[$block_machine] : [];
      $form[$block_machine]["{$block_machine}_tableselect"] = array(
        '#type' => 'tableselect',
        '#header' => $header,
        '#options' => $options,
        '#default_value' => $default_selected,
        '#empty' => t('No content available.'),
      );

      $block_collapsed = TRUE;
      $iteration_blocks++;
    }

    return $form;
  }

  static public function validate($form, &$form_state) {

    $available_blocks = self::getBlocksList();

    foreach ($available_blocks as $block_machine => $block_name) {

      //sanitizing stuff
      $form_state['values']["nyl_promotion_{$block_machine}_title"] = strip_tags(check_plain($form_state['values']["nyl_promotion_{$block_machine}_title"]));
      $form_state['values']["nyl_promotion_{$block_machine}_cta_text"] = strip_tags(check_plain($form_state['values']["nyl_promotion_{$block_machine}_cta_text"]));
      $form_state['values']["nyl_promotion_{$block_machine}_cta_link"] = strip_tags(check_plain($form_state['values']["nyl_promotion_{$block_machine}_cta_link"]));

      //validate call to action links
      $cta_link_machine = "nyl_promotion_{$block_machine}_cta_link";
      $cta_link = $form_state['values'][$cta_link_machine];
      $cta_link_error = TRUE;
      //check non absolute URLs
      if (valid_url($cta_link)) {
        $cta_link_error = FALSE;
      }
      //check absolute URLs
      if (valid_url($cta_link, TRUE)) {
        $cta_link_error = FALSE;
      }
      if ($cta_link_error === TRUE) {
        form_set_error($cta_link_machine, t('Please provide a valid URL for the call to action. (@block_name)', [
          '@block_name' => $block_name
        ]));
      }

      //validate selected promotions - max 2
      $ts_machine = "{$block_machine}_tableselect";
      $table_select = $form_state['values'][$ts_machine];
      $count_selected = 0;
      $items_selected = [];
      foreach ($table_select as $selected_item_key => $selected_item_value) {
        if ($selected_item_value == $selected_item_key && $selected_item_value != 0) {
          $count_selected++;
          $items_selected[] = $selected_item_value;
        }
      }
      if ($count_selected != 2) {
        form_set_error($ts_machine, t('Select 2 promotions for <strong>@block_name</strong>. Currently selected @count', [
          '@block_name' => $block_name,
          '@count' => $count_selected
        ]));
      } else {
        //validate selected position
        $position_machine = "{$block_machine}_position";
        $table_position = $form_state['values'][$position_machine];
        $selected_positions = [];
        foreach ($items_selected as $item) {
          if($table_position[$item] == 0) {
            form_set_error($ts_machine, t('Select a valid position for promotions on <strong>@block_name</strong>.', [
              '@block_name' => $block_name
            ]));
          }
          $selected_positions[] = $table_position[$item];
        }
        if ($selected_positions[0] == $selected_positions[1]) {
          form_set_error($ts_machine, t('Select different positions for promotions on <strong>@block_name</strong>.', [
            '@block_name' => $block_name
          ]));
        }
      }
    }
  }

  //managed_file submit, see http://www.zyxware.com/articles/5042/solved-how-to-use-managed-file-for-uploading-private-files-with-its-deletion-in-drupal-7
  static public function submit($form, &$form_state) {

    $values = $form_state['values'];
    $available_blocks = self::getBlocksList();
    $promos = self::getPromosList();

    foreach ($available_blocks as $block_machine => $block_name) {
      foreach ($promos as $promo_machine => $promo_name) {
        foreach ($values[$block_machine . '_tableselect'] as $selected_key => $selected_value) {
          if(isset($values[$block_machine . '_position'][$selected_value]) && "promo" . $values[$block_machine . '_position'][$selected_value] == $promo_machine) {
            variable_set("nyl_promotion_{$block_machine}_{$promo_machine}_nid", $selected_value);
          }
        }
      }
    }
  }
}
