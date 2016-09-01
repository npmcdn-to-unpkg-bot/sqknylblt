<?php
/**
 * @file
 * Contains field-collection-item--field-county-report.tpl.php.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 *
 * Array (
 * [0] => field_county_name
 * [1] => field_dollars_raised_for_schools
 * [2] => field_school_districts_funded
 * [3] => field_dollars_in_prizes_to_winne
 * [4] => field_winners_awarded
 * [5] => field_number_of_retailers
 * [6] => field_winning_locations )
 */
  $countyName = t($content['field_county_name'][0]['#markup']);
  $id = preg_replace("/(\W+)/", '', $countyName);
  $distribution = isset($content['field_report_dollar_1']) ? nice_number(ltrim($content['field_report_dollar_1'][0]['#markup'], '$')) : '';
  $cumulative =  isset($content['field_report_dollar_1']) ? nice_number(ltrim($content['field_report_dollar_2'][0]['#markup'], '$')) : '';
?>

<div id="<?php print $id; ?>" class="county <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <h2><?php print $countyName; ?></h2>
  <div class="content"<?php print $content_attributes; ?>>
    <?php if ($countyName == "NEW YORK STATE"): ?>
      Since 1967, the New York Lottery has earned <span class='dollars'> $ <?php print $cumulative; ?></span> to support education statewide, including <span class='dollars'> $<?php print $distribution; ?></span> in fiscal year 2015-16.
    <?php elseif($countyName == "NEW YORK CITY"): ?>
      Since 1977, the New York Lottery has earned <span class='dollars'> $<?php print $cumulative; ?></span> to support the <?php print $countyName; ?>'s school districts, including <span class='dollars'> $<?php print $distribution; ?></span> in fiscal year 2015-16.
      NEW YORK CITY's school district includes: Bronx, Kings, New York, Queens and Richmond Counties.
    <?php else: ?>
      Since 1977, the New York Lottery has earned <span class='dollars'> $<?php print $cumulative; ?></span> to support the <?php print $countyName; ?> County's school districts, including <span class='dollars'> $<?php print $distribution; ?></span> in fiscal year 2015-16.
    <?php endif; ?>

    <?php // print render($content); ?>
  </div> <!-- .content -->
</div> <!-- .county -->
