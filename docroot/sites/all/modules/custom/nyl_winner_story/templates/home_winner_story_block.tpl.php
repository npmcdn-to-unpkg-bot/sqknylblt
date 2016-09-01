<section class="lottery-legends bg-white">
  <div class="content wide container">

    <div class="col-sm-6">
      <div class="frame anim">
        <img src="<?php echo $image_path; ?>"/>
        <div class="legends-pic-frame">
          <div class="legends-pic-glare"></div>
        </div>
      </div>
      <div class="plaque anim">
        <div class="inner">
          <div class="header3 text-gold">
            <?php echo $name; ?>
          </div>
          <div class="detail1 text-gold">
            <?php echo $amount; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 lottery-content">
      <div class="header1 text-dark-blue anim"><?php echo $title; ?></div>
      <p class="body2 text-dark-blue anim"><?php echo $subtitle; ?></p>
      <a href="<?php echo $cta_link; ?>"><button class="btn std anim"><span><?php echo $cta_text; ?></span></button></a>
    </div>
  </div>
</section>