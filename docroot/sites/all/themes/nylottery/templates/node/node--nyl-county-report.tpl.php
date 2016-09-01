<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */

$countyAreas = nyl_county_report_getCountyAreas();
$counties = array_unique(array_unique(array_map(function ($v) { return $v['name']; }, $countyAreas)));
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && !empty($title)): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>">Report for <?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
    <span class="submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </span>
    <?php endif; ?>
  </header>
  <?php endif; ?>

  <?php print render($content['body']); ?>

  <section class="row">

    <!-- rainbow and image goes here -->

    <div class="detail3">
      Let's get specific!  Roll over the great state of New York for the county-by-county breakdown of
      <span class='field_report_year'><?php print $node->field_report_year['und'][0]['safe_value']; ?></span>
    </div>
    <div class="col-sm-6">
      <div class="desktop_only">
        <map name="NewYorkCountyMap">
          <?php foreach($countyAreas as $county): ?>
            <area class="county" shape="polygon"  href="#<?php print preg_replace("/(\W+)/", '', $county['name']); ?>" coords="<?php print $county['coords']; ?>">
          <?php endforeach; ?>
          <!-- text areas -->
          <area class="county" shape="polygon" href="#CHEMUNG" coords="219, 303, 265, 303, 265, 314, 218, 314, 218, 304, 219, 303">
          <area class="county" shape="polygon" href="#NASSAU" coords="453, 411, 491, 411, 491, 421, 452, 420, 452, 411, 453, 411">
          <area class="county" shape="polygon" href="#NEWYORK" coords="356, 380, 401, 380, 401, 391, 356, 391, 356, 380">
          <area class="county" shape="polygon" href="#BRONX" coords="446, 378, 473, 378, 473, 368, 445, 368, 445, 377, 446, 378">
          <area class="county" shape="polygon" href="#KINGS"coords="371, 396, 399, 396, 399, 404, 371, 404, 371, 397, 371, 396">
          <area class="county" shape="polygon" href="#QUEENS" coords="433, 420, 470, 421, 470, 428, 433, 428, 433, 420">
          <area class="county" shape="polygon" href="#RICHMOND" coords="351, 410, 400, 410, 400, 419, 352, 419, 352, 411, 351, 410">
          <area class="county" shape="polygon" href="#ORLEANS" coords="98, 155, 98, 144, 137, 144, 137, 156, 98, 156, 98, 155">
          <area class="county" shape="polygon" href="#SCHENECTADY" coords="477, 194, 544, 194, 544, 206, 478, 206, 478, 194, 477, 194">
          <area class="county" shape="polygon" href="#SCHUYLER" coords="162, 299, 205, 299, 205, 309, 162, 309, 162, 299">
          <area class="county" shape="polygon" href="#SENECA" coords="187, 143, 226, 143, 226, 153, 186, 153, 186, 143, 187, 143">
          <!-- North Fork -->
          <area class="county" shape="polygon" href="#SUFFOLK" coords="544, 346, 548, 349, 553, 343, 551, 340, 545, 346, 544, 346">
        </map>
        <!-- img src="http://eservices.nysed.gov/countymap/images/cntynam.gif" alt="NY County Map" border="0--" usemap="#NewYorkCountyMap" -->
        <img src="<?= $theme_path ?>/assets/img/ny-county-map.gif" alt="NY County Map" border="0--" usemap="#NewYorkCountyMap">
      </div>
      <select id="county-select">
        <option value="#NEWYORKSTATE">NEW YORK STATE</option>
        <?php foreach ($counties as $county): ?>
          <?php $value = in_array($county, array('Bronx', 'Kings', 'New York', 'Queens', 'Richmond')) ? 'NewYorkCity' : preg_replace("/(\W+)/", '',  $county); ?>
          <option value="#<?php print $value; ?>"><?php print $county; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-sm-6">
      <?php
        // Hide comments, tags, and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        hide($content['field_tags']);
        hide($content['field_report_year']);
        print render($content);
      ?>
    </div>
  </section> <!-- .row -->

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
  <footer>
    <?php print render($content['field_tags']); ?>
    <?php print render($content['links']); ?>
  </footer>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
