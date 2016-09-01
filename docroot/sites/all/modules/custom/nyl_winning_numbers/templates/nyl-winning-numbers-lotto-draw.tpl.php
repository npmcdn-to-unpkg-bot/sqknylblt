<?php
/**
 * @file
 * Contains nyl-winning-numbers-default-draw.tpl.php.
 */
$node = $variables['node'];
$draws = $variables['draws'];
$next = (isset($draws[0])) ? $draws[0] : array();
$draw = (isset($draws[1])) ? $draws[1] : array();

$results = explode('-', $draw->results);

$multiplierName = isset($node->field_draw_multiplier_name[LANGUAGE_NONE]) ? $node->field_draw_multiplier_name[LANGUAGE_NONE][0]['safe_value'] : '';
$next_multiplier = (isset($next->multiplierAmount) && $next->multiplierAmount > 1) ? "{$next->multiplierAmount}x $multiplierName" : ''; // TODO Should display????
$bonusName = isset($node->field_draw_bonus_name[LANGUAGE_NONE]) ? $node->field_draw_bonus_name[LANGUAGE_NONE][0]['safe_value'] : '';
$bonusValue = empty($bonusName) ? '' : ($bonusName == 'Lucky Sum' ? array_sum($results) : $draw->specialResult);
$game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
$game_png = str_replace(' ', '_', $node->title) . '.png';
$image = image_style_url('game_logo', GAME_IMAGE_DIRECTORY .'/'. $game_png);
$draw_next = format_date($next->resultDate/1000, 'draw_next');
if ($draw_next == format_date(time(), 'draw_next')) {
  $draw_next = 'Tonight';
}
?>

<?php if ($size == 'sm'): ?>

  <div class="text-date">
    <h1 class="text-dark-blue">
      <?php print date('l', $draw->resultDate/1000); ?>
      <span class="weight600">
        <?php print format_date($draw->resultDate/1000, 'draw_date'); ?>
      </span>
    </h1>
  </div>

  <div class="info-container">
    <div class="winning-numbers">
      <ul>
        <?php foreach ($results as $i => $number): ?>
          <li>
            <span class="winning-number"><?php print (int) $number; ?></span>
            <?php if ($i == 0 && $draw->multiplierAmount > 1): ?>
              <div class="bonus-text-container">
                <span class="bonus-text header2 text-dark-blue">
                  <?php print "{$multiplierName} x{$draw->multiplierAmount}"; ?>
                </span>
              </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        <?php if(!empty($bonusName)): ?>
        <li class="special">
          <span class="winning-number special-ball-number"><?= (int) $bonusValue; ?></span>
          <div class="special-text-container">
            <span class="special-text header2 text-dark-blue"><?= $bonusName; ?></span>
          </div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <div class="prizes">
      <ul>
        <li>
          <h2 class="text-dark-blue">
            <span class="weight600">Current Jackpot</span> $<?php print nice_number($next->jackpot); ?>
          </h2>
        </li>
        <li>
          <h2 class="text-dark-blue">
            <span class="weight600">Next Drawing</span> <?= $draw_next; ?>
        </h2></li>
      </ul>
    </div>
    <button class="std btn over" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
  </div> <!-- .info-container -->

<?php else: ?>

  <!-- .info-container -->
    <div class="winning-numbers">
      <div class="text-date">
        <h4 class="text-dark-blue">
          <?php print date('l', $draw->resultDate/1000); ?>
          <span class="weight600">
            <?php print format_date($draw->resultDate/1000, 'draw_date'); ?>
          </span>
        </h4>
      </div> <!-- /.text-date -->
      <ul>
        <?php foreach ($results as $i => $number): ?>
          <li>
            <span class="winning-number"><?php print (int) $number; ?></span>
            <?php if ($i == 0 && $draw->multiplierAmount > 1): ?>
              <div class="bonus-text-container">
                <span class="bonus-text header2 text-dark-blue">
                  <?php print "{$multiplierName} x{$draw->multiplierAmount}"; ?>
                </span>
              </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        <?php if(!empty($bonusName)): ?>
          <li class="special">
            <span class="winning-number special-ball-number"><?= (int) $bonusValue; ?></span>
            <div class="special-text-container">
              <span class="special-text header2 text-dark-blue"><?= $bonusName; ?></span>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
    <div class="prizes">
      <div class="row">
        <div class="col-xs-6">
          <h4>
            <span class="weight600">Current Jackpot</span><br>
            $<?php print nice_number($next->jackpot); ?>
          </h4>
        </div>
        <div class="col-xs-6">
          <h4>
            <span class="weight600">Next Drawing</span><br><?= $draw_next; ?>
          </h4>
        </div>
      </div>
      <button class="std btn" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
    </div>
  <!-- /.info-container -->

<?php endif; ?>
