<?php
/**
 * Implement hook_preprocess_html
 * @param $variables
 */
function nylottery_preprocess_html(&$vars) {
  $vars['theme_path'] = base_path() . drupal_get_path('theme', 'nylottery');
}

function nylottery_preprocess_node(&$vars) {
  $vars['theme_path'] = $theme_path = base_path() . drupal_get_path('theme', 'nylottery');
}

/**
 * Implement hook_preprocess_page
 */
function nylottery_preprocess_page(&$vars){
  $vars['theme_path'] = $theme_path = base_path() . drupal_get_path('theme', 'nylottery');

  $vars['site_disclaimer'] = variable_get('nyl_site_disclaimer', '');

  if (drupal_is_front_page()) {
    drupal_add_js($theme_path . '/assets/scripts/animation.js', 'file');

    $block_nyl_core_home_main_slider = module_invoke('cool', 'block_view', 'nyl_core_home_main_slider');
    $vars['nyl_core_home_main_slider'] = $block_nyl_core_home_main_slider['content'];

    $block_home_video_settings = module_invoke('cool', 'block_view', 'nyl_core_home_video_campaign');
    $vars['block_home_video_settings'] = $block_home_video_settings['content'];

    $block_featured_legend = module_invoke('cool', 'block_view', 'nyl_ws_featured_legend_home');
    $vars['block_featured_legend'] = $block_featured_legend['content'];

    $block_promotion = module_invoke('cool', 'block_view', 'nyl_promotion_home');
    $vars['block_promotion'] = $block_promotion['content'];
  }
}

/**
 * Implement MYTHEME_links__system_main_menu(),
 * -- https://www.drupal.org/node/1033442#comment-5076932
 */
function nylottery_links__system_main_menu($variables) {

  $theme_path = path_to_theme();
  $logo = theme_image(array(
    'path' => $theme_path .'/assets/img/logo.svg',
    'alt' => 'New York Lottery',
    'attributes' => array('class' => 'nyl-logo'),
  ));

  // mobile header
  $modalHeader = "<div class='navbar-header hidden-md hidden-lg'>"
    . "<a class='navbar-brand pull-right' href='/'>". $logo . '</a>';
  $modalHeader .= <<<EOF
      <button type='button' class='navbar-toggle collapsed pull-left'
              data-toggle='modal' data-target='#navModal'
              aria-expanded='false' aria-controls='navbar'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'>MENU</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <div class='container-dropdown hidden-md hidden-lg'>

        <a id='trayButton' class='tray-button btn collapsed' role='button'
           data-toggle='modal' href='#winning-numbers-modal-sm'
           aria-expanded='false' aria-controls='winning-numbers-modal-sm'>
          <span class='nav-title header3 text-white'>Winning Numbers</span>
          <span
            class='glyphicon glyphicon-triangle-bottom text-yellow hidden-md'></span>
        </a>

      </div>
    </div>
EOF;

  // Desktop has the logo in the center.
  $left = variable_get('nyl_site_main_menu_left', 2);
  $firstHalf = array_slice($variables['links'], 0, $left);
  $lastHalf = array_slice($variables['links'],  $left);


  $navBar = <<<EOF
    <div id='navbar' class='collapse navbar-collapse'>
      <ul class='nav navbar-nav'>
        <li>
          <a id="winning-numbers-btn"
            class="tray-button btn collapsed hidden-xs hidden-sm"
            data-toggle="modal" role="button"
            href="#winning-numbers-modal-lg" aria-expanded="false"
            aria-controls="winning-numbers-modal-lg">
             Winning Numbers
          </a>
        </li>
EOF;
  $subNav = '';
  foreach ($firstHalf as $mlid => $link) {
    if (strtolower($link['title']) == 'ways to play' && module_exists('nyl_ways_to_play')) {
      $navBar .= '<li><a id="ways-to-play-btn" class="ways-to-play" role="button" data-toggle="modal" href="#ways-to-play-modal" aria-expanded="false" aria-controls="ways-to-play">Ways to Play'
                . '  <svg xmlns="http://www.w3.org/2000/svg" class="ways-to-play-icon" height="12" width="12">'
                . '    <rect x="0" y="0" height="33%" width="33%"></rect>'
                . '    <rect x="66%" y="0" height="33%" width="33%"></rect>'
                . '    <rect x="0" y="66%" height="33%" width="33%"></rect>'
                . '    <rect x="66%" y="66%" height="33%" width="33%"></rect>'
                . '  </svg>'
                // . '<span class="glyphicon glyphicon-th-large"> </span>'
                . '</a></li>';
    }
    else {
      $navBar .= "<li>" . l($link['title'], $link['href'], $link) . "</li>";
    }
  }
  $navBar .= "<li class='hidden-xs nyl-logo'><a href='/'>". $logo ."</a></li>";
  foreach ($lastHalf as $link) {
    if (strtolower($link['title']) == 'search') {
      $text = "<span class='glyphicon glyphicon-search'></span>";
      $link['html'] = TRUE;
      $navBar .= "<li>" . l($text, $link['href'], $link) . "</li>";
    }
    else {
      $navBar .= "<li>" . l($link['title'], $link['href'], $link) . "</li>";
    }
  }
  $navBar .= "</ul></div><!--/.nav-collapse -->";


  $navModal = "<!-- Modal -->"
    ."<div class='modal nav-modal' id='navModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>"
    ."  <div class='nav-bg'><div class='nav-bg-yellow'></div><div class='nav-bg-orange'></div><div class='nav-bg-red'></div></div>"
    ."  <div class='modal-dialog' role='document'>
          <button class='close-bt' data-toggle='modal' data-target='#navModal'
                  aria-expanded='false' aria-controls='navbar'>X
          </button>"
      ."  <div class='modal-nav-content'>
            <div class='modal-nav-body'>
              <ul class='nav navbar-nav'>";
  foreach ($variables['links'] as $link) {
    $navModal .= "<li>".l($link['title'], $link['href'], $link)."</li>";
  }
  $navModal .= "</ul>
          </div> <!--/.modal-nav-body -->
        </div> <!--/.modal-nav-content -->
      </div> <!--/.modal-dialog -->
    </div><!--/.nav-modal -->
  ";

  return $modalHeader . $navBar . $navModal;
}