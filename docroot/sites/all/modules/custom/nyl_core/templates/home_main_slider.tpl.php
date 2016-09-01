<section class="main slider">
  <?php if (variable_get('nyl_homepage_firstslide_active', 1) != 0) : ?>
  <div class="welcome">
    <div class="confetti-container-static"></div>
    <div class="inner">
      <div class="confetti-container"></div>
      <?php if (variable_get('nyl_homepage_firstslide_banner_active', 1) != 0) : ?>
        <div class="slider-welcome-banner">
          <div class="slider-welcome-banner-side slider-welcome-banner-left">
            <svg viewBox="0 0 40 50">
              <defs>
                <symbol id="slider-welcome-banner-graphic-side">
                  <polygon points="0,0 40,0 40,50 0,50 9,25 0,0" style="fill:#2c84a4;" />
                </symbol>
              </defs>
              <use xlink:href="#slider-welcome-banner-graphic-side" x="0" y="0"/>
            </svg>
          </div>
          <div class="slider-welcome-banner-side slider-welcome-banner-right">
            <svg viewBox="0 0 40 50">
              <use xlink:href="#slider-welcome-banner-graphic-side" x="0" y="0" transform="translate(40 0) scale(-1,1)"/>
            </svg>
          </div>
          <div class="slider-welcome-banner-content">
            <div class="slider-welcome-banner-text"><span><?php print variable_get('nyl_homepage_firstslide_banner_text', 'Welcome to'); ?></span></div>
          </div>
        </div>
      <?php endif; ?>
      <p class="text-dark-blue"><?php print variable_get('nyl_homepage_firstslide_line1', 'The Marvelous New'); ?>
        <span class="larger"><?php print variable_get('nyl_homepage_firstslide_line2', 'New York'); ?></span>
        <?php print variable_get('nyl_homepage_firstslide_line3', 'Lottery Website'); ?></p>
    </div>
  </div>
  <?php endif; ?>

  <?php foreach ($featured_jackpots as $item) : ?>
    <div class="high-jackpot">
      <div class="inner">
        <div class="slider-firecrackers">
          <div class="firecracker firecracker-left">
            <div class="firecracker-money"></div>
            <img class="firecracker-img" src="<?php echo $theme_path; ?>/assets/img/firecracker.svg" />
          </div>
          <div class="firecracker firecracker-left2 hidden-xs">
            <div class="firecracker-money"></div>
            <img class="firecracker-img" src="<?php echo $theme_path; ?>/assets/img/firecracker.svg"/>
          </div>
          <div class="firecracker firecracker-right">
            <div class="firecracker-money"></div>
            <img class="firecracker-img" src="<?php echo $theme_path; ?>/assets/img/firecracker.svg" />
          </div>
          <div class="firecracker firecracker-right2 hidden-sm hidden-xs">
            <div class="firecracker-money"></div>
            <img class="firecracker-img" src="<?php echo $theme_path; ?>/assets/img/firecracker.svg" />
          </div>
          <div class="firecracker firecracker-right3 hidden-sm hidden-xs">
            <div class="firecracker-money"></div>
            <img class="firecracker-img" src="<?php echo $theme_path; ?>/assets/img/firecracker.svg"/>
          </div>
        </div>
        <img src="<?php echo $item['image_path'] ?>" class="logo"/>
        <p class="text-dark-blue"><?php echo $item['title']; ?><br/>
              <span class="jackpot-amount">
                <span>$</span><?php echo $item['jackpot_amount']; ?>
              </span>
          <span class="cardinal"><?php echo $item['cardinal']; ?></span>
        </p>
        <a href="<?php echo $item['jackpot_cta_link']; ?>"><button class="std btn"><span>Where to Play</span></button></a>
      </div>
    </div>
  <?php endforeach ?>
</section>
