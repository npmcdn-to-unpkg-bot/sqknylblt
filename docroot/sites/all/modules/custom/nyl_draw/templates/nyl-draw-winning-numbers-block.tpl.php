<?php
/**
 * @file
 * Contains nyl-draw-winning-numbers-block.tpl.php.
 */

// array_chunk — Split an array into chunks with size elements. The last chunk may contain less than size elements.
$rows = array_chunk($nodes, 3, TRUE);

?>

<div id='nyl-draw-winning-numbers-block' class="winning-numbers col-md-12 no-padding">

  <div class="collapse winning-tray" id="winningTray">
    <div class="well">


      <div id="mobileTrayNav" class="mobile-tray-nav col-xs-12 visible-xs  hidden-sm hidden-md hidden-lg">

        <?php foreach ($rows as $row): ?>
          <div class="row">
            <?php foreach ($row as $nid => $node): ?>
              <?php
                $game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
                $game_png = str_replace(' ', '_', $node->title) . '.png';
                $thumbnail = image_style_url('thumbnail', GAME_IMAGE_DIRECTORY .'/'. $game_png);
              ?>
              <div class="col-xs-4 no-padding">
                <div class="game-icon">
                  <a class="btn on" href="#game<?php print $game_id; ?>">
                    <img src="<?php print $thumbnail; ?>" alt="<?php print $node->title; ?>" style="max-height:50px; max-width: 100px;">
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
            <div class="spacer" style="clear: both;"></div>
          </div> <!-- row -->
        <?php endforeach; ?>
      </div> <!-- mobileTrayNav -->


      <?php foreach($nodes as $nid => $node): ?>
        <?php
          $game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
          $game_png = str_replace(' ', '_', $node->title) . '.png';
          $thumbnail = image_style_url('thumbnail', GAME_IMAGE_DIRECTORY .'/'. $game_png);
        ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div id="winning-game-<?php print $game_id; ?>"  class="game">
            <span class="logo">
              <img src="<?php print $thumbnail; ?>" alt="<?php print $node->title; ?>" style="max-height:50px; max-width: 100px;">


              <?php if (isset($node->field_draw_drawing_desc[LANGUAGE_NONE])): ?>
                <?php foreach($node->field_draw_drawing_desc[LANGUAGE_NONE] as $desc): ?>
                  <div class="drawing_desc"><?php print $desc['safe_value']; ?></div>
                <?php endforeach; ?>
              <?php else: ?>
                <?php
                  $game_freq = field_view_field('node', $node, 'field_draw_game_freq');
                  print render($game_freq);
                ?>
              <?php endif; ?>
            </span>
            <?php print l("More Winning Numbers", '/node/'.$node->nid.'/winning+numbers', array('attributes' => array('class' => 'bottom left') )); ?>

          </div>
        </div>
      <?php endforeach; ?>
      <div class="spacer" style="clear: both;"></div>

    </div>
  </div>
  <a id="trayButton" class="tray-button btn collapsed" role="button" data-toggle="collapse" href="#winningTray" aria-expanded="false" aria-controls="winningTray">
    Latest Winning Numbers <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>
  </a>
</div>

<script type="text/javascript">
  <!--
  (function($) {
    $.ajax({
      url: '/nyl_draw/getSuperNav.json',
      type: 'GET',
      dataType: 'json',
      headers: {
        'Accept': 'application/json'
      },
      success: function (json) {
        $.each(json, function (key, value) {
          var tile = $('#winning-game-' + key);
          $('.logo', tile).html(value);
        });
      }
    });

  })(jQuery);
  //-->
</script>
