<?php
/**
 * @file
 * Contains nyl-draw-game-overview.tpl.php.
 *
 */
$gameId = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
$freq = isset($node->field_draw_game_freq[LANGUAGE_NONE]) ? $node->field_draw_game_freq[LANGUAGE_NONE][0]['value'] : 0;
$options = isset($node->field_draw_game_options[LANGUAGE_NONE]) ? array_column($node->field_draw_game_options[LANGUAGE_NONE], 'value') : array();

//
//$multiplierName = isset($node->field_draw_multiplier_name[LANGUAGE_NONE]) ? $node->field_draw_multiplier_name[LANGUAGE_NONE][0]['safe_value'] : '';
//$next_multiplier = ($next->multiplierAmount > 1) ? "{$next->multiplierAmount}x $multiplierName" : ''; // TODO Should display????
$bonusName = isset($node->field_draw_bonus_name[LANGUAGE_NONE]) ? $node->field_draw_bonus_name[LANGUAGE_NONE][0]['safe_value'] : false;
//$game_id = $node->field_draw_game_id[LANGUAGE_NONE][0]['value'];
//$game_png = str_replace(' ', '_', $node->title) . '.png';
//$thumbnail = image_style_url('thumbnail', GAME_IMAGE_DIRECTORY .'/'. $game_png);
//$date_format = nice_date_format($node->field_draw_game_freq[LANGUAGE_NONE])



?>
<div id="nyl-draw-game-overview">
  <div class="next">
    <?php if(in_array('progressive', $options)): ?>
      <div>
        CURRENT JACKPOT <span class="jackpot">$?? Million</span>
      </div>
    <?php endif; ?>
    <div>
      NEXT DRAWING <span class="resultDate">?, ?, 201?</span>
    </div>
  </div>
  <div class="last">
    <div>
      WINNING NUMBERS <span class="resultDate">?, ?, 201?</span>
    </div>
    <div>
      <span class="results">? ? ?</span>
      <?php if($bonusName): ?>
        + <span class="circle specialResult <?php print $bonusName; ?>">?</span>
      <?php endif; ?>
    </div>
    <?php if(isset($node->field_draw_multiplier_name[LANGUAGE_NONE])): ?>
      <div>
        <?php print $node->field_draw_multiplier_name[LANGUAGE_NONE][0]['safe_value']; ?> <span class="multiplierAmount">x?</span>
      </div>
    <?php endif; ?>
  </div>

  <?php if($freq == 2): ?>
    <div class="penultimate"><!-- 2nd to last daily drawings. -->
      <div>
        WINNING NUMBERS <span class="resultDate">?, ?, 201?</span>
      </div>
      <div>
        <div class="results">? ? ?</div>
        <?php if($bonusName): ?>
          + <span class="circle specialResult <?php print $bonusName; ?>">?</span>
        <?php endif; ?>
      </div>
      <?php if(isset($node->field_draw_multiplier_name[LANGUAGE_NONE])): ?>
        <div>
          <?php print $node->field_draw_multiplier_name[LANGUAGE_NONE][0]['safe_value']; ?> <span class="multiplierAmount">x?</span>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

</div>

<script type="text/javascript">
  <!--
  (function($) {
    $.ajax({
      url: '/nyl_draw/<?php print $gameId ?>/getGameDraws.json',
      type: 'GET',
      dataType: 'json',
      headers: {
        'Accept': 'application/json'
      },
      success: function (json) {
        updateDrawGameOverview(json);
      }
    });

    function updateDrawGameOverview(json) {
      var next = json[0];
      var last = json[1];
      var penultimate = json[2];
      //
      var n = $("#nyl-draw-game-overview .next");
      $(".jackpot", n).html(niceDollars(next.jackpot));
      $(".resultDate", n).html(niceDate(next.resultDate));

      var l = $("#nyl-draw-game-overview .last");
      $(".resultDate", l).html(niceDate(last.resultDate));
      $(".results", l).html(niceResults(last.results));
      // Not all game have an extra ball
      $(".specialResult", l).html(last.specialResult);
      //  Handle Lucky Sum
      $(".specialResult.Sum", p).html(luckySum(last.results));
      // Not all game have a multiplier
      $(".multiplierAmount", l).html(last.multiplierAmount);

      var p = $("#nyl-draw-game-overview .penultimate");
      if (p.length) {
        $(".resultDate", p).html(niceDate(penultimate.resultDate));
        $(".results", p).html(niceResults(penultimate.results));
        $(".specialResult", p).html(penultimate.specialResult);
        $(".specialResult.Sum", p).html(luckySum(penultimate.results));
        $(".multiplierAmount", p).html(penultimate.multiplierAmount);
      }
    }

    function niceResults(result) {
      var results = result.split("-");
      var html = '';
      $.each(results, function (key, value) {
        html += ' <span class="circle number">' +  parseInt(value) + '</span> ';
      });
      return html;
    }

    function luckySum(result) {
      var results = result.split("-");
      var sum = 0;
      $.each(results, function (key, value) {
        sum += parseInt(value);
      });
      return sum;
    }

    function niceDollars(amount) {
      // first strip any formatting;
      // amount = (0 + amount.replace(",", ""));

      // is this a number?
      if (!$.isNumeric(amount)) return false;

      // now filter it;
      if (amount > 1000000000000) { return '$'+ Math.round((amount/1000000000000), 2) + ' Trillion'; }
      else if (amount > 1000000000) { return '$'+ Math.round((amount/1000000000), 2) + ' Billion'; }
      else if (amount > 1000000) { return '$'+ Math.round((amount/1000000), 2) + ' Million'; }
      else if (amount > 1000) { return '$'+ Math.round((amount/1000), 2) + ' Thousand'; }

      return '$'+ amount;
    }

    function niceDate(timestamp) {
      var date = new Date(timestamp);
      var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];
      return (weekday[date.getDay()] +', '+ monthNames[date.getMonth()] + ' ' + date.getDate() + ', ' +  date.getFullYear());
    }

  })(jQuery);
  //-->
</script>