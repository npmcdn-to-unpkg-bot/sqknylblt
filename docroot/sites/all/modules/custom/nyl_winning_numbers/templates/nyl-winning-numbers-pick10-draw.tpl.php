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

  <!-- div class="info-container" -->
    <div class="winning-numbers winning-numbers-ten">

      <div class="winning-numbers-ten-content-container">
        <div class="row">
          <div class="col-xs-1"></div>
          <div class="col-xs-10">
            <h1 class="text-dark-blue">
              <?php print date('l', $draw->resultDate/1000); ?>
              <span class="weight600">
                <?php print format_date($draw->resultDate/1000, 'draw_date'); ?>
              </span>
            </h1>
          </div>
          <div class="col-xs-1"></div>
        </div>

        <?php
          $len = count($results);
          $firstHalf = array_slice($results, 0, floor($len / 2));
          $lastHalf = array_slice($results,  floor($len / 2));
        ?>
        <div class="row">
          <div class="col-xs-1"></div>
          <?php foreach ($firstHalf as $i => $number): ?>
            <div class="col-xs-1">
              <span class="winning-number"><?= (int) $number; ?></span>
            </div>
          <?php endforeach; ?>
          <div class="col-xs-1"></div>
        </div>

        <div class="row">
          <div class="col-xs-1"></div>
          <?php foreach ($lastHalf as $i => $number): ?>
            <div class="col-xs-1">
              <span class="winning-number"><?= (int) $number; ?></span>
            </div>
          <?php endforeach; ?>
          <div class="col-xs-1"></div>
        </div>
      </div>
    </div>
    <div class="prizes">
      <ul>
        <li><h2 class="text-dark-blue"><span class="weight600">Next Drawing</span> <?= $draw_next; ?></h2></li>
      </ul>
    </div>
    <button class="std btn" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
  <!-- /div -->

<?php else: ?>

  <!-- .info-container -->
  <div class="winning-numbers winning-numbers-ten">
    <div class="row">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
        <h4 class="text-dark-blue">
          <?php print date('l', $draw->resultDate/1000); ?>
          <span class="weight600">
              <?php print format_date($draw->resultDate/1000, 'draw_date'); ?>
            </span>
        </h4>
      </div>
      <div class="col-xs-1"></div>
    </div>

  <?php
    $len = count($results);
    $firstHalf = array_slice($results, 0, floor($len / 2));
    $lastHalf = array_slice($results,  floor($len / 2));
  ?>
    <div class="row">
      <div class="col-xs-1"></div>
      <?php foreach ($firstHalf as $i => $number): ?>
        <div class="col-xs-1">
          <span class="winning-number"><?php print (int) $number; ?></span>
        </div>
      <?php endforeach; ?>
      <div class="col-xs-1"></div>
    </div>
    <div class="row">
      <div class="col-xs-1"></div>
      <?php foreach ($lastHalf as $i => $number): ?>
        <div class="col-xs-1">
          <span class="winning-number"><?php print (int) $number; ?></span>
        </div>
      <?php endforeach; ?>
      <div class="col-xs-1"></div>
    </div>
  </div> <!-- /.winning-numbers -->
  <div class="prizes">
    <div class="row">
      <div class="col-xs-12">
        <h4><span class="weight600">Next Drawing</span><br><?= $draw_next; ?></h4>
      </div>
    </div>
    <button class="std btn over" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
  </div>

  <!-- /.info-container -->

<?php endif; ?>
