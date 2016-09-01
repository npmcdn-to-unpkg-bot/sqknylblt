<?php
/**
 * @file
 * Contains nyl-draw-games-block.tpl.php.
 * for Bootstrap.
 */
?>
<div id='nyl-draw-games-block' class="grid row">

  <?php foreach($nodes as $node): ?>
    <?php
      $game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
      $game_png = str_replace(' ', '_', $node->title) . '.png';
      $thumbnail = image_style_url('thumbnail', GAME_IMAGE_DIRECTORY .'/'. $game_png);
    ?>
        <a href="<?php print drupal_get_path_alias('/node/'.$node->nid); ?>" style="text-decoration: none;">

          <div id='next-game-<?php print $game_id; ?>' class="flip-container cell col-xs-12 col-md-4 " style="border:solid 10px;" ontouchstart="this.classList.toggle('hover');">
            <div class="row flipper">
              <div class="front">
                <div class="col-xs-6 col-md-12" style="height:100px;">
                    <img src="<?php print $thumbnail; ?>" alt="<?php print $node->title; ?>" style="max-height:50px; max-width: 100px;">
                </div>
                <div class="col-xs-6 col-md-12">
                  <div class="next">
                  <?php if (isset($node->field_draw_drawing_desc[LANGUAGE_NONE])): ?>
                    <div class="text">Drawings:
                      <?php foreach($node->field_draw_drawing_desc[LANGUAGE_NONE] as $desc): ?>
                        <div class="drawing_desc"><?php print $desc['safe_value']; ?></div>
                      <?php endforeach; ?>
                    </div>
                  <?php else: ?>
                    <?php
                      $game_freq = field_view_field('node', $node, 'field_draw_game_freq');
                      print render($game_freq);
                    ?>
                  <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="back">
                <?php
                  $summary = field_view_field('node', $node, 'body', array('type' => 'text_summary_or_trimmed'));
                  print render($summary);;
                ?>
              </div>
            </div>
          </div>
        </a>
  <?php endforeach; ?>
</div> <!-- .row -->


<script type="text/javascript">
<!--
(function($) {
    $.ajax({
      url: '/nyl_draw/getWaysToPlay.json',
      type: 'GET',
      dataType: 'json',
      headers: {
        'Accept': 'application/json'
      },
      success: function (json) {
        $.each(json, function (key, value) {
          var tile = $('#next-game-' + key);
          $('.next', tile).html(value);
        });
      }
    });

})(jQuery);
//-->
</script>


<style>
  /* entire container, keeps perspective */
  .flip-container {
    perspective: 1000px;
  }
  /* flip the pane when hovered */
  .flip-container:hover .flipper, .flip-container.hover .flipper {
    transform: rotateY(180deg);
  }

  .flip-container, .front, .back {
    /*width: 320px;*/
    height: 200px;
  }

  /* flip speed goes here */
  .flipper {
    transition: 0.6s;
    transform-style: preserve-3d;

    position: relative;
  }

  /* hide back of pane during swap */
  .front, .back {
    backface-visibility: hidden;

    position: absolute;
    top: 0;
    left: 0;
  }

  /* front pane, placed above back */
  .front {
    z-index: 2;
    /* for firefox 31 */
    transform: rotateY(0deg);
  }

  /* back, initially hidden pane */
  .back {
    transform: rotateY(180deg);
  }
</style>