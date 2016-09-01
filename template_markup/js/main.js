$(document).ready(init);

//MAIN INITIALIZE FUNCTION CALLED WHEN THE PAGE IS LOADED
function init(){
    var $modalObjLg;
    var $modalObjSm;
    
    //bind click to winning numbers button
    $('#winning-numbers-btn').on('click', function(e){
        $modalObjLg =  new modalInit(this);
        $(".slider").slick('slickPause');
    });
    
    //bind click to winning numbers button mobile (small)
    $('#trayButton').on('click', function(e){
        $modalObjSm =  new modalSmInit(this);
        $(".slider").slick('slickPause');
    });
    
    
    //nav
    $(".navbar-toggle").on('click', function(e){
        navBgIn();
        $(".slider").slick('slickPause');
    });

    $('.slider').on('init', function () {
            $(this).css('visibility', 'visible');
        });

       $('.slider').slick({
         dots: true,
         infinite: true,
         autoplay: true,
         autoplaySpeed: 3000,
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

       $('.nys-nav-top .toggle').on('click', function() {
         $(this).closest('.nys-nav-top').toggleClass('open');
       });
    
    //convert inline svg to mg (so we can change the color)
    //convertSVG();
    
    //welcome banner animation
    welcomeBanner();
    confettiMaker();
    
    
    //listen for slider change and replay animations
    $('.slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
        if(nextSlide === 0){
            welcomeBanner(0.3);
            confettiMaker();
        }
        else if(nextSlide === 1){
            firecrackerPop();
        }
        if(currentSlide === 0){
            killConfetti();
        }
        else if(currentSlide === 1){
            killFirecracker();
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
    
    //animate legends picture frame glare
    legendsFrameGlare();
    
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
    
    //detect window size
    $(window).on('resize', function(){
        //check if desktop modal is on
        if ($(window).width() < 992) {
            var $modalDesktop = $("#winning-numbers-modal-lg");
            if($modalDesktop.css('display') != 'none'){
                $modalObjLg.killModal();
                $modalObjLg = null;
                
                $('#trayButton').trigger("click");
            }
        }
        else{
            var $modalMobile = $("#winning-numbers-modal-sm");
            if($modalMobile.css('display') != 'none'){
                $modalObjSm.killModal();
                $modalObjSm = null;
                
                $('#winning-numbers-btn').trigger("click");
            }
        }
     });
    
}

/*
function convertSVG(){
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
    
        }, 'xml');
    
    });
}
*/

//Animates strpes when nav is clicked in mobile
function navBgIn(){
    var $navModal = $("#navModal");
    var $yellow = $(".nav-bg-yellow");
    var $orange = $(".nav-bg-orange");
    var $red = $(".nav-bg-red");
    var $closeBt = $("#navModal").find(".close-bt");
    
    //kill the confetti animation on the main slider
    killConfetti();
    
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
    });
    
    
    function killModal(){
        $closeBt.unbind();

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

//Animates the welcome banner in
function welcomeBanner(initDelay){

    //Set the main rectangle part of the banner's width to 0 and then expand it
    var initBannerWidth = $('.slider-welcome-banner-content').width();
    TweenMax.set($('.slider-welcome-banner-content'),{width:"0%"});
    TweenMax.to($('.slider-welcome-banner-content'),0.5, {width:initBannerWidth,ease:Back.easeOut,delay:0.2 + initDelay});
    
    //Animate the sides of the banner. They slide from the middle to either side. The SVG inside the banner sides is expanded width-wise.
    var sideDelay = 0.4 + initDelay;
    
    var initLeftBannerX = $('.slider-welcome-banner-left').css("left");
    var $welcomeBannerLeftSVG = $('.slider-welcome-banner-left').find("svg");
    var $welcomeBannerLeftSVGWidth = $welcomeBannerLeftSVG.width();

    TweenMax.set($welcomeBannerLeftSVG,{width: "1%"});
    TweenMax.to($welcomeBannerLeftSVG,0.5,{width: $welcomeBannerLeftSVGWidth,ease:Back.easeOut,delay:sideDelay});
    TweenMax.set($('.slider-welcome-banner-left'),{left:-70,opacity:0});
    TweenMax.to($('.slider-welcome-banner-left'),0, {opacity:1,delay:sideDelay});
    TweenMax.to($('.slider-welcome-banner-left'),0.5, {left:initLeftBannerX,ease:Back.easeOut,delay:sideDelay});
    
    var initRightBannerX = $('.slider-welcome-banner-right').css("left");
    var $welcomeBannerRightSVG = $('.slider-welcome-banner-right').find("svg");
    var $welcomeBannerRightSVGWidth = $welcomeBannerRightSVG.width();
    
    TweenMax.set($welcomeBannerRightSVG,{width: "1%"});
    TweenMax.to($welcomeBannerRightSVG,0.5,{width: $welcomeBannerRightSVGWidth,ease:Back.easeOut,delay:sideDelay});
    TweenMax.set($('.slider-welcome-banner-right'),{left:70,opacity:0});
    TweenMax.to($('.slider-welcome-banner-right'),0, {opacity:1,delay:sideDelay});
    TweenMax.to($('.slider-welcome-banner-right'),0.5, {left:initRightBannerX,ease:Back.easeOut,delay:sideDelay});
    
    //Show welcome banner (it is initially hidden in css)
    TweenMax.set($('.slider-welcome-banner'), {opacity:1});
}

//Explodes money out of firecrackers for slide 2
function firecrackerPop(){
    var $firecrackerLeftMoney = $(".firecracker-left").find(".firecracker-money");
    var $firecrackerRightMoney = $(".firecracker-right").find(".firecracker-money");
    
    var numCoins = 5;
    var numBills = 5;
    
    /*
    for(i = 0; i< numCoins; i++){
        $firecrackerLeftMoney.append(
            "<div class='coin'><div class='coin-inner'></div></div>"
        );
        
        var $curCoin = $firecrackerLeftMoney.children().eq(i);
        var $curCoinInner = $curCoin.children(".coin-inner");
        
        var finY = (Math.random() * 100) + 50;
        var finX = -((Math.random() * 100) + 50);
        var del = Math.random() * 0.5;
        var speed = (Math.random() * 0.3) + 0.2;
        
        TweenMax.to($curCoin,speed,{y:finY,x:finX,delay: del,ease: Power4.easeOut});
    }
    */
}

function killFirecracker(){
    
}

//Raises the lighthouse and then display the rainbow light beam
function lighthouse(){
    var $lighthouse = $('.lighthouse');
    var heightIncrement = 34;
    var initTop = $lighthouse.position().top;
    var height = $lighthouse.height();
    var maxIncrements = Math.round(height/heightIncrement);
    var stackDelay = 0;
    var incrementStageLength = Math.round(maxIncrements/3);
    var startAnimTop = initTop + (height*0.75);
    
    //show the lighthouse
    $lighthouse.toggle();
    TweenMax.set($lighthouse,{top:startAnimTop});
    
    
    //raise the lighthouse, increasing the height incremenet each time and put a slight delay in between each frame so it looks like a stop motion animation
    for(i=0; i< maxIncrements; i++){
        finalTop = startAnimTop-(heightIncrement*(i+1));
        
        if(finalTop < 0){
            finalTop = 0;
            TweenMax.to($lighthouse,0, {top:finalTop,delay:stackDelay,onComplete:showBeam});
            break;
        }
        
        TweenMax.to($lighthouse,0, {top:finalTop,delay:stackDelay});
        stackDelay += 0.1;
    }
    
    //Beam is done with CSS tranisition
    function showBeam(){
        $beam = $(".lighthouse-beam");
        $beam.addClass('grow-beam');
    }

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
function confettiMaker(){
    var max = 60;
    var $confettiContainer = $(".confetti-container");
    var colors = ["#ec3d48", "#00b8ff", "#7d5fa7", "#ffe700","#00b515"];
    var $curConfetti;
    var xCo;
    var yCo;
    var maxWidth = 1500;
    var randomColor;
    var speed;
    
    killConfetti();
    
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
        yCo = (Math.random() * 500) + 10;
        $curConfetti = $confettiContainer.children().eq(i);
        $curConfettiInner = $curConfetti.children(".confetti-inner");
        randomColor = Math.floor(Math.random() * colors.length);
        speed = (Math.random() * 1) + 2;
        fallSpeed = (Math.random() * 3) + 3;
        w = (Math.random() * 20) + 6;
        h = w*2;
        initR = Math.random() * 360;
        midR = Math.random() * 360 + 40;
        newR = initR + (Math.random()*80) + 50;
        initScX = (Math.random() * 0.5) + 0.5;
        initScY = -((Math.random() * 0.5) + 0.5);
        scX = (Math.random() * 0.5) + 0.5;
        scY = -((Math.random() * 0.5) + 0.5);
        del = Math.random() * 0.4;
        innerOffset = Math.random()*2 + 1;
        
        $curConfettiInner.css({"background-color" : colors[randomColor],
                              "top" : innerOffset + "em",
                              "left" : innerOffset + "em"});
        
        TweenMax.set($curConfetti,{width:w,
                                   height:h,
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
                                       delay:1});
        tl.to($curConfetti,fallSpeed + (0.4 + speed),{rotation:initR-midR,delay:1,ease:Back.easeOut},0);
        tl.to($curConfetti,fallSpeed,{
                            x:finX,
                              //rotation:(initR - midR)-newR,
                              delay:0.4 + speed,
                              ease: Power1.easeInOut},0);
    }
    
    TweenMax.to($confettiContainer,9,{y:$(window).height() + 300,delay:1.2,ease: Power0.easeNone,onComplete:killConfetti},0);
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
var modalInit = function($targ){
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
    
    //kill the confetti animation on the main slider
    killConfetti();
    
    //hide scrollbar
    $(".modal-open").css("overflowY","hidden");
    
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
    
    //convert rem to px before animating
    TweenMax.set($leftCorner,{css:{width:$leftCorner.width() + "px", height:$leftCorner.height() + "px",rotation: 20}});
    TweenMax.set($rightCorner,{css:{width:$rightCorner.width() + "px", height:$rightCorner.height() + "px", rotation: 20}});
    
    
    var modalTLOpen = new TimelineMax();
    var modalTLClose = new TimelineMax();
    
    var animationGoing = true;
    modalTLOpen.from($leftCorner,openSpeed,{css:{top:$top+"px",left:$left+"px",width:$cornerWidth+"px",height:$cornerHeight+"px",rotation: 0},ease: Power4.easeInOut},0);
    
    modalTLOpen.from($rightCorner,openSpeed,{css:{top:$top+"px",left:$left+"px",width:$cornerWidth+"px",height:$cornerHeight+"px", rotation: 0},ease: Power4.easeInOut},0);
    
    modalTLOpen.from($leftCover,openSpeed,{height:"0%",ease: Power2.easeOut},0);
    
    modalTLOpen.from($rightCover,openSpeed,{height:"0%",ease: Power2.easeOut,onComplete:cornersOpen},0);
    
    modalTLOpen.from($content,0.7,{css:{top:"-100%"},ease:Power4.easeOut,delay:openSpeed},0);
    
    modalTLOpen.from($closeBt,0.3,{scaleY: 0, transformOrigin:"center center",ease: Bounce.easeOut,delay:0.8},0);
    
    function cornersOpen(){
        animationGoing = false;
        TweenMax.set($leftCover, { clearProps: "all" });
        TweenMax.set($rightCover, { clearProps: "all" });
        
        
        //convert px back to rem so that responsive function sproperly
        /*TweenMax.set($leftCorner, {css:{left:String(toRem($leftCorner.position().left)) + "rem",
                                        bottom:String(toRem(parseInt($leftCorner.css("bottom")))) + "rem",
                                        width:String(toRem($leftCorner.width())) + "rem",
                                        height:String(toRem($leftCorner.height())) + "rem"
                                       }});*/
        
        TweenMax.set($rightCorner, {css:{top:String(toRem(parseInt($rightCorner.css("top")))) + "rem",
                                         right:String(toRem(parseInt($rightCorner.css("right")))) + "rem",
                                        width:String(toRem($rightCorner.width())) + "rem",
                                        height:String(toRem($rightCorner.height())) + "rem"
                                       }});
    }
    
    
    //fade in each cell consecutively
    var $td = $modal.find(".modal-body").find(".winning-numbers-table-dsk").find("td");

    $td.each(function(index) {
        var del = index * 0.08;
        var $wnContent = $(this).find(".winning-numbers-content");
        
        TweenMax.from($wnContent,1,{opacity:0,delay: openSpeed + 0.2 + del});

    });
    
    
    var rem = function rem() {
        var html = document.getElementsByTagName('html')[0];

        return function () {
            return parseInt(window.getComputedStyle(html).fontSize);
        };
    }();

    // This function will convert pixel to rem
    function toRem(length) {
        return (parseInt(length) / rem());
    }
    
    
    //Close modal
    this.closeModal = function(){
        var closeSpeed = 0.5;
        
        //fix content shifting due to scrollbar disappearing and reapearing
        $(".modal-open").css("overflowY","auto");
        
        
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
        $td.each(function(index) {
            var del = index * 0.1;
            var $wnContent = $(this).find(".winning-numbers-content");

            TweenMax.killTweensOf($wnContent);
            TweenMax.set($wnContent, { clearProps: "all" });
        });

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
    
    //kill the confetti animation on the main slider
    killConfetti();
    
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
    
    modalTLOpen.from($leftCorner,openSpeed,{css:{bottom:(-$leftCorner.height()/2) + "px"},ease: Power4.easeOut,onComplete: cornersOpen},0);
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
                    if(targID.css('display')==='none'){
                        targID.toggle();
                        TweenMax.from(targID,0.5,{y:30,ease: Back.easeOut});
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
        TweenMax.set($leftCorner, { clearProps: "all" });        
        
        //convert px back to rem so that responsive function sproperly
        TweenMax.set($leftCorner, {css:{bottom:String(toRem(parseInt($leftCorner.css("bottom")))) + "rem"}});
    }
    
    //Close modal
    this.closeModal = function(){
        var closeSpeed = 0.5;
        
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
            return parseInt(window.getComputedStyle(html).fontSize);
        };
    }();

    // This function will convert pixel to rem
    function toRem(length) {
        return (parseInt(length) / rem());
    }
};
