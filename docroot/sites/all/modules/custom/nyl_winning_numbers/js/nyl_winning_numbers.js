/**
 * Created by paul on 6/20/2016.
 * paul's main.js on 6/20/2016
 */

(function($){

    // Winning Numbers Tray //
    $(function(){
        // Click trigger for mobile navigation //
        var $mobileTrayNav = $("#mobileTrayNav");
        $('#trayButton').on('click',function(){


            $($('.game-icon').get().reverse()).each(function(index){
                var  _this = $(this);


                setTimeout(function(){
                    _this.addClass('icon-ani');
                }, index * 75);

            });
        });

        $('#trayButtonClose').on('click', function(){

            $('.game-icon').removeClass('icon-ani');
            $mobileTrayNav.css('height','85vh');
            $mobileTrayNav.find('.row').removeClass('height-auto');
            $mobileTrayNav.find('a').removeClass('on');
            $mobileTrayNav.find('a').removeClass('off');
        })

        $mobileTrayNav.find('a').on('click', function(e){
            var visibleGame = $(this).attr('href');
            $mobileTrayNav.css('height','45vh');
            $mobileTrayNav.find('.row').addClass('height-auto');

            e.preventDefault();

            $mobileTrayNav.find('a').removeClass('on');
            $mobileTrayNav.find('a').addClass('off');
            $(this).removeClass('off').addClass('on');
            $('.game').removeClass('on');
            $(visibleGame).addClass('on');

        });
        // Responsive when mobile sized show the correct game//
        $(window).on('resize', function(){
            var visibleGame = $mobileTrayNav.find('a.on').attr('href');

            if ($(window).width() < 768) {
                $($('.game-icon').get().reverse()).each(function(index){
                    var  _this = $(this);


                    setTimeout(function(){
                        _this.addClass('icon-ani');
                    }, index * 75);

                });
                $('.game').removeClass('on');
                $(visibleGame).addClass('on');
            }
        });



    });
}(jQuery));
