<section class="videos bg-pale-blue">
  <div class="liberty-container">
    <div id="coin-left" class="liberty-coin-left"></div>
    <div class="liberty-coin-right"></div>
    <div class="liberty-coin-center"></div>
    <div class="liberty"></div>
  </div>
  <div class="content">
    <div class="header1 text-dark-blue anim"><?php echo $title; ?></div>
    <p class="body2 text-dark-blue anim"><?php echo $subtitle; ?></p>
    <a href="<?php echo $cta_link; ?>" target="_blank"><button class="btn std anim"><span><?php echo $cta_text; ?></span></button></a>

  </div>
  <div class="video-thumbnail">
    <div class="video-container">
      <img class="video-static" src="<?php echo $video_img_static_url; ?>" />
      <!-- Video sequence is loaded here in JS -->
      <img class="video-sequence hidden-sm hidden-xs" data-url="<?php echo $video_img_anim_url; ?>" src="" />

    </div>
    <div class="video-play-bt">
      <div class="video-play-bt-bg"></div>
      <div class="video-play-bt-icon"></div>
    </div>
    <!--<a href="<?php echo $image_cta_link; ?>"><div class="video-thumb-hitarea"></div></a>-->
    <a id="get-drawn-together-btn" role="button" data-url="<iframe class='get-drawn-vid' width='853' height='480' src='<?php echo $image_cta_link; ?>' frameborder='0' allowfullscreen></iframe>" data-toggle="modal" href="#get-drawn-together-modal" aria-expanded="false" aria-controls="get-drawn-together-modal"></a>

  </div>
</section>

<!-- Get Drawn Together Video Modal -->
<div class="modal" id="get-drawn-together-modal" role="dialog">
  <!-- Modal background -->
  <div class="modal-overlay"></div>

  <div class="modal-content">
    <div class="modal-header">
      <!-- Close Button -->
      <div class="modal-close-bt">
        <div class="close-icon">
          <svg id="close-svg" width="100%" height="100%" viewBox="0 0 26 26">
            <g stroke="#ffffff" stroke-linecap="round" stroke-width="3">
              <line stroke-linecap="round" id="close-l1" x1="2" y1="2" x2="24" y2="24"/>
              <line stroke-linecap="round" id="close-l2" x1="2" y1="24" x2="24" y2="2"/>
            </g>
          </svg>
        </div>
      </div>
      <!-- End Close Button -->
    </div>

    <div class="modal-body">
      <div class="get-drawn-iframe-placeholder"></div>
    </div>
  </div>
  <!--</div>-->
</div>
