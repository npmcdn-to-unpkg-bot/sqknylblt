<?php
/**
 * @file
 * Contains nyl-vendors-retailer.tpl.php
 */
// VENDOR CATEGORY CONSTANTS
$categoryConstants = array(
  0 => '',
  1 => t('Grocery Store'),
  2 => t('Convenience Store'),
  3 => t('Bar')
);

// VENDOR TYPE CONSTANT
$typeConstants = array(
  0 => t('Full Service Terminal'),
  1 => t('Self Service Machine'),
  2 => t('Lottery On Board'),
);

// A couple of  latLong are wrong in the Database.  So if you don't see a markers in the static gmap, its way off.
$latLng = "{$retailer->latitude},{$retailer->longitude}";

$cityStateZip = preg_replace('/\s+$/', '', $retailer->city) .", {$retailer->state} {$retailer->zipCode}";
$fullAddress = "{$retailer->streetAddress} {$cityStateZip}";

?>

<div class="nyl-vendor-retailer" id="retailer_<?php print $retailer->id; ?>" >

  <span class="retailer_info">
    <div class="name">
      <!--   Problems with click trigger with clusters -->
      <!--   <a href="javascript:void(0);" onclick="google.maps.event.trigger(markers[{{ key; ?>], 'click');" >-->
      <a href="#" onclick="panToAndZoom( <?php print $retailer->latitude; ?>, <?php print $retailer->longitude; ?> );">
        <?php print preg_replace('/\s+$/', '', $retailer->name);  /* No trailing whitespace */ ?>
      </a>
    </div> <!-- .name -->

    <p class="address">
      <?php print check_plain($retailer->streetAddress); ?><br>
      <?php print check_plain($cityStateZip); ?>
      <?php if (!empty($retailer->phoneNumber)): ?>
          <div class="phoneNumber"> <?php print check_plain($retailer->phoneNumber); ?> </div>
      <?php endif; ?>
    </p> <!-- .address -->

    <div class="lat_long">[<?php print check_plain($retailer->latitude); ?>, <?php print check_plain($retailer->longitude); ?>]</div>

    <?php if ($retailer->description): ?>
      <p class="description"> <?php print t($retailer->description); ?> </p>
    <?php endif; ?>

    <!-- VENDOR CATEGORY -->
    <div class="category"><?php print t($categoryConstants[$retailer->category]); ?></div>

    <!-- VENDOR TYPE -->
    <div class="type"><?php print t($typeConstants[$retailer->type]); ?></div>
    <ul class="game_type">
      <?php
        $intersect = array_intersect($retailer->games, array(LOTTO, NUMBERS, TAKE5, MEGA, CASH, WIN, POWER, QUICK, PICK));
        if (! empty($intersect)) {
          print '<li>' . t('Draw Games');
          if (in_array(QUICK, $retailer->games)) {
            print t(' (including Quick Draw)');
          }
          print '</li>';
        }
      ?>
      </li>
      <li><?php print t('Instant Games'); ?></li>
      <?php
        $diff = array_diff($retailer->games, array(LOTTO, NUMBERS, TAKE5, MEGA, CASH, WIN, POWER, QUICK, PICK));
        if (! empty($diff)) {
          print '<li>' . t('Special Games') .'<!-- ' . implode(', ', $diff) . ' --><li>';
        }
      ?>
    </ul>
  </span> <!-- .retailer_info -->

  <span class="small_map">
    <!-- img src='//maps.googleapis.com/maps/api/streetview?size=300x150&location=<?php // print check_plain("{$vendor->latitude}, {$vendor->longitude}"); ?>&pitch=-0.76' -->
    <img src='http://maps.googleapis.com/maps/api/staticmap?center=<?php print check_plain($latLng); ?>&zoom=16&size=300x200&sensor=false&markers=color:blue%7C<?php print urlencode($fullAddress); ?>' >
  </span> <!-- .small_map -->

</div> <!-- .nyl-vendor-retailer -->