<?php

namespace Drupal\nyl_core\FormControllers;

class SiteSettings extends \Drupal\cool\BaseSettingsForm {

  static public function getId() {
    return 'nyl_core_site_settings';
  }

  static public function build() {
    $form = parent::build();
    $form['nyl_site_disclaimer'] = array(
      '#type' => 'textarea',
      '#title' => t('Site Disclaimer'),
      '#description' => t('This text is used on the Site Disclaimer block, that you can configure by <a href="@link">clicking here</a>', [
        '@link' => url('admin/structure/block/manage/cool/nyl_core_site_disclaimer/configure')
      ]),
      '#default_value' => variable_get('nyl_site_disclaimer', ''),
    );

    // TODO: choose draw game for jackpot slide, add radio/checkbox:jackpot_slide_selected, boolean:jackpot_max_slides
    return $form;
  }

  static public function validate($form, &$form_state) {
    //sanitizing stuff
    $form_state['values']['nyl_site_disclaimer'] = strip_tags(check_plain($form_state['values']['nyl_site_disclaimer']));
  }

  static public function submit($form, &$form_state) {
  }
}
