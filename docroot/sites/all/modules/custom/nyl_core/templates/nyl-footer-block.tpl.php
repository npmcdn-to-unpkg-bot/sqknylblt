<?php
/**
 * @file
 * Contains nyl-footer-block.tpl.php
 * - $menu
 * - $site_disclaimer
 */
?>
<!-- footer -->
  <section class="ny-lottery container">
    <div class="newsletter">
      <h3 class="text-white">Get the inside scoop with<br />the NY Lottery newsletter.</h3>
      <form action="http://www.playnylottery.net/homepage.pl" method="POST">
        <div class="form-item">
          <input type="email" placeholder="Enter email address" data-validation="email" id="email" name="email"/>
        </div>
        <button class="btn std"><span><input type="submit" value="Sign me up" /></span></button>
      </form>
    </div>

    <div class="get-app">
      <h4 class="text-white">We fit in any pocket. Get the app.</h4>
      <a href="https://itunes.apple.com/us/app/ny-lottery/id577471940?mt=8" class="apple-app-store" target="_blank"></a>
      <a href='https://play.google.com/store/apps/details?id=air.com.eprize.nylottery.app.NYLotteryApp' class="google-play" target="_blank"></a>
    </div>

    <div class="social">
      <h4 class="text-white">Find us on social media.</h4>
      <a class="twitter" href="https://twitter.com/newyorklottery" target="_blank"></a>
      <a class="facebook" href="https://www.facebook.com/nyslotto/" target="_blank"></a>
      <a class="instagram" href="https://www.instagram.com/ny_lottery/" target="_blank"></a>
      <a class="youtube" href="https://www.youtube.com/user/NewYorkLottery"  target="_blank"></a>
    </div>

    <nav>
      <?php
      $footer_menu_name = 'menu-footer';
      print theme('links', array('links' => menu_navigation_links($footer_menu_name), 'attributes' => array('id' => $footer_menu_name, 'class'=> array('text-yellow'))));
      ?>
    </nav>

    <div class="copyright text-white">
      <?php print nl2br(t($site_disclaimer)); ?>
    </div>
  </section>

<!-- /footer  -->

<?php  // Winning Number overlay
  if (module_exists('nyl_winning_numbers')) {
    $winning_numbers = module_invoke('nyl_winning_numbers', 'block_view', 'nyl_winning_numbers_block');
    print render($winning_numbers['content']);
  }
?>
<?php // Ways to play overlay
  if (!module_exists('ways_to_play')) {
    print theme('ways_to_play_subnav', array('menu' => $menu));
  }
?>