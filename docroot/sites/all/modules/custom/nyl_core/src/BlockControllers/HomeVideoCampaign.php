<?php

namespace Drupal\cool_examples\Controllers\BlockControllers;

class HomeVideoCampaign extends \Drupal\cool\BaseBlock {

  public static function getId() {
    return 'nyl_core_home_video_campaign';
  }

  public static function getAdminTitle($delta = '') {
    return t('NYL - Home Video Campaign');
  }

  static public function getDefinition($delta = '') {
    return [
      'cache' => DRUPAL_CACHE_GLOBAL
    ];
  }

  public static function getContent($delta = '') {
    $title = variable_get('nyl_video_campaign_title', '');
    $subtitle = variable_get('nyl_video_campaign_subtitle', '');
    $cta_text = variable_get('nyl_video_campaign_cta_text', '');
    $cta_link = variable_get('nyl_video_campaign_cta_link', '');
    $image_cta_link = variable_get('nyl_video_campaign_image_cta_link', '');
    $video_img_static_url = $video_img_anim_url = '';
    $video_img_static_fid = variable_get('nyl_video_campaign_img_static_bg_fid', '');
    if(!empty($video_img_static_fid)){
      $video_img_static_file = file_load($video_img_static_fid);
      $video_img_static_url = image_style_url('home_video_campaign_static', $video_img_static_file->uri);
    }
    $video_img_anim_fid = variable_get('nyl_video_campaign_img_anim_fid', '');
    if(!empty($video_img_anim_fid)){
      $video_img_anim_file = file_load($video_img_anim_fid);
      $video_img_anim_url = file_create_url($video_img_anim_file->uri);
    }
    $variables = array(
      'title' => $title,
      'subtitle' => $subtitle,
      'cta_text' => $cta_text,
      'cta_link' => url($cta_link),
      'image_cta_link' => url($image_cta_link),
      'video_img_static_url' => $video_img_static_url,
      'video_img_anim_url' => $video_img_anim_url,
    );
    return theme('nyl_core_home_video_campaign', $variables);
  }
}
