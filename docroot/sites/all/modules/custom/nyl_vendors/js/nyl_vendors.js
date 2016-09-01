/**
 * Created by williamchoy1 on 6/15/16.
 */






(function($) {


    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            alert(position.address.postalCode);
            //$("#location .zipcode").val(position.address.postalCode);
        });
    }


})(jQuery);