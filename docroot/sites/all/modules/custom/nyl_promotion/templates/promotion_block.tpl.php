<?php
 /*
  * available variables in this template
  *
  * $title
  * $cta_text
  * $cta_link
  * $promo1_title
  * $promo1_description
  * $promo1_cta_text
  * $promo1_cta_link
  * $promo1_img_url
  * $promo2_title
  * $promo2_description
  * $promo2_cta_text
  * $promo2_cta_link
  * $promo2_img_url
  */
?>
<section class="promotions">
  <!-- <div class="lighthouse-beam-container"> -->
  <div class="lighthouse-beam">
      <img src="<?php print  base_path() . drupal_get_path('theme', 'nylottery'); ?>/assets/img/lighthouse-beam.svg" viewBox="0 0 1440 330" />
  </div>
  <!--</div>-->
  <div class="lighthouse-container">
    <div class="lighthouse"></div>
  </div>


  <div class="beach">
    <div class="content">
      <div class="header1 text-dark-blue"><?php echo $title; ?></div>
      <div class="header3"><a href="<?php echo $cta_link; ?>" class="view-all text-dark-blue"><?php echo $cta_text; ?></a>
        <span class="glyphicon glyphicon-triangle-right text-teal"></span>
      </div>

      <div class="promo slider-mobile-only">
        <div>
          <div class="inner invisible">
            <img src="<?php echo $promo1_img_url; ?>" class="logo" />
            <div class="subheader2 text-dark-blue"><?php echo $promo1_title; ?></div>
            <p class="body2 text-dark-blue"><?php echo $promo1_description; ?></p>
            <a href="<?php echo $promo1_cta_link; ?>"><button class="btn std"><span><?php echo $promo1_cta_text; ?></span></button></a>
          </div>
        </div>
        <div>
          <div class="inner invisible">
            <img src="<?php echo $promo2_img_url; ?>" class="logo" />
            <div class="subheader2 text-dark-blue"><?php echo $promo2_title; ?></div>
            <p class="body2 text-dark-blue"><?php echo $promo2_description; ?></p>
            <a href="<?php echo $promo2_cta_link; ?>"><button class="btn std"><span><?php echo $promo2_cta_text; ?></span></button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
