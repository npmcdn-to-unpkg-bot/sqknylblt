<?php
/**
 * @file
 * Contains modules/custom/nyl_draw/theme/nyl-draw-WaysToPlay.tpl.php.
 */
$node = $variables['node'];
$next = $variables['next'];


$multiplierName = isset($node->field_draw_multiplier_name[LANGUAGE_NONE]) ? $node->field_draw_multiplier_name[LANGUAGE_NONE][0]['safe_value'] : '';
$next_multiplier = ($next->multiplierAmount > 1) ? "{$next->multiplierAmount}x $multiplierName" : ''; // TODO Should display????
//$bonusName = isset($node->field_draw_bonus_name[LANGUAGE_NONE]) ? $node->field_draw_bonus_name[LANGUAGE_NONE][0]['safe_value'] : '';
//$game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
//$game_png = str_replace(' ', '_', $node->title) . '.png';
//$thumbnail = image_style_url('thumbnail', GAME_IMAGE_DIRECTORY .'/'. $game_png);

?>
<!---->
<!--<span class="logo">-->
<!--  <img src="--><?php //print $thumbnail; ?><!--" alt="--><?php //print $node->title; ?><!--" class="logo_img"/>-->
<!--</span>-->

<?php if (!empty($next->jackpot)): ?>
  <p class="jackpot"><?php print nice_number($next->jackpot); ?></p>
  <p class="multiplier"><?php print $next_multiplier; ?></p>
<?php endif; ?>

<p class="text">Next Drawing</p>
<?php if (!empty($next)): ?>
  <p class="date"><?php print format_date($next->resultDate/1000, 'long'); ?></p>
<?php else: ?>
  <p class="date"><?php print $node->field_draw_date_desc[LANGUAGE_NONE][0]['safe_value']; ?></p>
<?php endif; ?>
