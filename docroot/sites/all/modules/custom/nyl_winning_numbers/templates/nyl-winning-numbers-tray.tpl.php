<?php
/**
 * @file
 * Contains nyl-winning-numbers-tray.tpl.php.
 *
 * Option 2 - Focus in on winning numbers, has additional space in the hover state for more game information and future promo icons.
 * - 3 column design
 */

// array_chunk — Split an array into chunks with size elements. The last chunk may contain less than size elements.
$rows = array_chunk($nodes, 3, TRUE);
$promo_img = path_to_theme() .'/image/promo-white-text.png';
$promo_mobile_img = path_to_theme() .'/image/promo-dark-blue-text.png';
$nyl_theme = drupal_get_path('theme', 'nylottery');

foreach ($nodes as $nid => $node) {
  $name[$nid] = strtolower(str_replace(' ', '', $node->title));
  $game_img[$nid] = image_style_url('game_logo', GAME_IMAGE_DIRECTORY . '/' . str_replace(' ', '_', $node->title) . '.png');
  if ($node->title == "Cash4Life" || $node->title == "Quick Draw") {
    $white_img[$nid] = $nyl_theme . '/assets/img/logo-' . strtolower(str_replace(' ', '', $node->title)) . '-white.svg';
  }
}
?>


<!-- Winning Numbers Modal Small -->
<div id="winning-numbers-modal-sm" class="modal no-padding" role="dialog">
  <!-- Modal background -->
  <div class="modal-overlay"></div>
  <div class="modal-corner-left">
    <div class="modal-corner-cover"></div>
  </div>

  <!-- Modal Content -->
  <div class="modal-content">
    <!-- Header -->
    <div class="modal-header no-padding">
      <div class="modal-close-bt">
        <span class="header2 text-white">Winning Numbers</span>
        <span class="glyphicon glyphicon-triangle-top text-yellow"></span>
      </div>
      <div class="modal-game-menu">
        <div class="game-menu-pointer"></div>
        <div class="modal-logos-container">
          <div class="row">
            <div class="col-xs-12"><span class="header2 text-dark-blue">Choose a game:</span>
            </div>
          </div>

          <?php foreach ($rows as $row): ?>
            <div class="row">
              <?php foreach ($row as $nid => $node): ?>
                <div class="col-xs-4">
                  <div class="winning-numbers-logo">
                    <a href="#winning-numbers--<?php print $name[$nid]; ?>-sm">
                      <img src="<?= $game_img[$nid] ?>"  alt="<?php print $node->title; ?>"/>
                    </a>
                  </div>
                </div> <!-- /.col-xs-4 -->
              <?php endforeach; ?>
            </div> <!-- /.row -->
          <?php endforeach; ?>
        </div>
      </div> <!-- /.modal-game-menu -->
    </div> <!-- /.modal-header -->
    <!-- End Header -->

    <!-- Body -->
    <div class="modal-body container no-padding">

      <?php foreach($nodes as $nid => $node): ?>
        <div id="winning-numbers--<?php print $name[$nid]; ?>-sm"
             class="winning-numbers-content-sm">
          <?php if(isset($promos[$nid])): ?>
            <a class="promo-link" href="/promotions"><img src="<?= $promo_mobile_img ?>"/></a>
          <?php endif; ?>
          <img class="logo-img" src="<?= $game_img[$nid] ?>"  alt="<?php print $node->title; ?>"/>
          <div class="info-container lazy-load">
            <button class="std btn" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
    <!-- End Body -->
  </div> <!-- /.modal-content -->
  <!-- End Content -->
</div> <!-- winning-numbers-modal-sm -->
<!-- End Winning Numbers Modal Small -->


<!-- Winning Numbers Modal Large -->
<div id="winning-numbers-modal-lg" class="modal" role="dialog">
  <!-- Modal background -->
  <div class="modal-overlay"></div>
  <div class="modal-corner-left">
    <div class="modal-corner-cover"></div>
  </div>
  <div class="modal-corner-right">
    <div class="modal-corner-cover"></div>
  </div>

  <!-- Modal Content -->
  <div class="modal-content">
    <!-- Close Button -->
    <div class="modal-close-bt">
      <div class="close-icon">
        <svg id="close-svg" width="100%" height="100%" viewBox="0 0 26 26">
          <g stroke="#092246" stroke-linecap="round" stroke-width="3">
            <line stroke-linecap="round" id="close-l1" x1="2" y1="2" x2="24"
                  y2="24"/>
            <line stroke-linecap="round" id="close-l2" x1="2" y1="24" x2="24"
                  y2="2"/>
          </g>
        </svg>
      </div>
    </div>
    <!-- End Close Button -->
    <!-- Header -->
    <div class="modal-header">
      <div class="header2 text-dark-blue">Winning Numbers</div>
      <a class="subheader3 text-dark-blue" href="/winning-numbers">
        See Past Winning Numbers
        <span class="glyphicon glyphicon-triangle-right text-teal"></span>
      </a>
    </div>
    <!-- End Header -->

    <!-- Body -->
    <div class="modal-body container">
      <table class="table table-bordered winning-numbers-table-dsk">
        <tbody>
        <?php foreach ($rows as $row): ?>
          <tr>
            <?php foreach($row as $nid => $node): ?>
              <td class="col-md-4">
                <div id="winning-numbers--<?php print $name[$nid]; ?>-lg" class="winning-numbers-content" >
                  <?php if(isset($promos[$nid])): ?>
                    <a class="promo-link" href="/promotions"><img src="<?= $promo_img ?>"/></a>
                  <?php endif; ?>
                  <div class="winning-numbers-logo">
                    <?php if (isset($white_img[$nid])): ?>
                      <img class="logo-img" src="<?= $game_img[$nid] ?>"  alt="<?php print $node->title; ?>"/>
                      <img class="svg logo-img-white" src="<?= $white_img[$nid] ?>">
                    <?php else: ?>
                      <img src="<?= $game_img[$nid] ?>"  alt="<?php print $node->title; ?>"/>
                    <?php endif; ?>
                  </div>
                  <div class="info-container lazy-load">
                    <button class="std btn" onclick="window.location.href='<?php print url('node/'.$node->nid); ?>'"><span>See Game Info</span></button>
                  </div>
                </div>
              </td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div> <!-- /.modal-body -->
    <!-- End Body -->
  </div> <!-- /.modal-content -->
</div>
<!-- End Winning Numbers Modal Large -->


<script type="text/javascript">
  <!--
  (function($) {
    function getWinningNumbers(event) {
      console.log('Get Winning Numbers.')
      $.ajax({
        url: '/nyl_winning_numbers/getTray.json',
        type: 'GET',
        dataType: 'json',
        headers: {
          'Accept': 'application/json'
        },
        success: function (json) {
          $.each(json, function (key, value) {
            var tile = $('#winning-numbers--' + key);
            $('.lazy-load', tile).html(value);
          });
        }
      });
    }

    $(document).ready( function() {
      $('#winning-numbers-btn').click(getWinningNumbers);
      $('#trayButton').click(getWinningNumbers);
    });

  })(jQuery);
  //-->
</script>