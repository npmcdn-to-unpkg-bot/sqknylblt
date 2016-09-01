<?php
/**
 * @file
 * Contains nyl-event-nearby-block.tpl.php.
 */
?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

<div id='nyl-event-nearby-block'>
  <label class="col-sm-1 control-label">Upcoming Events:</label>
  <div class="slider autoplay col-sm-11">
    <?php foreach ($events as $nid => $node): ?>
      <span class="nearby_event_node" id="node_<?php print $nid ?>">
        <div class="date">
          <?php
            $field_event_date = field_view_field('node', $node, 'field_event_date', array(
              'label'=>'hidden',
              'settings' => array('format_type' => 'event_short'),
            ));
            // Print only the next date of repeated date field.
            $now = date("Y-m-d 00:00:00");
            foreach($field_event_date['#items'] as $key => $item) {
              if ($now <= $item['value'] || $now <= $item['value2'] ) {
                print render($field_event_date[$key]);
                break;
              }
            }
          ?>
        </div>
        <label>
          <?php // region is required on events.
            $region = current(field_get_items('node', $node, 'field_event_regions'));
            if ($region) {
              $term = taxonomy_term_load($region['tid']);
              print(l($node->title, 'events/' . str_replace(' ', '-', $term->name), array('fragment' => 'node-' . $node->nid)));
            }
          ?>
        </label>
        <div clas="text">
          <?php
            $summary = field_view_field('node', $node, 'body', array(
              'label'=>'hidden',
              'type' => 'text_summary_or_trimmed',
              'settings'=>array('trim_length' => 150),
            ));
            print render($summary);
          ?>
        </div>
        </span>
      </span>
    <?php endforeach; ?>
  </div>
</div>



<script type="text/javascript">
  <!--
    (function ($) {
      $('.autoplay').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      });

    })(jQuery);
  //-->
</script>
