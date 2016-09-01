<?php
/**
 * @file
 * Contains nyl-drawing-results-previously-checked.tpl.php.
 */
?>
<!-- nyl-drawing-results-previously-checked.tpl.php -->
<?php if (!empty($tickets)): ?>
  <div class="text">
    <?php print t('Previously Checked'); ?>
  </div>
  <?php foreach($tickets as $i => $myNumbers): ?>
    <?php $ticket = _nyl_drawing_results_parseTicket($myNumbers); ?>
    <div class='ticket <?php print "ticket_{$i}"; ?>'>

      <a href="<?php print url($path, array('query' => array('myNumbers' => $myNumbers ))); ?>">
        <?php foreach($ticket['numbers'] as $j => $number): ?>
          <span class='circle number <?php print "number_{$j}"; ?>'><?php print((int) $number); ?></span>
        <?php endforeach; ?>
        <?php if (!empty($ticket['bonus'])): ?>
          + <span class="circle bonus"><?php print((int) $ticket['bonus']); ?></span>
        <?php endif; ?>
      </a>

      <?php if(isset($notes[$i])): ?>
        <span class='note'><?php print($notes[$i]); ?></span><!-- note -->
      <?php endif; ?>

    </div> <!-- ticket -->
  <?php endforeach; ?>
<?php endif; ?>