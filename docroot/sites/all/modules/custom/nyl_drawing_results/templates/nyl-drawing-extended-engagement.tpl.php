<?php
/**
 * @file
 * Contains nyl-drawing-results-probability.tpl.php.
 * - cached per page.
 */
// $node = menu_get_object();
$form = drupal_get_form('nyl_drawing_results_probability_form', $node);
$gameId = (int) $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
?>

<div id='nyl-drawing-extended-engagement'>
  <h2><?php print t("Didn't Win?"); ?></h2>
  <div id='previous-checked'>
    <span id='nyl_drawing_results_key' class='hidden'><?php print $node->nid; ?></span>
    <div id='nyl_drawing_results_previous'></div>
  </div> <!-- #previous-checked -->

  <div id='probability-index'>
    <h4><?php print t("Probability Index"); ?></h4>
    <?php print render($form); ?>
    <div class='results'> ? </div>
  </div> <!-- #probability-index -->

</div> <!-- nyl-drawing-extended-engagement -->
