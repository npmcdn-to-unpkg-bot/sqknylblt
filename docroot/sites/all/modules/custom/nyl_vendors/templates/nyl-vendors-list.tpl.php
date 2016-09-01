<?php
/**
 * @file
 * Contains nyl-vendors-list.tpl.php
 */

$per_page = 10;
// Initialize the pager
$current_page = pager_default_initialize(count($vendors), $per_page);
// Split your list into page sized chunks
$chunks = array_chunk($vendors, $per_page, TRUE);
// Show the appropriate items from the list
$pageOfVendors = $chunks[$current_page];

/* see http://www.w3schools.com/html/html5_geolocation.asp */
?>

<h2><?php print t('Retailers'); ?></h2>


<div id="nyl-vendors-list">
  <?php if (!empty($vendors)): ?>
  <div class="grid">
    <?php foreach($pageOfVendors as $i => $vendor): ?>
      <div class="element-item" id="element_<?php print $vendor->id; ?>">

        <?php print theme('nyl_vendors_retailer', array('retailer' => $vendor)); ?>

      </div> <!-- .element-item -->
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>
<?php print theme('pager'); ?>
