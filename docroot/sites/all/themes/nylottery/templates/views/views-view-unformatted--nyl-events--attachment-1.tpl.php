<?php
/**
 * @file
 * Contains views-view-unformatted--clone-of-events--attachment-1.tpl.php.
 */

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
$vocab = taxonomy_vocabulary_machine_name_load('ny_regions');
$tree = taxonomy_get_tree($vocab->vid);
$regions = array_map( function($r){ return str_replace(' ', '-', $r->name); }, $tree);
$path = explode('/', $_SERVER['REQUEST_URI']);
$myRegion = strtolower($path[2]);
$all = implode('/', array_slice($path, 0, 3))."/all";
?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

  <select id="nyl-events-region-select">
    <option value="/events/all">All</option>
    <?php foreach($regions as $region): ?>
      <option value="/events/<?php print $region; ?>/all" <?php if($myRegion == strtolower($region)) { print 'selected'; } ?>>
        <?php print $region; ?>
      </option>
    <?php endforeach; ?>
  </select>

  <div class="views-row views-row-0 views-row-even views-row-zero">
    <?php print l(t('All'), $all ); ?>
  </div>

<?php foreach (array_unique($rows) as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>




<script type="text/javascript">
  <!--
  (function ($) {
    $('#nyl-events-region-select').bind('change', function () { // bind change event to select
      var url = $(this).val(); // get selected value
      if (url != '') { // require a URL
        window.location = url; // redirect
      }
      return false;
    });

  })(jQuery);
  //-->
</script>
