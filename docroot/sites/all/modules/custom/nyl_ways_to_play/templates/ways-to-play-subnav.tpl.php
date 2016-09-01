<?php
/**
 * @file
 * Contains ways-to-play-subnav.tpl.php.
 * - $menu = menu_build_tree('main-menu', $parameters);
 */
  $theme_path = drupal_get_path('theme',$GLOBALS['theme']);
  $children = array();
?>

<!-- Ways to Play Modal -->

<div class="modal modal-pale-blue no-overflow ways-to-play" id="ways-to-play-modal" role="dialog">
  <!-- Modal background -->
  <div class="modal-overlay"></div>
  <div class="modal-corner-left">
    <div class="modal-corner-cover"></div>
  </div>
  <div class="modal-corner-right">
    <div class="modal-corner-cover"></div>
  </div>
  <!--<div class="modal-content-wrapper">-->
  <div class="modal-content">
    <div class="modal-header">
      <!-- Close Button -->
      <div class="modal-close-bt" >
        <div class="close-icon">
          <svg id="close-svg" viewBox="0 0 26 26">
            <g stroke="#092246" stroke-linecap="round" stroke-width="3">
              <line stroke-linecap="round" id="close-l1" x1="2" y1="2" x2="24" y2="24"/>
              <line stroke-linecap="round" id="close-l2" x1="2" y1="24" x2="24" y2="2"/>
            </g>
          </svg>
        </div>
      </div>
      <!-- End Close Button -->
      <!--<div class="modal-top visible-md visible-lg">-->
        <div class="header2 text-dark-blue">Games</div>
        <a href="/ways-to-play" class="subheader3 text-dark-blue">View all<span class="glyphicon glyphicon-triangle-right text-teal"></span></a>
      <!-- </div> -->
    </div> <!-- .modal-header -->

    <div class="modal-body">
      <div class="games container row-15-cols no-padding">
        <?php
          $borderClass = '';
          $pattern = '/\S+\.(png|gif|jpg|svg)\b/i'; // Look for images.
          foreach ($menu as $mlid => $element):
            $link = &$element['link'];
            if ($link['hidden']) {
              continue;
            }
            $itemClasses = $link['localized_options']['item_attributes']['class'];
            $itemSpan = empty($itemClasses) ? '' :  "<span class= '{$itemClasses}'></span>";
            if (preg_match($pattern, $link['link_title'], $matches) > 0):
              $link['link_title'] = preg_replace(
                '/\S+\.(png|gif|jpg|svg)\b/i',
                '<img src = "' . url($matches[0]) . '" /><p class="text-left">',
                $link['link_title']) . $itemSpan . '</p>';
              $name = str_replace(' ', '-', strtolower(strip_tags($link['link_title'])));
        ?>
              <div class="col-md-3 <?= $borderClass ?>">
                <a href="<?= url($link['link_path']); ?>">
                  <div class="game-icon text-bottom subheader3 text-dark-blue game-icon-<?= $name ?>">
                        <?= $link['link_title'] ?>
                  </div>
                </a>
              </div>
              <?php $borderClass = ''; ?>
            <?php elseif ($link['link_path'] != '<separator>'): ?>
              <?php $name = str_replace(' ', '-', strtolower(strip_tags($link['link_title']))); ?>
              <div class="col-md-3 <?= $borderClass ?>">
                <a href="<?= url($link['link_path']); ?>">
                  <div class="icon game-icon-<?= $name ?>"><!-- css background image --></div>
                  <p class="subheader3 text-dark-teal">
                    <?= strip_tags($link['link_title']) ?>
                  </p>
                </a>
              </div>
              <?php $borderClass = ''; ?>
            <?php elseif ($link['has_children']): ?>
              <?php
                $parent = menu_build_tree('main-menu', array(
                    'active_trail' => array($link['plid']),
                    'only_active_trail' => FALSE,
                    'min_depth' => $link['depth'] + 1,
                    'expanded' => array($link['mlid']),
                    'conditions' => array('plid' => $link['mlid']),
                  )
                );
                $children[] = theme('ways_to_play_children', array('title' => $link['link_title'], 'menu' => $parent));
                $borderClass = '';
              ?>
            <?php else: ?>
              <!-- separator w/o children add boarder to next element -->
              <?php $borderClass = 'border-left border-dark-blue scratch-off'; ?>
            <?php endif; ?>
          <?php endforeach; ?>
      </div> <!-- /.container -->
      <br/>
      <?php echo(implode("<br/>", $children)); ?>

    </div> <!-- /.modal-body -->
  </div> <!-- modal-content -->
</div> <!-- /.modal -->
<!-- End Ways to Play Modal -->