<?php
/**
 * @file
 * Contains modules/custom/nyl_draw/theme/nyl-draw-twice-nav.tpl.php.
 */
$node = $variables['node'];
$past = (count($variables['draws'])) ? array_slice($variables['draws'], 1, 2) : array();
$next = $variables['draws'][0];

$multiplierName = isset($node->field_draw_multiplier_name[LANGUAGE_NONE]) ? $node->field_draw_multiplier_name[LANGUAGE_NONE][0]['safe_value'] : '';
$next_multiplier = ($next->multiplierAmount > 1) ? "{$next->multiplierAmount}x $multiplierName" : ''; // TODO Should display????
$bonusName = isset($node->field_draw_bonus_name[LANGUAGE_NONE]) ? $node->field_draw_bonus_name[LANGUAGE_NONE][0]['safe_value'] : '';
$game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
$game_png = str_replace(' ', '_', $node->title) . '.png';
$image = image_style_url('game_logo', GAME_IMAGE_DIRECTORY .'/'. $game_png);
?>

<?php if ($size == 'sm'): ?>

  <div class="info-container">
    <div class="winning-numbers winning-numbers-2-col">
      <div class="row">
        <?php foreach($past as $draw): ?>
        <?php
          $results = explode('-', $draw->results);
          $bonusValue = empty($bonusName) ? '' : ($bonusName == 'Lucky Sum' ? array_sum($results) : $draw->specialResult);

          $timestamp = $draw->resultDate/1000;
          $day = date('D', $timestamp); // A textual representation of a day, three letters
          $hour = (int) date('G', $timestamp); // 24-hour format of an hour without leading zeros
          $timeOfDay = ($hour > 17) ? 'Evening' : 'Midday';
        ?>
          <div class="col-xs-6">
            <div class="text-date"><h1 class="text-dark-blue"><?= $timeOfDay ?><span
                  class="weight600"><?php print format_date($timestamp, 'draw_date'); ?></span></h1></div>
            <ul>
              <?php foreach ($results as $number): ?>
                <li><span class="winning-number"><?= $number; ?></span></li>
              <?php endforeach; ?>
              <li>
                <span class="winning-number special-ball-number"><?= $bonusValue ?></span>
                <div class="special-text-container">
                  <span class="special-text header2 text-dark-blue"><?= $bonusName ?></span>
                </div>
              </li>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="prizes">
      <ul>
        <li>
          <h2 class="text-dark-blue">
            <?php
              $timestamp = $next->resultDate/1000;
              $day = date('D', $timestamp); // A textual representation of a day, three letters
              $hour = (int) date('G', $timestamp); // 24-hour format of an hour without leading zeros
              $timeOfDay = ($hour > 17) ? 'Tonight' : 'Midday'; // TODO today vs tomorrow.
            ?>
            <span class="weight600">Next Drawing</span> <?= $timeOfDay ?></h2></li>
      </ul>
    </div>
    <button class="std btn over" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
  </div>

<?php else: ?>

  <!-- div class="info-container" -->
    <div class="winning-numbers winning-numbers-2-col small-numbers">
      <div class="row">
      <?php foreach($past as $draw): ?>
        <?php
          $results = explode('-', $draw->results);
          $bonusValue = empty($bonusName) ? '' : ($bonusName == 'Lucky Sum' ? array_sum($results) : $draw->specialResult);

          $timestamp = $draw->resultDate/1000;
          $day = date('D', $timestamp); // A textual representation of a day, three letters
          $hour = (int) date('G', $timestamp); // 24-hour format of an hour without leading zeros
          $timeOfDay = ($hour > 17) ? 'Evening' : 'Midday';
        ?>
          <div class="col-xs-6">
            <div class="text-date">
              <h4 class="text-dark-blue">
                <?= $timeOfDay ?> <span class="weight600"><?php print format_date($timestamp, 'draw_date'); ?></span>
              </h4>
            </div>
            <ul>
              <?php foreach ($results as $number): ?>
                <li><span class="winning-number"><?= (int) $number; ?></span></li>
              <?php endforeach; ?>
              <li>
                <span class="winning-number special-ball-number"><?= (int) $bonusValue ?></span>
                <div class="special-text-container">
                  <span class="special-text header2 text-dark-blue"><?= $bonusName ?></span>
                </div>
              </li>
            </ul>
          </div> <!-- /.col-xs-6 -->
        <?php endforeach; ?>
      </div>
    </div> <!-- /.winning-numbers -->

    <div class="prizes">
      <div class="row">
        <div class="col-xs-12">
          <h4>
            <?php
              $timestamp = $next->resultDate/1000;
              $day = date('D', $timestamp); // A textual representation of a day, three letters
              $hour = (int) date('G', $timestamp); // 24-hour format of an hour without leading zeros
              $timeOfDay = ($hour > 17) ? 'Tonight' : 'Midday'; // TODO today vs tomorrow.
            ?>
            <span class="weight600">Next Drawing</span><br><?= $timeOfDay ?>
          </h4>
        </div>
      </div>
      <button class="std btn" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
    </div>
  </div> <!-- /.prizes -->

<?php endif; ?>
