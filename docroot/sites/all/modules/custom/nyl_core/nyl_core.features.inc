<?php
/**
 * @file
 * nyl_core.features.inc
 */

/**
 * Implements hook_image_default_styles().
 */
function nyl_core_image_default_styles() {
  $styles = array();

  // Exported image style: home_video_campaign_static.
  $styles['home_video_campaign_static'] = array(
    'label' => 'Home Video Campaign Static',
    'effects' => array(
      4 => array(
        'name' => 'image_resize',
        'data' => array(
          'width' => 1440,
          'height' => 810,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}
