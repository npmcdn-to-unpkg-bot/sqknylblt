/**
 * Created by williamchoy1 on 6/8/16.
 */
(function ($) {
    Drupal.behaviors.NYL_Drawing_Results_DatePopup = {
        attach: function (context, settings) {
            $('#edit-start-date-datepicker-popup-0').one('focus', function() {
                $('#edit-start-date-datepicker-popup-0').datepicker('option', {
                    onClose: function(selected) {
                        $('#edit-end-date-datepicker-popup-0').one('focus', function() {
                            $('#edit-end-date-datepicker-popup-0').datepicker('option', 'minDate', selected);
                        });
                        $('#edit-end-date-datepicker-popup-0').datepicker('option', 'minDate', selected);
                    }
                });
            });
        }
    };

    /*
     * Initial load of Previously checked number.
     * note: AJAX will replace all of this on 'save', to avoid duplicates.
     */
    Drupal.behaviors.NYL_Drawing_Results_Previous = {
        attach: function (context, settings) {
            $('#nyl_drawing_results_previous', context).once('add previous', function() {
                if ($('#nyl_drawing_results_previous').is(':empty')) {
                    var url = [location.protocol, '//', location.host, location.pathname].join('');
                    var key = $('#nyl_drawing_results_key').text();
                    var json = $.cookie('Drupal.visitor.myNumbers' + key);
                    var tickets = jQuery.parseJSON(json);
                    console.log(key +' => '+ tickets);
                    var newHTML = [];
                    if(tickets != null) {
                        $.each(tickets, function (i, ticket) {
                            var numbers = ticket.split('+');
                            var row = [];
                            $.each(numbers[0].split('-'), function (j, number) {
                                row.push(' <span class="circle number">' + number + '</span> ');
                            })
                            if (numbers.length == 2) {
                                row.push(' + <span class="circle bonus">' + numbers[1] + '</span> ');
                            }
                            // add link to my Numbers to prepopulate via $form['#after_build']
                            var href = url + '?myNumbers=' + encodeURI(ticket);
                            newHTML.push(' <div class="ticket"><a href="' + href + '">' + row.join("") + '</a></div> ');
                        });

                        $('#nyl_drawing_results_previous').html('Previously Checked <br>' + newHTML.join(""));
                    }
                }
            });
        }
    };

}(jQuery));


