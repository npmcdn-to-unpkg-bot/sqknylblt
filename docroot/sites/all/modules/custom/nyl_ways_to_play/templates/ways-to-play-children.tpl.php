<?php
/**
 * @file
 * Contains ways-to-play-children.tpl.php.
 * - title : Header
 * - menu = menu_build_tree('main-menu', $parameters)
 */

  $name = str_replace(' ', '-', strtolower(strip_tags($title)));
?>

<?php if (!empty($title)): ?>
  <div class="header2 <?= $name ?> text-dark-blue text-centered"><?= strip_tags($title) ?></div>
<?php endif; ?>

  <div class="more-ways <?= $name ?> container row-15-cols no-padding">

  <?php
    $borderClass = '';
    $pattern = '/\S+\.(png|gif|jpg|svg)\b/i'; // Look for images.
    foreach ($menu as $mlid => $element):
      $link = &$element['link'];
      if ($link['hidden']) {
        continue;
      }
      if (preg_match($pattern, $link['link_title'], $matches) > 0):
        $link['link_title'] = preg_replace(
                  '/\S+\.(png|gif|jpg|svg)\b/i',
                  '<img src = "' . url($matches[0]) . '" /><p class="text-left">',
                  $link['link_title']) .'</p>';
        $name = str_replace(' ', '-', strtolower(strip_tags($link['link_title'])));
  ?>
        <div class="col-md-3 <?= $borderClass ?>">
          <a href="<?= url($link['link_path']); ?>">
            <div class="game-icon text-bottom subheader3 text-dark-blue game-icon-<?= $name ?>">
              <?= strip_tags($link['link_title']) ?>
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
      <?php elseif ($link['has_children'] == 0): ?>
        <!-- separator w/o children add boarder to next element -->
        <?php $borderClass = 'border-left border-dark-blue scratch-off'; ?>
      <?php endif; // don't care about grand-children. ?>
    <?php endforeach; ?>
  </div> <!-- container -->
