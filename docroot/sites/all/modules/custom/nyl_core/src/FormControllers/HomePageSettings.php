<?php

namespace Drupal\nyl_core\FormControllers;

class HomePageSettings extends \Drupal\cool\BaseSettingsForm {

  static public function getId() {
    return 'nyl_core_homepage_settings';
  }

  static public function build() {
    $form = parent::build();
    $form['main_slider'] = array(
      '#type' => 'fieldset',
      '#title' => t('Main Slider'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );
//    $form['main_slider']['nyl_main_slider_jackpot_max_slides'] = array(
//      '#type' => 'textfield',
//      '#title' => t('Jackpot Max Slides for Homepage Slideshow'),
//      '#default_value' => variable_get('nyl_main_slider_jackpot_max_slides', ''),
//      '#size' => 15,
//      '#maxlength' => 1,
//      '#required' => TRUE,
//    );
//    $form['main_slider']['jackpot_slide_selected'] = array(
//      '#type' => 'textfield',
//      '#title' => t('Jackpot Slide selected game id for slideshow. Inform game Drupal ID.'),
//      '#default_value' => variable_get('jackpot_slide_selected', ''),
//      '#description' => t('Will show only game related to informed ID<br />Leave empty if no specific game has to be showed in the slider.'),
//      '#size' => 15,
//      '#maxlength' => 5,
//    );
    $jackpots_available = \Drupal\nyl_core\JackpotController::availableJackPotGamesHomeSlider();
    foreach ($jackpots_available as $each_jackbox_key => $each_jackbox_name) {
      $form['main_slider']['nyl_main_slider_min_jackpot_' . $each_jackbox_key] = array(
        '#type' => 'textfield',
        '#title' => t('Minimum Jackpot amount for @jackpot_name', ['@jackpot_name' => $each_jackbox_name]),
        '#default_value' => variable_get('nyl_main_slider_min_jackpot_' . $each_jackbox_key, ''),
        '#description' => t('eg.: <strong>1000</strong> for 1 Billion'),
        '#field_prefix' => '$',
        '#field_suffix' => 'Million',
        '#size' => 6,
        '#maxlength' => 6,
      );
    }
    $form['featured_legend'] = array(
      '#type' => 'fieldset',
      '#title' => t('Featured Legend'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );
    $form['featured_legend']['nyl_video_featured_legend_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => variable_get('nyl_video_featured_legend_title', ''),
      '#size' => 60,
      '#maxlength' => 15,
      '#required' => TRUE,
    );
    $form['featured_legend']['nyl_video_featured_legend_subtitle'] = array(
      '#type' => 'textfield',
      '#title' => t('Subtitle'),
      '#default_value' => variable_get('nyl_video_featured_legend_subtitle', ''),
      '#required' => TRUE,
      '#maxlength' => 70,
    );
    $form['featured_legend']['nyl_video_featured_legend_cta_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Call to action - text'),
      '#default_value' => variable_get('nyl_video_featured_legend_cta_text', ''),
      '#size' => 60,
      '#maxlength' => 17,
      '#required' => TRUE,
    );
    $form['featured_legend']['nyl_video_featured_legend_cta_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Call to action - link'),
      '#description' => t('Please provide a full URL with <strong>http://</strong>, <strong>https://</strong> or and internal drupal path, like <strong>/path/to/page</strong>'),
      '#default_value' => variable_get('nyl_video_featured_legend_cta_link', ''),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    );
    $form['video_campaign'] = array(
      '#type' => 'fieldset',
      '#title' => t('Video Campaign'),
      '#collapsible' => FALSE,
      '#collapsed' => TRUE,
    );
    $form['video_campaign']['nyl_video_campaign_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => variable_get('nyl_video_campaign_title', ''),
      '#size' => 60,
      '#maxlength' => 43,
      '#required' => TRUE,
    );
    $form['video_campaign']['nyl_video_campaign_subtitle'] = array(
      '#type' => 'textfield',
      '#title' => t('Subtitle'),
      '#default_value' => variable_get('nyl_video_campaign_subtitle', ''),
      '#required' => TRUE,
      '#maxlength' => 137,
    );
    $form['video_campaign']['nyl_video_campaign_cta_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Call to action - text'),
      '#default_value' => variable_get('nyl_video_campaign_cta_text', ''),
      '#size' => 60,
      '#maxlength' => 17,
      '#required' => TRUE,
    );
    $form['video_campaign']['nyl_video_campaign_cta_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Call to action - link'),
      '#description' => t('Please provide a full URL with <strong>http://</strong>, <strong>https://</strong> or and internal drupal path, like <strong>/path/to/page</strong>'),
      '#default_value' => variable_get('nyl_video_campaign_cta_link', ''),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    );

    $form['video_campaign']['nyl_video_campaign_image_cta_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Call to action - Video link'),
      '#description' => t('Please provide a full URL with <strong>http://</strong>, <strong>https://</strong> or and internal drupal path, like <strong>/path/to/page</strong>'),
      '#default_value' => variable_get('nyl_video_campaign_image_cta_link', ''),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    );
    $form['video_campaign']['nyl_video_campaign_img_static_bg_fid'] = array(
      '#name' => 'nyl_video_campaign_img_static_bg_fid',
      '#type' => 'managed_file',
      '#title' => t('Static Video Image background'),
      '#description' => t('Static image for the video campaign block'),
      '#default_value' => variable_get('nyl_video_campaign_img_static_bg_fid', ''),
      '#upload_location' => 'public://home_video_campaign/',
      //validation: http://drupal.stackexchange.com/a/5630
      '#upload_validators' => array(
        'file_validate_extensions' => array('png'),
        'file_validate_size' => array(10*1024*1024),
      ),
    );
    $form['video_campaign']['nyl_video_campaign_img_anim_fid'] = array(
      '#name' => 'nyl_video_campaign_img_anim_fid',
      '#type' => 'managed_file',
      '#title' => t('Animation Video Image background'),
      '#description' => t('Image with full animation for the video campaign block'),
      '#default_value' => variable_get('nyl_video_campaign_img_anim_fid', ''),
      '#upload_location' => 'public://home_video_campaign/',
      //validation: http://drupal.stackexchange.com/a/5630
      '#upload_validators' => array(
        'file_validate_extensions' => array('png'),
        'file_validate_size' => array(10*1024*1024),
      ),
    );

    return $form;
  }

  static public function validate($form, &$form_state) {

    //sanitizing stuff
    $form_state['values']['nyl_video_featured_legend_title'] = strip_tags(check_plain($form_state['values']['nyl_video_featured_legend_title']));
    $form_state['values']['nyl_video_featured_legend_subtitle'] = strip_tags(check_plain($form_state['values']['nyl_video_featured_legend_subtitle']));
    $form_state['values']['nyl_video_featured_legend_cta_text'] = strip_tags(check_plain($form_state['values']['nyl_video_featured_legend_cta_text']));
    $form_state['values']['nyl_video_featured_legend_cta_link'] = strip_tags(check_plain($form_state['values']['nyl_video_featured_legend_cta_link']));
    $form_state['values']['nyl_video_campaign_title'] = strip_tags(check_plain($form_state['values']['nyl_video_campaign_title']));
    $form_state['values']['nyl_video_campaign_subtitle'] = strip_tags(check_plain($form_state['values']['nyl_video_campaign_subtitle']));
    $form_state['values']['nyl_video_campaign_cta_text'] = strip_tags(check_plain($form_state['values']['nyl_video_campaign_cta_text']));
    $form_state['values']['nyl_video_campaign_cta_link'] = strip_tags(check_plain($form_state['values']['nyl_video_campaign_cta_link']));
    $form_state['values']['nyl_video_campaign_image_cta_link'] = strip_tags(check_plain($form_state['values']['nyl_video_campaign_image_cta_link']));

    //validating available jackpots amount
    $jackpots_available = \Drupal\nyl_core\JackpotController::availableJackPotGamesHomeSlider();
    foreach ($jackpots_available as $each_jackbox_key => $each_jackbox_name) {
      $nyl_main_slider_min_item = $form_state['values']['nyl_main_slider_min_jackpot_' . $each_jackbox_key];
      if(!empty($nyl_main_slider_min_item) && !is_numeric($nyl_main_slider_min_item) && $nyl_main_slider_min_item < 1) {
        form_set_error('nyl_main_slider_min_jackpot_' . $each_jackbox_key, t('Please provide a numeric value greater than 1 <em>(1 Million)</em> for Minimum Jackpot amount for @jackpot_name', ['@jackpot_name' => $each_jackbox_name]));
      }
    }

    //validating jackpot_slide_selected
    $jackpot_slide_selected_nid = $form_state['values']['jackpot_slide_selected'];
    if(!empty($jackpot_slide_selected_nid)){
      if(!is_numeric($jackpot_slide_selected_nid)) {
        form_set_error('jackpot_slide_selected', t('Please provide a numeric value for Jackpot Slide selected game id.'));
      }
      else {
        if($jackpot_slide_selected_nid < 0) {
          form_set_error('jackpot_slide_selected', t('Please provide a valid drupal game id.'));
        } else {
          $query_replace = array(':status' => '1');
          $nid_arg = " AND n.nid = :nid";
          $query_replace[':nid'] = $jackpot_slide_selected_nid;
          $result = db_query("SELECT gid.field_draw_game_id_value, n.title, n.nid FROM field_data_field_draw_game_id gid INNER JOIN node n ON gid.entity_id = n.nid WHERE n.status = :status " . $nid_arg, $query_replace);
          if($result->rowCount() == 0) {
            form_set_error('jackpot_slide_selected', t('Please provide a valid drupal game id'));
          }
        }
      }
    }

    //validating nyl_main_slider_jackpot_max_slides
//    $jackpot_max_slides = $form_state['values']['nyl_main_slider_jackpot_max_slides'];
//    if(!is_numeric($jackpot_max_slides) && $jackpot_max_slides <= 9) {
//      form_set_error('nyl_main_slider_jackpot_max_slides', t('Please provide a numeric value for Jackpot Max Slides'));
//    }

    //validating cta links
    $cta_links = [
      'nyl_video_featured_legend_cta_link' => $form_state['values']['nyl_video_featured_legend_cta_link'],
      'nyl_video_campaign_cta_link' => $form_state['values']['nyl_video_campaign_cta_link'],
      'nyl_video_campaign_image_cta_link' => $form_state['values']['nyl_video_campaign_image_cta_link'],
    ];
    foreach ($cta_links as $cta_link_machine => $cta_link) {
      $cta_link_error = TRUE;
      //check non absolute URLs
      if(valid_url($cta_link)) {
        $cta_link_error = FALSE;
      }
      //check absolute URLs
      if(valid_url($cta_link, TRUE)) {
        $cta_link_error = FALSE;
      }
      if($cta_link_error === TRUE) {
        form_set_error($cta_link_machine, t('Please provide a valid URL for the call to action.'));
      }
    }
  }

  //managed_file submit, see http://www.zyxware.com/articles/5042/solved-how-to-use-managed-file-for-uploading-private-files-with-its-deletion-in-drupal-7
  static public function submit($form, &$form_state) {
    $image_fields = array('nyl_video_campaign_img_static_bg_fid', 'nyl_video_campaign_img_anim_fid');
    foreach ($image_fields as $image) {
      //updations for image fields
      if (isset($form_state['values'][$image])) {
        //remove existing document while clicking remove button
        if ($form_state['values'][$image] == 0){
          //get existing file id to delete
          $document_exist_id = variable_get($image, '');
          if (!empty($document_exist_id)) {
            $document_exist_file = file_load($document_exist_id);
            if (!empty($document_exist_file)) {
              //delete file usage
              file_usage_delete($document_exist_file, 'nyl_core', $image, $document_exist_id);
              // The file_delete() function takes a file object and checks to see if
              // the file is being used by any other modules. If it is the delete
              // operation is canceled, otherwise the file is deleted.
              file_delete($document_exist_file, TRUE);
              variable_set($image, '');
            }
          }
        }
        else {
          //adding document
          $current_document = file_load($form_state['values'][$image]);
          if (!empty($current_document->fid)) {
            //get currently uploaded file id
            $file_id = $current_document->fid;
            //setting file id to its variable
            variable_set($image, $file_id);
            file_usage_add($current_document, 'nyl_core', $image, $file_id);
            //make file status as permanent
            $current_document->status = FILE_STATUS_PERMANENT;
            file_save($current_document);
          }
        }
      }
    }
  }
}
