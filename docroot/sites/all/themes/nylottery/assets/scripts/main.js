(function ($) {

    /*jshint sub:true*/

    $(document).ready(init);

//MAIN INITIALIZE FUNCTION CALLED WHEN THE PAGE IS LOADED
    function init(){
        var $modalObjWinningNumbersLg;
        var $modalObjWinningNumbersSm;
        var $modalObjWaysToPlay;
        var getDrawnVidLoaded = false;

        //bind click to winning numbers button
        $('#winning-numbers-btn').on('click', function(e){
            //contentPiece defines what should be faded in on the modal
            var $contentPiece = $("#winning-numbers-modal-lg").find(".modal-body").find(".winning-numbers-table-dsk").find("td").find(".winning-numbers-content");

            $modalObjWinningNumbersLg =  new modalInit(this,$contentPiece);
            $(".slider").slick('slickPause');
        });

        //bind click to winning numbers button mobile (small)
        $('#trayButton').on('click', function(e){
            $modalObjWinningNumbersSm =  new modalSmInit(this);
            $(".slider").slick('slickPause');
        });


        //bind click to ways to play button mobile (small)
        $('#ways-to-play-btn').on('click', function(e){
            //contentPiece defines what should be faded in on the modal
            var $contentPiece1 = $("#ways-to-play-modal").find(".modal-body").find(".games").find(".col-md-3");

            var $contentPiece2 = $("#ways-to-play-modal").find(".modal-body").find(".more-ways").find(".col-md-3");

            $modalObjWaysToPlay =  new modalInit(this,$contentPiece1,$contentPiece2);
            $(".slider").slick('slickPause');
        });


        //nav
        $(".navbar-toggle").on('click', function(e){
            navBgIn();
            $(".slider").slick('slickPause');
        });

        //main slider
        $('.slider').on('init', function () {
            $(this).css('visibility', 'visible');
        });

        $('.slider').slick({
            dots: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 6000,
            speed: 600,
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
        var toggleMobileOnlySlider = function() {
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
                            settings: "unslick"
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

        $('.nys-nav-top .toggle').on('click', function() {
            $(this).closest('.nys-nav-top').toggleClass('open');
        });

        //welcome banner animation
        if($(window).width() > 480){
            welcomeBanner(0.5);
            confettiMaker(0.8);
        }

        //listen for slider change and replay animations
        $('.slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
            if(nextSlide === 0){
                if($(window).width() > 480){
                    welcomeBanner(0.5);
                }
            }

            if(currentSlide === 0){
                killConfetti();
            }
            else if(currentSlide == 1){
                killFirecrackers();
            }
        });

        $('.slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
            if(currentSlide === 0){
                if($(window).width() > 480){
                    confettiMaker(0.5);
                }
            }
            else if(currentSlide == 1){
                if($(window).width() > 480){
                    firecrackerPop();
                }
            }
        });

        //animate lighthouse when it is reached
        var lighthouseTriggered = false;
        $('.promotions').waypoint(function(){
            if(!lighthouseTriggered) {
                lighthouse();
            }
            lighthouseTriggered = true;
        },{offset:'90%'});

        $('.promotions').waypoint(function(){
            killConfetti();
            killFirecrackers();
            $(".slider").slick('slickPause');
        });


        if ($(window).width() > 480) {
            $('.promo').waypoint(function(){
                animatePromo();
                this.destroy();
            },{offset:'60%'});
        }
        else{
            removePromoAnimation();
        }

        //animate game wheel when section is reached

        var gameMatchTriggered = false;
        $('.game-match').waypoint(function(){
            if(!gameMatchTriggered) {
                spinGameWheel();
            }
            gameMatchTriggered = true;
        },{offset:'40%'});

        //animate legends picture frame glare
        if ($(window).width() > 480) {
            legendsFrameGlare();
        }
        else{

        }

        //paint roller1
        var paintRoll1Triggered = false;
        $('.game-match').waypoint(function(){
            if(!paintRoll1Triggered) {
                paintRoll1();
            }
            paintRoll1Triggered = true;
        },{offset:'0%'});

        //paint roller2
        var paintRoll2Triggered = false;
        $('.lottery-legends').waypoint(function(){
            if(!paintRoll2Triggered) {
                paintRoll2();
                paintDrops();
            }
            paintRoll2Triggered = true;
        });

        //statue of liberty
        var libertyTriggered = false;
        $('.videos').waypoint(function(){
            if(!libertyTriggered) {
                liberty();
            }
            libertyTriggered = true;
        },{offset:'50%'});

        //load video sequence on desktops once user starts scrolling
        var firstScroll = false;
        if ($(window).width() > 992) {
            var loadVidInterval = setInterval(checkScroll,1);
        }

        function checkScroll(){
            if(!firstScroll){
                var scroll = $(window).scrollTop();
                if (scroll > 0){
                    loadVideoSequence();
                    firstScroll = true;
                    clearInterval(loadVidInterval);
                }
            }
        }

        activateVideo(getDrawnVidLoaded);

        //Fade up animation for titles
        $mainDiv = $("div.page");

        $section = $mainDiv.children("section");
        $section.each(function(index) {
            var $curSec = $(this);

            if ($(window).width() > 480) {
                $(this).waypoint(function(){
                    if($curSec.find(".anim").length){
                        animateHeader($curSec);
                    }
                    this.destroy();
                },{offset:'60%'});
            }
            else{
                if($curSec.find(".anim").length){
                    removeHeaderAnimation($curSec);
                }
            }
        });


        //detect window size
        $(window).on('resize', function(){
            //check if desktop modal is on
            if ($(window).width() < 992) {
                var $modalDesktop = $("#winning-numbers-modal-lg");
                if($modalDesktop.css('display') != 'none'){
                    $modalObjWinningNumbersLg.killModal();
                    $modalObjWinningNumbersLg = null;

                    $('#trayButton').trigger("click");
                }
            }
            else{
            var $modalMobile = $("#winning-numbers-modal-sm");
            if($modalMobile.css('display') != 'none'){
                $modalObjWinningNumbersSm.killModal();
                $modalObjWinningNumbersSm = null;

                $('#winning-numbers-btn').trigger("click");
            }
        }
        });

    }

//Animates strpes when nav is clicked in mobile
    function navBgIn(){
        var $navModal = $("#navModal");
        var $yellow = $(".nav-bg-yellow");
        var $orange = $(".nav-bg-orange");
        var $red = $(".nav-bg-red");
        var $closeBt = $("#navModal").find(".close-bt");

        $("body").css("overflowY","hidden");

        //kill the confetti and firecracker animations on the main slider
        killConfetti();
        killFirecrackers();
        hideStateNav();

        var tl = new TimelineMax();
        tl.from($closeBt,0.3,{scaleY: 0, transformOrigin:"center center",ease: Bounce.easeOut,delay:0.8},0);

        tl.from($yellow,1.3,{x: -$(window).width() * 3, y: -$(window).height()*3,ease: Power4.easeOut},0);

        tl.from($orange,0.4,{x: $(window).width(), y: -$(window).height(),ease: Power4.easeOut},0.3);

        tl.from($red,0.4,{x:-$(window).width(),y:$(window).height(),ease: Power4.easeOut},0.5);

        //animate in nav links
        var $links = $navModal.find(".nav").find("a");

        $links.each(function(index) {
            var del = index * 0.1;
            TweenMax.from(this,0.3,{opacity:0,delay: 0.4 + 0.2 + del});
            TweenMax.from(this,0.3,{top:"+=50",delay: 0.4 + 0.2 + del,ease: Back.easeOut});
        });

        $closeBt.on('click', function(e){
            killModal();
            showStateNav();
        });


        function killModal(){
            $closeBt.unbind();

            $("body").css("overflowY","auto");

            //kill any link tweens
            $links.each(function(index) {
                TweenMax.killTweensOf(this);
            });

            tl.stop();
            tl.kill();

            //clear all properties
            clearTweenedProps();
            $( document.activeElement ).blur();
            $(".slider").slick('slickPlay');
        }

        function clearTweenedProps(){
            TweenMax.set($yellow, { clearProps: "all" });
            TweenMax.set($orange, { clearProps: "all" });
            TweenMax.set($red, { clearProps: "all" });
        }
    }
    
    function hideStateNav() {
       $('#nygov-universal-navigation').addClass('hide');
    }



   function showStateNav() {
       $('#nygov-universal-navigation').removeClass('hide');
   }

//Animates the welcome banner in
    function welcomeBanner(initDelay){
        if(initDelay===undefined){
            initDelay=0;
        }
        //Expand main part of the banner. Animate the sides of the banner (they slide from the middle to either side and expand)
        var sideDelay = 0.4 + initDelay;

        var $bannerContent = $('.slider-welcome-banner-content');
        var $bannerLeft = $('.slider-welcome-banner-left');
        var $bannerRight = $('.slider-welcome-banner-right');

        var tl = new TimelineMax({onComplete:clear});
        tl.set($bannerContent,{z:0.01});
        tl.set($bannerLeft,{z:0.01});
        tl.set($bannerRight,{z:0.01});
        tl.from($bannerContent,0.5, {width:"0rem",z:0.01,ease:Back.easeOut,delay:0.2 + initDelay},0);
        tl.from($bannerLeft,0.5,{scaleX:0,z:0.01,x:70,ease:Back.easeOut,delay:sideDelay},0);
        tl.from($bannerRight,0.5,{scaleX:0,z:0.01,x: -70,ease:Back.easeOut,delay:sideDelay},0);

        function clear(){
            TweenMax.set($bannerContent, {clearProps:"all"});
            TweenMax.set($bannerLeft, {clearProps:"all"});
            TweenMax.set($bannerRight, {clearProps:"all"});
        }
    }

//Explodes money out of firecrackers for slide 2
    function firecrackerPop(){
        var $firecrackerLeftMoney = $(".firecracker-left").find(".firecracker-money");
        var $firecrackerImgLeft = $(".firecracker-left").find(".firecracker-img");

        var $firecrackerLeftMoney2 = $(".firecracker-left2").find(".firecracker-money");
        var $firecrackerImgLeft2 = $(".firecracker-left2").find(".firecracker-img");

        var $firecrackerRightMoney = $(".firecracker-right").find(".firecracker-money");
        var $firecrackerImgRight = $(".firecracker-right").find(".firecracker-img");

        var $firecrackerRightMoney2 = $(".firecracker-right2").find(".firecracker-money");
        var $firecrackerImgRight2 = $(".firecracker-right2").find(".firecracker-img");

        var $firecrackerRightMoney3 = $(".firecracker-right3").find(".firecracker-money");
        var $firecrackerImgRight3 = $(".firecracker-right3").find(".firecracker-img");

        var numCoins = 4;
        var numDollars = 3;

         /*if ($(window).width() < 768) {
             numCoins = 3;
             numDollars = 2;
        }*/

        var CoinExplode = function(side, $coin, $coinInner){
            var explodeY = -((Math.random() * 130) + 10);
            var explodeX = (Math.random() * 130) + 10;
            var finY = Math.random()*180 + 120;
            var finX = (Math.random()*20) + 10;
            var speed = (Math.random() * 0.6) + 0.6;

            if(side=="left"){
                explodeX = -explodeX;
                finX = -finX;
            }

            var tl = new TimelineMax();

            tl.set($coin,{css:{display: "block"}},0);
            tl.to($coinInner,speed,{y:explodeY,x:explodeX,z:0.01,ease: Power4.easeOut},0);

            tl.to($coin,speed+0.1,{y:finY, x:finX,z:0.01, opacity: 0,ease: Power4.easeIn},0);
        };

        var DollarExplode = function(side, $dollar, $dollarInner){
            var w = Math.random()*1 + 2;
            var initRot = Math.random() * 359 + 1;
            var explodeY = -((Math.random() * 100) + 50);
            var explodeX = (Math.random() * 100) + 50;
            var finY = Math.random()*180 + 120;
            var finX = (Math.random()*20) + 10;
            var finRot = Math.random() * 20 + 30;
            var speed = (Math.random() * 0.6) + 0.6;
            var speed2 = (Math.random() * 1) + 0.6;
            var totalCycles = 2;
            var curCycle = 1;

            if(side=="left"){
                explodeX = -explodeX;
                finX = -finX;
            }

            var posNeg = Math.round(Math.random() * 1);

            if(posNeg == 1){
                finRot = -finRot;
            }

            var tl = new TimelineMax();

            tl.set($dollar,{css:{display: "block"}},0);
            tl.set($dollarInner,{css:{rotation: initRot}},0);

            tl.to($dollarInner,speed,{width: w + "rem", height: w + "rem" ,x:explodeX, y:explodeY,z:0.01,ease: Power4.easeOut},0);

            tl.to($dollarInner,speed*3,{css:{rotation: finRot},ease: Linear.easeNone},0);

            tl.to($dollar,speed*3,{css:{rotation: finRot},z:0.01, ease: Back.easeOut},0);

            tl.to($dollar,speed*2,{y:finY, x:finX, opacity: 0,ease: Power4.easeIn, onComplete: resetDisplay},0);

            function resetDisplay(){
                tl.set($dollar,{css:{display: "none"}});
            }
        };

        function createCoinExplosion($firecracker,side,childNum){
            $firecracker.append(
                "<div class='coin'><div class='coin-inner'></div></div>"
            );

            var $curCoin = $firecracker.find(".coin:nth-child(" + (childNum+1) + ")");
            var $curCoinInner = $curCoin.children(".coin-inner");

            var coinExplosion = new CoinExplode(side, $curCoin,$curCoinInner);
        }

        function createDollarExplosion($firecracker,side,childNum){
            $firecracker.append(
                "<div class='dollar'><div class='dollar-inner'></div></div>"
            );

            var $curDollar = $firecracker.find(".dollar:nth-child(" + (childNum+1) + ")");

            var $curDollarInner = $curDollar.children(".dollar-inner");

            var dollarExplosion = new DollarExplode(side, $curDollar,$curDollarInner);
        }

        //shoot each firecracker up from bottom
        var tl = new TimelineMax();
        tl.set($firecrackerImgLeft,{css:{visibility:"visible"}},0);
        tl.from($firecrackerImgLeft, 0.7,{y:400,ease: Power2.easeOut,onComplete:explode,onCompleteParams:[$firecrackerImgLeft,$firecrackerLeftMoney,"left"]},0);

        tl.set($firecrackerImgLeft2,{css:{visibility:"visible"},delay:1.4},0);
        tl.from($firecrackerImgLeft2, 1,{y:400,ease: Power2.easeOut,delay:1.4,onComplete:explode,onCompleteParams:[$firecrackerImgLeft2,$firecrackerLeftMoney2,"left"]},0);

        tl.set($firecrackerImgRight,{css:{visibility:"visible"},delay:0.3},0);
        tl.from($firecrackerImgRight, 1,{y:400,ease: Power2.easeOut,delay:0.3,onComplete:explode,onCompleteParams:[$firecrackerImgRight,$firecrackerRightMoney,"right"]},0);

        tl.set($firecrackerImgRight2,{css:{visibility:"visible"},delay:1},0);
        tl.from($firecrackerImgRight2, 1,{y:400,ease: Power2.easeOut,delay:1,onComplete:explode,onCompleteParams:[$firecrackerImgRight2,$firecrackerRightMoney2,"right"]},0);

        tl.set($firecrackerImgRight3,{css:{visibility:"visible"},delay:1.9},0);
        tl.from($firecrackerImgRight3, 0.8,{y:400,ease: Power2.easeOut,delay:1.9,onComplete:explode,onCompleteParams:[$firecrackerImgRight3,$firecrackerRightMoney3,"right"]},0);

        function explode($img,$obj,dir){
            for(i = 0; i< numCoins; i++){
                createCoinExplosion($obj,dir,i);
            }

            for(i = 0; i< numDollars; i++){
                createDollarExplosion($obj,dir,numCoins + i);
            }

            TweenMax.to($img,1,{y:500,x:100,opacity:0,ease:Power2.easeIn,onComplete:resetFirecracker,onCompleteParams:[$img]});
        }

        function resetFirecracker($obj){
            TweenMax.killTweensOf($obj);
            TweenMax.set($obj,{clearProps:"all"});
        }
    }

    function killFirecrackers(){
        var $firecrackerLeftMoney = $(".firecracker-left").find(".firecracker-money");
        var $firecrackerImgLeft = $(".firecracker-left").find(".firecracker-img");

        var $firecrackerLeftMoney2 = $(".firecracker-left2").find(".firecracker-money");
        var $firecrackerImgLeft2 = $(".firecracker-left2").find(".firecracker-img");

        var $firecrackerRightMoney = $(".firecracker-right").find(".firecracker-money");
        var $firecrackerImgRight = $(".firecracker-right").find(".firecracker-img");

        var $firecrackerRightMoney2 = $(".firecracker-right2").find(".firecracker-money");
        var $firecrackerImgRight2 = $(".firecracker-right2").find(".firecracker-img");

        var $firecrackerRightMoney3 = $(".firecracker-right3").find(".firecracker-money");
        var $firecrackerImgRight3 = $(".firecracker-right3").find(".firecracker-img");

        TweenMax.killTweensOf($firecrackerLeftMoney);
        TweenMax.set($firecrackerLeftMoney, {clearProps:"all"});
        TweenMax.killTweensOf($firecrackerImgLeft);
        TweenMax.set($firecrackerImgLeft, {clearProps:"all"});
        $firecrackerLeftMoney.empty();

        TweenMax.killTweensOf($firecrackerLeftMoney2);
        TweenMax.set($firecrackerLeftMoney2, {clearProps:"all"});
        TweenMax.killTweensOf($firecrackerImgLeft2);
        TweenMax.set($firecrackerImgLeft2, {clearProps:"all"});
        $firecrackerLeftMoney2.empty();

        TweenMax.killTweensOf($firecrackerRightMoney);
        TweenMax.set($firecrackerRightMoney, {clearProps:"all"});
        TweenMax.killTweensOf($firecrackerImgRight);
        TweenMax.set($firecrackerImgRight, {clearProps:"all"});
        $firecrackerRightMoney.empty();

        TweenMax.killTweensOf($firecrackerRightMoney2);
        TweenMax.set($firecrackerRightMoney2, {clearProps:"all"});
        TweenMax.killTweensOf($firecrackerImgRight2);
        TweenMax.set($firecrackerImgRight2, {clearProps:"all"});
        $firecrackerRightMoney2.empty();

        TweenMax.killTweensOf($firecrackerRightMoney3);
        TweenMax.set($firecrackerRightMoney3, {clearProps:"all"});
        TweenMax.killTweensOf($firecrackerImgRight3);
        TweenMax.set($firecrackerImgRight3, {clearProps:"all"});
        $firecrackerRightMoney3.empty();

    }

//Raises the lighthouse and then display the rainbow light beam
    function lighthouse(){
        var $lighthouse = $('.lighthouse');
        var height = $lighthouse.height();
        var raiseIncrement = 34;
        var numIncrements = Math.round(height/raiseIncrement);
        var steps = Math.round(numIncrements/3);

        //show the lighthouse
        $lighthouse.toggle();
        TweenMax.from($lighthouse,2, {top:"100%",ease: SteppedEase.config(steps),onComplete:showBeam});

        //Beam is done with CSS tranisition
        function showBeam(){
            $beam = $(".lighthouse-beam");
            $beam.addClass('grow-beam');
            TweenMax.set($lighthouse,{clearProps: "top"});
        }

    }

//spin the game wheel
    function spinGameWheel(){
        var $wheel = $(".game-match").find(".spinner").find(".game-wheel");

        TweenMax.to($wheel,2.5,{rotation: 360,ease:Back.easeInOut});
    }

//Passes a glare across the picture frame (legends section)
    function legendsFrameGlare(){
        var $legendsPicGlare = $(".legends-pic-glare");
        var finalX = $(".legends-pic-frame").width();

        //move glare across frame (fades in and out and moves left to right)
        var tl = new TimelineMax({repeat:-1, repeatDelay:1.6});
        tl.to($legendsPicGlare, 3.5, {left:finalX});
        tl.to($legendsPicGlare, 1, {opacity:1},0);
        tl.to($legendsPicGlare, 1, {opacity:0},1.7);
    }

//Activates the first paint roller animation
    function paintRoll1(){
        var $square1 = $('#square1');
        TweenMax.set($square1,{opacity:1});
        $square1.addClass('ani1');
    }

//Activates the second paint roller animation
    function paintRoll2(){
        var $square2 = $('#square2');
        TweenMax.set($square2,{opacity:1});
        $square2.addClass('ani');
        $('.left-brush').addClass('left-brush-done');
    }

//Paint drops fall from the paint roller
    function paintDrops(){
        var $p1 = $(".paint-drip1");
        var p1Y = $p1.position().top;
        var $p2 = $(".paint-drip2");
        var p2Y = $p2.position().top;
        var $p3 = $(".paint-drip3");
        var p3Y = $p3.position().top;

        //have paint drip an arbitary amount and then dissapear
        TweenMax.set($p1,{scaleX:0.1,scaleY:0.1});
        TweenMax.set($p2,{scaleX:0.1,scaleY:0.1});
        TweenMax.set($p3,{scaleX:0.1,scaleY:0.1});
        TweenMax.set($("#paint-drips-container"),{opacity:1,delay:3.5});

        var tl = new TimelineMax({repeat:1,delay:3.5});
        tl.to($p1,1.9,{y:p1Y + 300,ease: Sine.easeIn,delay:1.1});
        tl.to($p1,1,{scaleX:1,scaleY:1,ease:Sine.easeOut, delay:0.3},0);
        tl.to($p1,0.6,{opacity:0, delay:2.5},0);

        tl.to($p2,1.6,{y:p2Y + 275,ease: Sine.easeIn, delay:0.9},0);
        tl.to($p2,1,{scaleX:1,scaleY:1,ease:Sine.easeOut,delay:0.2},0);
        tl.to($p2,0.6,{opacity:0, delay:2},0);

        tl.to($p3,1.5,{y:p3Y + 134,ease: Sine.easeIn,delay:0.4},0);
        tl.to($p3,0.6,{scaleX:1,scaleY:1,ease:Sine.easeOut},0);
        tl.to($p3,0.6,{opacity:0, delay:1.5},0);

    }

//Confetti burst for the welcome slide
    function confettiMaker(initDelay){
        var max = 40;
        var $confettiContainer = $(".confetti-container");
        var colors = ["#ec3d48", "#00b8ff", "#7d5fa7", "#ffe700","#00b515"];
        var $curConfetti;
        var xCo;
        var yCo;
        var maxWidth = $(window).width();
        var randomColor;
        var speed;
        var mainHeight = $(".main").height();
        var finContainerY = $(window).height() + 300;
        var finSpeed = 9;

        killConfetti();

        if(initDelay === undefined){
            initDelay = 0;
        }

        //determine aspect ratio, adjust finalY of confettit container, affects fall speed of confetti)
        if($(window).width() < $(window).height()){
            finContainerY = mainHeight + 300;
            finSpeed = 8;
        }

        for(i=0;i<max;i++){
            $confettiContainer.append(
                "<div class='confetti'><div class='confetti-inner'></div></div>"
            );
            xCo = (Math.random() * maxWidth) - maxWidth/2;
            finX = (Math.random()* 100) + 100;
            posNeg = Math.round(Math.random() * 1);
            if(posNeg === 0){
                finX = xCo - finX;
            }
            else{
                finX = xCo + finX;
            }

             yCo = (Math.random() * mainHeight) + 10;

            $curConfetti = $confettiContainer.children().eq(i);
            $curConfettiInner = $curConfetti.children(".confetti-inner");
            randomColor = Math.floor(Math.random() * colors.length);
            speed = (Math.random() * (finSpeed*0.11)) + (finSpeed*0.22);
            fallSpeed = (Math.random() * (finSpeed*0.33)) + (finSpeed*0.33);
            //w = (Math.random() * 20) + 6;
            w = (Math.random()*1) + 0.5;
            h = w*2;
            initR = Math.random() * 360;
            midR = Math.random() * 360 + 40;
            newR = initR + (Math.random()*80) + 50;
            initScX = (Math.random() * 0.5) + 0.5;
            initScY = -((Math.random() * 0.5) + 0.5);
            scX = (Math.random() * 0.5) + 0.5;
            scY = -((Math.random() *0.5) + 0.5);
            del = Math.random() * 0.4;
            innerOffset = Math.random()*2 + 1;

            $curConfettiInner.css({"background-color" : colors[randomColor],
                "top" : innerOffset + "em",
                "left" : innerOffset + "em"});

            TweenMax.set($curConfetti,{width:$curConfetti.width()*w,
                height:$curConfetti.width()*(w*2),
                left: "50%",
                rotation:initR,
                scaleX:initScX
            });

            var tl = new TimelineMax();
            tl.to($curConfetti,speed,{display:"block",x:xCo,      y:yCo,

                scaleX: scX,
                scaleY: scY,
                ease: Expo.easeOut,
                //rotation: initR - midR,
                delay:1 + initDelay});
            tl.to($curConfetti,fallSpeed + (0.4 + speed),{rotation:initR-midR,delay:1 + initDelay,ease:Back.easeOut},0);
            tl.to($curConfetti,fallSpeed,{
                x:finX,
                //rotation:(initR - midR)-newR,
                delay:0.4 + speed + initDelay,
                ease: Power1.easeInOut},0);
        }

        TweenMax.to($confettiContainer,finSpeed,{y:finContainerY,delay:1.2 + initDelay,ease: Power0.easeNone,onComplete:killConfetti},0);
    }


//Get rid of the confetti
    function killConfetti(){
        var $confettiContainer = $(".confetti-container");
        TweenMax.killTweensOf($confettiContainer);
        TweenMax.set($confettiContainer, {clearProps:"all"});
        $confettiContainer.empty();
        $confettiContainer.css("-webkit-transform","none");
        $confettiContainer.css("transform","none");
        $confettiContainer.css("top","-260");
    }

//Statue of Liberty rises up and then coins rise up from the torch
    function liberty(){
        var $liberty = $(".liberty");
        var $coinLeft = $(".liberty-coin-left");
        var $coinRight = $(".liberty-coin-right");
        var $coinCenter = $(".liberty-coin-center");
        $liberty.toggle();
        var startY = (document.getElementById("coin-left").getBoundingClientRect().height) * 0.03;
        startY = startY + 20;
        startY = "+=" + startY.toString() + "px";
        var tl = new TimelineMax();

        tl.from($liberty,1.6,{y:$liberty.height(),ease: Power1.easeOut,});
        tl.from($coinCenter,0.6,{css:{top: startY},ease: SteppedEase.config(9)},1.6);
        tl.set($coinCenter,{opacity: 1},1.6);
        tl.from($coinLeft,0.6,{css:{top: startY},ease: SteppedEase.config(9),delay:0.3},1.6);
        tl.set($coinLeft,{opacity: 1},1.6);
        tl.from($coinRight,0.6,{css:{top: startY},ease: SteppedEase.config(9),delay:0.2},1.6);
        tl.set($coinRight,{opacity: 1},1.6);
    }


//MODAL
    var modalInit = function($targ,$contentPiece1,$contentPiece2){
        var $callerID = $targ.id;
        var $caller = $("#" + $callerID);
        var $modal = document.getElementById($callerID).getAttribute("href");
        $modal = $($modal);
        var $top = $caller.offset().top;
        var $left = $caller.offset().left;
        var $overlay = $modal.find(".modal-overlay");
        var $leftCorner = $modal.find(".modal-corner-left");
        var $rightCorner = $modal.find(".modal-corner-right");
        var $leftCover = $leftCorner.children('.modal-corner-cover');
        var $rightCover = $rightCorner.children('.modal-corner-cover');
        var $content = $modal.find(".modal-content");
        var $closeBt = $modal.find("#close-svg");
        var $cornerWidth = getWidth($caller);
        var $cornerHeight = getHeight($caller);
        var $par = this;

        //kill the confetti and firecracker animations on the main slider
        killConfetti();
        killFirecrackers();

        //hide scrollbar
        $("body").css("overflowY","hidden");

        $overlay.on('click', function(e){
            $par.closeModal();
        });

        $closeBt.on('click', function(e){
            $par.closeModal();
        });

        $closeBt.hover( closeBtIn, closeBtOut );
        function closeBtIn(){
            TweenMax.to($(this),0.3,{rotation:90,ease:Back.easeOut});
        }

        function closeBtOut(){
            TweenMax.to($(this),0.3,{rotation:0,ease:Back.easeOut});
        }


        TweenMax.set($overlay,{opacity:1});
        TweenMax.set($content,{opacity:1});

        //Animate
        var openSpeed = 0.4;

        //for rotation to work in webkit browsers it has to be set here
        TweenMax.set($leftCorner,{rotation: 20});
        TweenMax.set($rightCorner,{rotation: 20});


        var modalTLOpen = new TimelineMax();
        var modalTLClose = new TimelineMax();

        var animationGoing = true;
        modalTLOpen.from($leftCorner,openSpeed,{rotation: 0,top:$top, left:$left,width:$cornerWidth, height: $cornerHeight,ease: Power4.easeInOut},0);

        modalTLOpen.from($rightCorner,openSpeed,{rotation: 0, top:$top, left:$left,width:$cornerWidth,height:$cornerHeight,ease: Power4.easeInOut},0);

        modalTLOpen.from($leftCover,openSpeed,{height:"0%",ease: Power2.easeOut},0);

        modalTLOpen.from($rightCover,openSpeed,{height:"0%",ease: Power2.easeOut,onComplete:cornersOpen},0);

        modalTLOpen.from($content,0.7,{css:{top:"-100%"},ease:Power4.easeOut,delay:openSpeed},0);

        modalTLOpen.from($closeBt,0.3,{scaleY: 0, transformOrigin:"center center",ease: Bounce.easeOut,delay:0.8},0);

        function cornersOpen(){
            animationGoing = false;
            TweenMax.set($leftCover, { clearProps: "all" });
            TweenMax.set($rightCover, { clearProps: "all" });

            TweenMax.set($rightCorner, {css:{top:String(toRem(parseInt($rightCorner.css("top")))) + "rem",
                right:String(toRem(parseInt($rightCorner.css("right")))) + "rem",
                width:String(toRem($rightCorner.width())) + "rem",
                height:String(toRem($rightCorner.height())) + "rem"
            }});
        }


        //fade in each content piece consecutively
        /* $contentPiece = $modal.find(".modal-body").find(".winning-numbers-table-dsk").find("td").find(".winning-numbers-content");*/

        $contentPiece1.each(function(index) {
            fadeContentPiece($(this),index);
        });

        if($contentPiece2!==undefined){
            $contentPiece2.each(function(index) {
                fadeContentPiece($(this),index);
            });
        }

        //Close modal
        this.closeModal = function(){
            var closeSpeed = 0.5;

            //fix content shifting due to scrollbar disappearing and reapearing
            $("body").css("overflowY","auto");


            modalTLOpen.stop();

            TweenMax.set($overlay,{opacity:0});
            TweenMax.set($content,{opacity:0});

            modalTLClose = new TimelineMax({onComplete: $par.killModal});

            modalTLClose.to($leftCorner,closeSpeed,{css:{left:"-180em",rotation:-0.2},ease: Power1.easeOut},0);
            modalTLClose.to($rightCorner,closeSpeed,{css:{right:"-180em",rotation:-0.2},ease: Power1.easeOut},0);
            modalTLClose.set($leftCover,{opacity:0},0);
            modalTLClose.set($rightCover,{opacity:0},0);

            if(animationGoing){
                this.killModal();
            }
        };

        //Kill modal
        this.killModal = function(){
            $overlay.unbind();
            $closeBt.unbind();

            //kill any cell tweens
            $contentPiece1.each(function(index) {
                killContentPiece($(this));
            });

            if($contentPiece2!==undefined){
                $contentPiece2.each(function(index) {
                    killContentPiece($(this));
                });
            }

            modalTLOpen.kill();
            modalTLClose.stop();
            modalTLClose.kill();
            //clear all properties
            clearTweenedProps();
            if($modal.css("display")!="none"){
                $modal.modal('toggle');
            }
            $( document.activeElement ).blur();
            $(".slider").slick('slickPlay');
        };

        function fadeContentPiece($obj,index){
            var del = index * 0.08;
            TweenMax.from($obj,1,{opacity:0,delay: openSpeed + 0.2 + del});
        }

        function killContentPiece($obj){
            TweenMax.killTweensOf($obj);
            TweenMax.set($obj, { clearProps: "all" });
        }

        function clearTweenedProps(){
            TweenMax.set($leftCorner, { clearProps: "all" });
            TweenMax.set($rightCorner, { clearProps: "all" });
            TweenMax.set($leftCover, { clearProps: "all" });
            TweenMax.set($rightCover, { clearProps: "all" });
            TweenMax.set($content, { clearProps: "all" });
            TweenMax.set($closeBt, { clearProps: "all" });
        }

        function getWidth(obj){
            var w = obj.outerWidth();
            var ow = getOutlineWidth(obj);
            w = w + (ow*2);

            return w;
        }

        function getHeight(obj){
            var h = obj.outerHeight();
            var oh = getOutlineWidth(obj);
            h = h + (oh*2);

            return h;
        }

        function getOutlineWidth(obj){
            var ow = obj.css('outline-width');
            ow = ow.replace('px','');
            ow = Number(ow);

            return ow;
        }

        var rem = function rem() {
            var html = document.getElementsByTagName('html')[0];

            return function () {
                return parseInt(window.getComputedStyle(html)['fontSize']);
            };
        }();

        // This function will convert pixel to rem
        function toRem(length) {
            return (parseInt(length) / rem());
        }
    };

    var modalSmInit = function($targ){
        var $callerID = $targ.id;
        var $caller = $("#" + $callerID);
        var $modal = document.getElementById($callerID).getAttribute("href");
        $modal = $($modal);
        var $overlay = $modal.find(".modal-overlay");
        var $leftCorner = $modal.find(".modal-corner-left");
        var $content = $modal.find(".modal-content");
        var $header = $modal.find(".modal-header");
        var $gameMenu = $modal.find(".modal-game-menu");
        var $closeBt = $modal.find(".modal-close-bt");
        var $par = this;

        //kill the confetti and firecracker animations on the main slider
        killConfetti();
        killFirecrackers();


        $("body").css("overflowY","hidden");
        //hide scrollbar
        //$(".modal-open").css("overflowY","hidden");

        $overlay.on('click', function(e){
            $par.closeModal();
        });

        $closeBt.on('click', function(e){
            $par.closeModal();
        });

        //Animate
        var openSpeed = 0.7;

        var modalTLOpen = new TimelineMax();
        var modalTLClose = new TimelineMax();
        var animationGoing = true;

        TweenMax.set($overlay,{opacity:1});
        TweenMax.set($leftCorner,{rotation:40});

        modalTLOpen.from($leftCorner,openSpeed,{y: 100,ease: Power4.easeOut,onComplete: cornersOpen},0);
        modalTLOpen.from($header,1,{y:-$(window).height(),ease: Power4.easeOut},0);

        //bring in each logo consecutively
        var $logo = $modal.find(".modal-logos-container").find(".winning-numbers-logo");

        $logo.each(function(index) {
            var del = index * 0.08;

            TweenMax.from($(this),0.8,{y:-$(window).height(),ease: Back.easeOut,delay: 0.2 + del});

            //set on click for logos
            $(this).find("a").on('click', function(e){
                var curIndex = index;
                e.preventDefault();

                $logo.each(function(index) {
                    var targID = $($(this).find("a").attr("href"));
                    if(curIndex != index){
                        TweenMax.to($(this),0.4,{opacity:0.4});
                        if(targID.css('display')!='none'){
                            targID.toggle();
                        }
                    }
                    else{
                        TweenMax.to($(this),0.4,{opacity:1});
                        if(targID.css('display')=='none'){
                            targID.toggle();
                            TweenMax.from(targID,0.5,{y:30,ease: Back.easeOut});
                            var promoLink = targID.find(".promo-link");

                            TweenMax.from(promoLink,0.5,{opacity: 0, delay: 0.5});
                        }
                    }
                });
                //determine the larger between 35vh and min-height
                var minHeight = $gameMenu.css("min-height");
                minHeight = parseInt(minHeight, 10);
                var newHeight = 35;


                if($(window).height()*0.35 < minHeight){
                    newHeight = (minHeight/$(window).height()) * 100;
                }

                TweenMax.to($gameMenu,0.7,{height: newHeight + "vh",ease: Power3.easeOut});
            });

        });

        function cornersOpen(){
            animationGoing = false;
            TweenMax.set($leftCorner, { clearProps: "y" });

        }

        //Close modal
        this.closeModal = function(){
            var closeSpeed = 0.5;
            $("body").css("overflowY","auto");
            //fix content shifting due to scrollbar disappearing and reapearing
            //$(".modal-open").css("overflowY","auto");

            modalTLOpen.stop();
            modalTLClose = new TimelineMax({onComplete: $par.killModal});
            modalTLClose.to($leftCorner,0.2,{css:{bottom:(-$leftCorner.height()) + "px"},ease: Power1.easeIn},0);
            modalTLClose.to($header,closeSpeed,{y:-$(window).height(),ease: Power2.easeIn},0);
            modalTLClose.set($overlay,{opacity:0},0);

            //close any open winning numbers
            $modal.find(".winning-numbers-content-sm").each(function(){
                if($(this).css('display')!='none'){
                    $(this).toggle();
                }
            });

            if(animationGoing){
                $par.killModal();
            }
        };

        //Kill modal
        this.killModal = function(){
            $overlay.unbind();
            $closeBt.unbind();

            clearTweenedProps();

            //kill any logo tweens
            $logo.each(function(index) {
                var del = index * 0.08;

                TweenMax.killTweensOf($(this));
                TweenMax.set($(this), { clearProps: "all" });
            });

            //kill any open winning numbers tweens
            $modal.find(".winning-numbers-content-sm").each(function(){
                TweenMax.killTweensOf($(this));
                TweenMax.set($(this), { clearProps: "all" });
            });


            if($modal.css("display")!="none"){
                $modal.modal('toggle');
            }
            $( document.activeElement ).blur();
            $(".slider").slick('slickPlay');
        };

        function clearTweenedProps(){
            TweenMax.set($gameMenu,{clearProps: "all"});
            TweenMax.set($leftCorner, { clearProps: "all" });
            TweenMax.set($header, { clearProps: "all" });
        }

        var rem = function rem() {
            var html = document.getElementsByTagName('html')[0];

            return function () {
                return parseInt(window.getComputedStyle(html)['fontSize']);
            };
        }();

        // This function will convert pixel to rem
        function toRem(length) {
            return (parseInt(length) / rem());
        }
    };


//Activate rollover for Drawn Together Video
    function activateVideo(getDrawnVidLoaded){
        var $btBg = $(".video-play-bt-bg");
        var $btIcon = $(".video-play-bt-icon");
        var btAnimSpeed = 0.4;
        var $img;

        $('#get-drawn-together-btn').hover( videoOn, videoOut );

        $('#get-drawn-together-btn').on('click', function(e){
            $modalObjGetDrawnVideo =  new modalVideoInit(this,getDrawnVidLoaded);
            $(".slider").slick('slickPause');
        });

        function videoOn(){
            var speed = btAnimSpeed;

            $img = $(".video-container").find(".video-sequence");

            if($img.css("display")!="none"){
                var numSteps = getNumSteps("forward");
                speed = getSpeed(numSteps);

                TweenMax.killTweensOf($img);

                TweenMax.to($img,speed,{left:-($img.width()-$(window).width()),ease: SteppedEase.config(numSteps)});
            }

            TweenMax.to($btBg,speed,{rotation: 180,scale: 0.9,ease:Power4.easeOut});
            TweenMax.to($btIcon,speed,{scale: 0.7,ease:Back.easeOut});
        }

        function videoOut(){
            var speed = btAnimSpeed;
            $img = $(".video-container").find(".video-sequence");

            if($img.css("display")!="none"){
                var numSteps = getNumSteps("reverse");
                speed = getSpeed(numSteps);
                TweenMax.killTweensOf($img);

                TweenMax.to($img,speed,{left:0,ease: SteppedEase.config(numSteps)});
            }

            TweenMax.to($btBg,speed,{rotation: 0, scale: 1,ease:Power4.easeOut});
            TweenMax.to($btIcon,speed,{scale: 1,ease:Back.easeOut});
        }

        function getSpeed(numSteps){
            var fps = 32;
            var winW = $(window).width();
            var w = $img.width();
            var defaultSpeed = numSteps/fps;
            var sp = ((numSteps+1)/(w/winW)) * defaultSpeed;
            return sp;
        }

        function getNumSteps(direction){
            var winW = $(window).width();
            var w = $img.width();
            var newSteps;
            if(direction == "forward"){
                newSteps =  ((w-winW)/winW) - (Math.abs($img.position().left/winW));
            }
            else{
                newSteps = Math.abs($img.position().left/winW);

            }
            return newSteps;
        }
    }

    //Video modal
    var modalVideoInit = function($targ,getDrawnVidLoaded){
        var $callerID = $targ.id;
        var $caller = $("#" + $callerID);
        var $modal = document.getElementById($callerID).getAttribute("href");
        $modal = $($modal);
        var dataURL = $caller.attr("data-url");
        var $overlay = $modal.find(".modal-overlay");
        var $content = $modal.find(".modal-content");
        var $body = $content.find(".modal-body");
        var $header = $modal.find(".modal-header");
        var $closeBt = $modal.find(".modal-close-bt");
        var $iframeHolder = $body.find(".get-drawn-iframe-placeholder");
        var $par = this;


        $overlay.on('click', function(e){
            $par.closeModal();
        });

        $closeBt.on('click', function(e){
            $par.closeModal();
        });

        $closeBt.hover( closeBtIn, closeBtOut );
        function closeBtIn(){
            TweenMax.to($(this),0.3,{rotation:90,ease:Back.easeOut});
        }

        function closeBtOut(){
            TweenMax.to($(this),0.3,{rotation:0,ease:Back.easeOut});
        }

        var btH = $caller.height();
        var btOffset = $caller[0].getBoundingClientRect();
        var btTop = btOffset.top + btH/2 + $(".video-container").height()*0.13;


        // TweenMax.set($overlay,{height: "150vh",top: "-30%",transform:"skewY(-8.5deg)"});

        var modalTLOpen = new TimelineMax({onComplete:loadVideo});

        modalTLOpen.from($overlay,0.4,{height: 1, top: btTop, ease: Power3.easeInOut,onComplete:clearOverlayProps});

        modalTLOpen.from($closeBt,0.3,{scaleY: 0, transformOrigin:"center center",ease: Bounce.easeOut});

        modalTLOpen.from($body,0.1,{opacity:0});

        function loadVideo(){
            $iframeHolder.append(dataURL);
            //this prevents iframe src caching in firefox
            var $iframe = $iframeHolder.find("iframe");
            $iframe[0].contentWindow.location.href = $iframe.attr("src");
        }


        function clearOverlayProps(){
            TweenMax.set($overlay,{clearProps: "all"});
        }

        //Close modal
        this.closeModal = function(){
            //fix content shifting due to scrollbar disappearing and reapearing
            $("body").css("overflowY","auto");

            var $iframe = $iframeHolder.find("iframe");
            $iframe.remove();
            modalTLOpen.stop();

            this.killModal();
        };

        //Kill modal
        this.killModal = function(){
            $overlay.unbind();
            $closeBt.unbind();

            modalTLOpen.kill();

            TweenMax.set($closeBt,{rotation:0});
            TweenMax.set($closeBt,{clearProps: "all"});
            TweenMax.set($body,{clearProps: "all"});
            TweenMax.set($overlay,{clearProps: "all"});

            if($modal.css("display")!="none"){
                $modal.modal('toggle');
            }
            $( document.activeElement ).blur();
            $(".slider").slick('slickPlay');
        };
    };

//Load the large png for the Drawn Together video sequence
    function loadVideoSequence(){
        var $img = $(".video-sequence");
        var $imgStatic = $(".video-static");
        var downloadingImage = new Image();
        var timeout;

        downloadingImage.onload = function(){
            $img.attr("src",this.src);
            $img.css("display","block");
            timeout = setTimeout(hideStatic,400);
        };

        downloadingImage.src = $img.attr("data-url");

        function hideStatic(){
            $imgStatic.css("visibility","hidden");
            clearTimeout(timeout);
        }
    }

//Fade the section header up
    function animateHeader($section){
        var $anim = $section.find(".anim");
        $anim.each(function(index){
            var del = index * 0.1;
            TweenMax.set($(this),{opacity:1,delay:del});
            TweenMax.from($(this),0.4,{y:100,ease:Back.easeOut,delay:del});
        });
    }

    function removeHeaderAnimation($section){
        var $anim = $section.find(".anim");

        $anim.each(function(index){
           $(this).removeClass("anim");
        });
    }

    function animatePromo(){
        var $promo = $(".promo");
        var $slide = $promo.find(".inner");

        $slide.each(function(index){
            var del = index * 0.2;
            TweenMax.set($(this),{className: "-=invisible",delay: del});

            TweenMax.from($(this),0.7,{y:-300,ease:Back.easeOut,delay: del,onComplete:clear,onCompleteParams:[$(this)]});
        });

        function clear($obj){
            TweenMax.set($obj,{clearProps: "y"});
        }
    }

    function removePromoAnimation(){
        var $promo = $(".promo");
        var $slide = $promo.find(".inner");

        $slide.each(function(index){
            $(this).removeClass("invisible");
        });
    }
}(jQuery));
