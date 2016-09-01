<?php

namespace Drupal\nyl_core;

class LegendController {

  static function getHomepageFeatured() {
    $node = self::getLatestStoryNid();
    if ($node) {
      $item = array(
        'name' => render($node->node_title),
        'amount' => render($node->field_field_winning_amount[0]['rendered']),
        'image_path' => image_style_url(
          $node->field_field_winner_image[0]['rendered']['#image_style'],
          $node->field_field_winner_image[0]['rendered']['#item']['uri']
        ),
      );
      $item['title'] = variable_get('nyl_video_featured_legend_title', '');
      $item['subtitle'] = variable_get('nyl_video_featured_legend_subtitle', '');
      $item['cta_text'] = variable_get('nyl_video_featured_legend_cta_text', '');
      $item['cta_link'] = url(variable_get('nyl_video_featured_legend_cta_link', ''));
      return $item;
    }
    else {
      return FALSE;
    }
  }

  static private function getLatestStoryNid() {
    $results = views_get_view_result('featured_legend');
    foreach($results as $result) {
      return $result;
    }
    return FALSE;
  }

}