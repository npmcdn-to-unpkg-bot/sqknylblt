<script type="text/javascript">

  (function ($) {

    $(document).on('ready', function () {
      $('.slider').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 1800,
        speed: 1800,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnFocus: true,
        pauseOnHover: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 782,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });

      /* For some reason, even though Slick supports responsive settings, it doesn't reinitialize it below 768px. */
      var toggleMobileOnlySlider = function () {
        var $mobileOnlySlider = $('.slider-mobile-only');

        if ($(window).width() < 768 && !$mobileOnlySlider.hasClass('slick-initialized')) {
          $mobileOnlySlider.slick({
            dots: true,
            infinite: true,
            autoplay: true,
            speed: 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnFocus: true,
            pauseOnHover: true,
            mobileFirst: true,
            responsive: [
              {
                breakpoint: 768,
                settings: "unslick",
              },
              {
                breakpoint: 0,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
            ]
          });
        }
      };

      toggleMobileOnlySlider();
      $(window).on('resize', toggleMobileOnlySlider);

      $('.nys-nav-top .toggle').on('click', function () {
        $(this).closest('.nys-nav-top').toggleClass('open');
      });
    });

  })(jQuery);

</script>

<style type="text/css">
  .st0 {
    fill-rule: evenodd;
    clip-rule: evenodd;
    fill: #EE3D42;
  }

  .st1 {
    fill-rule: evenodd;
    clip-rule: evenodd;
    fill: #F3793E;
  }

  .st2 {
    fill-rule: evenodd;
    clip-rule: evenodd;
    fill: #FFDF1B;
  }

  ul.text-yellow li a {
    color: #FFDF1B;
  }
</style>

<div class="home page" id="homepage">

  <header>
    <?php print $messages; ?>

    <?php if ($main_menu):  ?>
      <div class="navbar">
        <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
      </div> <!-- /.navbar -->
    <?php endif; ?>

    <!-- Main Slider block start. -->
    <?php echo render($nyl_core_home_main_slider); ?>
    <!-- Main Slider block ends. -->
    
  </header>

  <!-- Promotion block start. -->
  <?php echo render($block_promotion); ?>
  <!-- Promotion block ends. -->

  <section class="game-match bg-lottery-blue">
    <div class="container no-padding" id="content">
      <div class="col-sm-5 col-lg-6 inner">
        <div class="header1 text-white anim">The Game Changer</div>
        <p class="body2 text-white anim">Can't decide which Lottery game is for you? Take this quiz for a spin.</p>
        <button class="btn std anim"><span>Find My Game</span></button>
      </div>

      <div class="spinner">
        <div class="game-wheel"></div>
        <div class="game-wheel-arrow-heart"></div>
      </div>
    </div>
  </section>

  <div id="square1" class="square-left">
    <div class="white right-brush"></div>
  </div>

  <!-- Featured Legend block start. -->
  <?php echo render($block_featured_legend); ?>
  <!-- Featured Legend block ends. -->

    <div id="square2" class="square-right">
        <div id="paint-drips-container">
            <div class="paint-drip1">
                <svg width="30px" height="36px" viewbox="0 0 40 40" preserveAspectRatio="none">
                    <defs>
                        <symbol id="paint-drip">
                            <path class="tear" d="M15 6 Q 15 6, 25 18 A 12.8 12.8 0 1 1 5 18 Q 15 6 15 6"/>
                        </symbol>
                    </defs>
                    <use xlink:href="#paint-drip" x="0" y="0" fill="#ee3d42"/>
                </svg>
            </div>

            <div class="paint-drip2">
                <svg width="26px" height="32px" viewbox="0 0 40 40" preserveAspectRatio="none">
                    <use xlink:href="#paint-drip" x="0" y="0" fill="#f3793e"/>
                </svg>
            </div>

            <div class="paint-drip3">
                <svg width="21px" height="27px" viewbox="0 0 40 40" preserveAspectRatio="none">
                    <use xlink:href="#paint-drip" x="0" y="0" fill="#ffdf1b"/>
                </svg>
            </div>
        </div>
        <div class="white left-brush"></div>
    </div>

  <!-- block home video settings start. -->
  <?php echo render($block_home_video_settings); ?>
  <!-- block home video settings end. -->

  <footer class="footer">
    <?php if (!empty($page['footer'])): ?>
      <?php print render($page['footer']); ?>
    <?php endif; ?>
  </footer>
  
</div>