</article>




<script type="text/javascript">
  <!--
  (function ($) {

    $(".county").on("click", function(event){
      // event.preventDefault();
      var county = event.currentTarget.hash;
      $("#county-select").find('option').removeAttr("selected");
      console.log('clicked '+ county);
      $('#county-select option[value='+ county +']').attr("selected", "selected");
      if (county == '#BRONX' || county == '#KINGS' || county == '#NEWYORK' || county == '#QUEENS' || county == '#RICHMOND' ) {
        county = '#NEWYORKCITY';
      }
      $(".field-name-field-county-report .field-item").hide();
      $(county).closest('.field-item').show();
    });

    $('#county-select').on('change', function(){
      var county = this.value;
      console.log('selected '+ county );
      if (county == '#BRONX' || county == '#KINGS' || county == '#NEWYORK' || county == '#QUEENS' || county == '#RICHMOND' ) {
        county = '#NEWYORKCITY';
      }
      $(".field-name-field-county-report .field-item").hide();
      $(county).closest('.field-item').show();
    });

  })(jQuery);
  //-->
</script>


<?php
  function nyl_county_report_getCountyAreas() {
    return array(
      array("name" => "ALBANY",  "coords" => "392, 247, 392, 245, 395, 227, 397, 226, 397, 219, 420, 212, 425, 209, 430, 213, 425, 221, 423, 240, 392, 247"),
      array("name" => "ALLEGANY",  "coords" => "115, 288, 115, 242, 130, 242, 141, 242, 144, 245, 144, 247, 151, 247, 151, 277, 150, 289, 115, 288"),
      array("name" => "BRONX", "coords" => "428, 395, 424, 394, 424, 398, 426, 399, 428, 397, 428, 395"),
      array("name" => "BROOME",  "coords" => "265, 252, 280, 252, 283, 268, 295, 268, 297, 273, 310, 273, 312, 274, 312, 287, 265, 288, 265, 273, 268, 273, 270, 267, 265, 252"),
      array("name" => "CATTARAUGUS",  "coords" => "63, 287, 62, 241, 66, 244, 70, 250, 77, 251, 81, 246, 88, 246, 102, 242, 113, 242, 113, 288, 63, 287"),
      array("name" => "CAYUGA",  "coords" => "221, 168, 226, 160, 227, 175, 235, 175, 234, 194, 237, 198, 238, 212, 246, 212, 251, 219, 252, 222, 252, 231, 227, 231, 224, 226, 221, 222, 221, 168, 225, 161, 221, 168"),
      array("name" => "CHAUTAUQUA",  "coords" => "13, 287, 13, 265, 40, 245, 57, 237, 62, 241, 61, 286, 13, 286"),
      array("name" => "CHEMUNG",  "coords" => "207, 288, 207, 265, 220, 264, 220, 268, 228, 270, 232, 268, 231, 264, 235, 264, 234, 287, 229, 289, 208, 289, 207, 288"),
      array("name" => "CHENANGO",  "coords" => "281, 224, 319, 220, 317, 231, 312, 241, 315, 254, 311, 266, 311, 270, 298, 270, 296, 266, 285, 265, 281, 249, 280, 224, 281, 224"),
      array("name" => "CLINTON",  "coords" => "398, 9, 441, 7, 441, 14, 439, 19, 441, 29, 441, 49, 436, 49, 428, 56, 406, 59, 406, 52, 401, 36, 398, 9"),
      array("name" => "COLUMBIA",  "coords" => "426, 243, 453, 238, 450, 253, 471, 253, 471, 263, 448, 263, 445, 277, 443, 283, 432, 283, 416, 276, 416, 273, 421, 263, 426, 260, 425, 243, 426, 243"),
      array("name" => "CORTLAND",  "coords" => "279, 249, 256, 249, 254, 232, 254, 219, 277, 218, 279, 223, 279, 249"),
      array("name" => "DELAWARE",  "coords" => "314, 286, 313, 270, 312, 270, 312, 266, 313, 259, 334, 253, 340, 245, 352, 241, 362, 241, 367, 251, 378, 255, 373, 266, 377, 271, 357, 286, 332, 301, 327, 300, 319, 287, 314, 287, 314, 286"),
      array("name" => "DUTCHESS",  "coords" => "413, 334, 417, 326, 416, 296, 414, 291, 416, 284, 417, 277, 433, 285, 442, 284, 443, 281, 446, 279, 446, 295, 468, 295, 468, 305, 446, 305, 445, 327, 421, 331, 415, 336, 413, 334"),
      array("name" => "ERIE",  "coords" => "58, 236, 64, 224, 75, 219, 75, 212, 73, 202, 70, 200, 68, 200, 65, 198, 65, 190, 68, 190, 76, 196, 84, 189, 101, 189, 101, 208, 100, 213, 101, 240, 79, 246, 77, 249, 72, 249, 64, 239, 62, 239, 57, 235, 58, 236"),
      array("name" => "ESSEX",  "coords" => "442, 52, 445, 61, 445, 76, 438, 92, 444, 110, 443, 115, 401, 123, 400, 120, 394, 116, 390, 118, 381, 109, 386, 104, 384, 93, 398, 88, 393, 64, 430, 58, 434, 55, 437, 50, 442, 51, 442, 52"),
      array("name" => "FRANKLIN",  "coords" => "352, 11, 396, 9, 400, 40, 407, 59, 390, 63, 395, 87, 382, 91, 364, 92, 367, 86, 357, 14, 353, 13, 352, 11, 358, 11, 352, 11"),
      array("name" => "FULTON",  "coords" => "396, 171, 390, 174, 384, 175, 376, 172, 368, 173, 359, 168, 357, 168, 359, 172, 359, 178, 355, 187, 356, 191, 372, 194, 388, 194, 398, 193, 396, 172, 396, 171"),
      array("name" => "GENESEE",  "coords" => "104, 187, 136, 187, 136, 194, 140, 195, 139, 199, 138, 205, 134, 209, 108, 209, 103, 207, 103, 187, 104, 187"),
      array("name" => "GREENE",  "coords" => "379, 270, 375, 266, 380, 253, 383, 251, 386, 253, 393, 253, 393, 248, 423, 243, 423, 260, 419, 264, 416, 272, 410, 268, 407, 269, 405, 276, 391, 275, 379, 270"),
      array("name" => "HAMILTON",  "coords" => "346, 98, 365, 94, 381, 93, 384, 103, 378, 109, 387, 120, 393, 119, 398, 121, 398, 124, 390, 125, 390, 131, 392, 157, 394, 168, 385, 172, 382, 170, 368, 171, 360, 166, 355, 167, 348, 163, 349, 158, 354, 150, 345, 97, 346, 98"),
      array("name" => "HERKIMER",  "coords" => "326, 98, 330, 101, 342, 98, 350, 149, 345, 163, 355, 169, 357, 176, 352, 188, 354, 193, 353, 203, 355, 205, 355, 207, 350, 204, 345, 205, 346, 209, 345, 210, 332, 204, 327, 208, 326, 207, 323, 191, 333, 175, 327, 171, 331, 166, 332, 156, 325, 98, 326, 98"),
      array("name" => "JEFFERSON",  "coords" => "254, 133, 252, 123, 248, 119, 250, 116, 254, 119, 257, 112, 257, 108, 253, 105, 249, 108, 246, 99, 241, 97, 244, 94, 265, 82, 278, 68, 300, 82, 303, 84, 296, 94, 301, 100, 296, 106, 293, 105, 284, 114, 279, 115, 278, 123, 282, 126, 283, 133, 279, 132, 277, 130, 266, 130, 266, 134, 255, 134, 254, 133"),
      array("name" => "KINGS" /* BROOKLYN */, "coords" => "418, 416, 416, 411, 418, 407, 421, 404, 426, 410, 427, 415, 421, 417, 417, 415, 418, 416"),
      array("name" => "LEWIS",  "coords" => "304, 85, 319, 95, 322, 98, 326, 132, 326, 139, 299, 157, 286, 152, 283, 122, 281, 122, 279, 117, 286, 117, 294, 108, 299, 110, 300, 108, 300, 103, 303, 102, 302, 97, 299, 95, 304, 86, 304, 85"),
      array("name" => "LIVINGSTON",  "coords" => "132, 240, 139, 228, 138, 208, 142, 198, 150, 200, 150, 206, 162, 206, 164, 211, 160, 218, 160, 226, 163, 228, 167, 229, 168, 231, 168, 236, 156, 236, 156, 240, 152, 240, 152, 245, 147, 245, 143, 241, 131, 239, 132, 240"),
      array("name" => "MADISON",  "coords" => "319, 218, 321, 209, 309, 209, 307, 202, 300, 201, 300, 198, 301, 196, 299, 192, 295, 191, 294, 188, 287, 182, 285, 183, 274, 183, 274, 188, 278, 189, 279, 202, 280, 217, 280, 220, 287, 220, 319, 218"),
      array("name" => "MONROE",  "coords" => "134, 166, 150, 169, 158, 173, 166, 179, 170, 174, 177, 172, 177, 189, 175, 191, 177, 193, 169, 194, 169, 201, 162, 203, 152, 203, 152, 198, 141, 198, 141, 194, 138, 192, 138, 185, 133, 185, 134, 166"),
      array("name" => "MONTGOMERY",  "coords" => "356, 193, 373, 196, 399, 195, 400, 197, 390, 210, 385, 211, 379, 214, 376, 214, 357, 207, 357, 204, 355, 202, 357, 193, 356, 193"),
      array("name" => "NASSAU",  "coords" => "356, 193, 373, 196, 399, 195, 400, 197, 390, 210, 385, 211, 379, 214, 376, 214, 357, 207, 357, 204, 355, 202, 357, 193, 356, 193"),
      array("name" => "NEW YORK CITY" /* MANHATTAN */, "coords" => "414, 408, 419, 397, 422, 397, 422, 400, 417, 407, 414, 408"),
      array("name" => "NIAGARA",  "coords" => "66, 173, 87, 166, 100, 164, 100, 187, 83, 188, 75, 194, 69, 189, 65, 189, 63, 187, 63, 186, 66, 184, 66, 173"),
      array("name" => "ONEIDA",  "coords" => "279, 181, 279, 162, 281, 158, 282, 153, 286, 153, 298, 158, 328, 141, 330, 162, 329, 166, 325, 170, 330, 175, 320, 192, 322, 193, 323, 206, 311, 206, 308, 200, 302, 200, 302, 198, 304, 196, 300, 190, 297, 190, 296, 186, 286, 178, 285, 180, 279, 180, 279, 181"),
      array("name" => "ONONDAGA",  "coords" => "238, 177, 248, 177, 251, 179, 257, 178, 257, 175, 265, 181, 272, 180, 273, 183, 270, 188, 271, 189, 275, 191, 276, 192, 276, 206, 276, 216, 254, 218, 247, 210, 239, 210, 239, 197, 237, 194, 238, 178, 238, 177"),
      array("name" => "ONTARIO",  "coords" => "170, 235, 169, 227, 162, 227, 162, 219, 165, 211, 165, 208, 164, 207, 164, 205, 169, 204, 169, 196, 177, 195, 192, 195, 192, 197, 204, 197, 204, 219, 180, 219, 176, 235, 171, 235, 170, 235"),
      array("name" => "ORANGE",  "coords" => "360, 340, 362, 337, 360, 335, 361, 334, 380, 332, 387, 324, 393, 321, 395, 324, 415, 325, 411, 334, 414, 337, 416, 343, 415, 348, 398, 364, 362, 345, 360, 340"),
      array("name" => "ORLEANS",  "coords" => "103, 185, 102, 163, 133, 166, 132, 184, 105, 184, 103, 184, 103, 185"),
      array("name" => "OSWEGO",  "coords" => "255, 136, 268, 136, 267, 133, 276, 133, 282, 135, 284, 151, 280, 151, 276, 163, 277, 181, 274, 181, 273, 179, 264, 177, 258, 173, 255, 172, 255, 175, 247, 175, 239, 175, 238, 173, 230, 173, 230, 164, 229, 159, 230, 156, 234, 156, 236, 153, 239, 149, 242, 149, 246, 152, 253, 149, 255, 141, 254, 136, 255, 136"),
      array("name" => "OTSEGO",  "coords" => "362, 211, 348, 206, 347, 207, 347, 211, 345, 212, 332, 206, 329, 209, 324, 209, 319, 234, 315, 241, 317, 251, 315, 257, 318, 257, 325, 253, 332, 252, 336, 244, 337, 245, 349, 240, 361, 238, 365, 228, 361, 215, 361, 211, 362, 211"),
      array("name" => "PUTNAM",  "coords" => "417, 337, 422, 332, 443, 328, 445, 334, 460, 334, 460, 342, 445, 342, 421, 346, 417, 346, 419, 342, 416, 337, 417, 337"),
      array("name" => "QUEENS", "coords" => "422, 404, 422, 402, 424, 400, 432, 397, 435, 403, 437, 409, 435, 413, 428, 415, 428, 409, 422, 405, 422, 404"),
      array("name" => "RENSSELAER",  "coords" => "433, 198, 447, 195, 455, 197, 458, 217, 481, 217, 481, 229, 456, 229, 454, 235, 426, 241, 425, 226, 431, 212, 431, 203, 433, 198"),
      array("name" => "RICHMOND" /* STATEN ISLAND */, "coords" => "404, 410, 413, 411, 413, 415, 411, 416, 407, 421, 402, 425, 398, 424, 396, 422, 402, 418, 401, 414, 404, 410"),
      array("name" => "ROCKLAND",  "coords" => "376, 377, 423, 377, 423, 363, 418, 358, 416, 350, 400, 364, 403, 366, 375, 366, 375, 376, 376, 377"),
      array("name" => "ST LAWRENCE",  "coords" => "279, 67, 282, 58, 283, 54, 314, 24, 335, 13, 344, 10, 350, 11, 351, 16, 356, 16, 366, 92, 331, 97, 323, 95, 279, 67"),
      array("name" => "SARATOGA",  "coords" => "396, 161, 412, 157, 417, 171, 419, 171, 426, 165, 432, 166, 434, 182, 434, 186, 429, 201, 430, 211, 425, 207, 419, 209, 418, 203, 401, 195, 395, 159, 396, 161"),
      array("name" => "SCHENECTADY",  "coords" => "389, 216, 402, 198, 417, 205, 417, 210, 396, 217, 396, 219, 392, 219, 389, 216"),
      array("name" => "SCHOHARIE",  "coords" => "363, 212, 377, 216, 386, 212, 389, 212, 386, 216, 390, 220, 396, 220, 395, 225, 392, 232, 392, 240, 388, 246, 390, 251, 386, 251, 383, 250, 377, 253, 367, 248, 362, 240, 367, 229, 362, 215, 363, 212"),
      array("name" => "SCHUYLER",  "coords" => "223, 261, 223, 240, 210, 239, 211, 247, 204, 247, 200, 245, 196, 245, 197, 262, 204, 263, 222, 262, 222, 267, 229, 267, 230, 264, 223, 261"),
      array("name" => "SENECA",  "coords" => "207, 197, 209, 196, 219, 196, 219, 225, 225, 232, 229, 238, 224, 239, 215, 238, 211, 238, 208, 228, 205, 226, 206, 197, 207, 197"),
      array("name" => "STEUBEN",  "coords" => "152, 290, 153, 276, 153, 247, 154, 247, 154, 243, 158, 242, 158, 238, 170, 238, 177, 237, 192, 238, 192, 245, 194, 246, 196, 264, 205, 265, 205, 289, 151, 289, 152, 290"),
      array("name" => "SUFFOLK",  "coords" => "452, 387, 452, 384, 454, 383, 457, 384, 461, 382, 469, 385, 474, 383, 474, 378, 476, 378, 480, 380, 512, 374, 524, 364, 527, 364, 534, 356, 537, 360, 527, 367, 528, 370, 515, 380, 521, 382, 532, 369, 535, 371, 545, 368, 545, 372, 561, 362, 563, 365, 563, 369, 511, 396, 480, 406, 462, 409, 459, 407, 452, 386, 452, 387"),
      array("name" => "SULLIVAN",  "coords" => "333, 302, 358, 287, 378, 299, 371, 310, 385, 321, 384, 325, 379, 331, 360, 332, 359, 334, 360, 338, 356, 338, 353, 336, 347, 335, 338, 324, 339, 312, 333, 302"),
      array("name" => "TIOGA",  "coords" => "237, 288, 238, 265, 243, 265, 246, 261, 256, 262, 256, 255, 251, 254, 252, 253, 254, 252, 263, 252, 268, 270, 264, 272, 265, 285, 263, 289, 236, 289, 237, 288"),
      array("name" => "TOMPKINS",  "coords" => "225, 241, 231, 238, 227, 233, 252, 233, 253, 250, 249, 254, 250, 256, 254, 256, 254, 260, 250, 260, 249, 259, 244, 259, 242, 263, 239, 263, 238, 262, 229, 262, 225, 260, 225, 241"),
      array("name" => "ULSTER",  "coords" => "387, 321, 373, 309, 380, 298, 359, 285, 377, 272, 391, 277, 406, 277, 409, 270, 415, 273, 416, 277, 414, 285, 413, 294, 415, 298, 415, 323, 396, 322, 395, 319, 387, 322, 387, 321"),
      array("name" => "WARREN",  "coords" => "392, 127, 439, 119, 436, 130, 427, 142, 431, 163, 425, 163, 419, 168, 413, 154, 394, 158, 392, 148, 392, 127"),
      array("name" => "WASHINGTON",  "coords" => "441, 118, 445, 118, 444, 127, 443, 136, 446, 139, 449, 135, 451, 135, 454, 143, 454, 154, 492, 154, 492, 165, 455, 165, 455, 193, 447, 192, 433, 194, 437, 182, 429, 141, 439, 130, 440, 117, 441, 118"),
      array("name" => "WAYNE",  "coords" => "178, 193, 178, 171, 200, 171, 204, 175, 206, 171, 219, 167, 219, 193, 207, 193, 206, 195, 194, 195, 194, 192, 177, 192, 178, 193"),
      array("name" => "WESTCHESTER",  "coords" => "424, 392, 423, 390, 423, 362, 419, 356, 416, 347, 416, 346, 426, 348, 444, 344, 444, 349, 449, 355, 484, 355, 484, 364, 441, 364, 434, 367, 439, 377, 430, 389, 428, 394, 424, 394, 424, 392"),
      array("name" => "WYOMING",  "coords" => "102, 210, 108, 211, 136, 211, 136, 228, 130, 239, 129, 240, 103, 240, 103, 217, 103, 210, 102, 210"),
      array("name" => "YATES",  "coords" => "178, 235, 181, 222, 183, 221, 203, 221, 203, 227, 208, 238, 209, 246, 205, 246, 200, 243, 196, 244, 194, 243, 194, 236, 178, 234, 178, 235"),
    );
  }
?>