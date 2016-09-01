/**
 * Created by williamchoy1 on 6/8/16.
 */
(function ($) {
    <!-- PROBABILTY JS -->
    var gameId = $("#probability-index input[name='gameId']").val();

    var days = $("#probability-index #edit-days").val();

    $('#probability-index #edit-days').change(function () {
        var days = $(this).val();
        console.log('/nyl_drawing_results/' + gameId + '/' + days +'/getProbability.json');
        $.ajax({
            url: '/nyl_drawing_results/' + gameId + '/' + days +'/getProbability.json',
            type: 'GET',
            dataType: 'json',
            headers: {
                'Accept': 'application/json'
            },
            success: replaceProbabilityIndexResults
        });
    });

    $.ajax({
        url: '/nyl_drawing_results/' + gameId + '/' + days +'/getProbability.json',
        type: 'GET',
        dataType: 'json',
        headers: {
            'Accept': 'application/json'
        },
        success: replaceProbabilityIndexResults
    });

    function replaceProbabilityIndexResults(json) {
        // alert("Lazy Load probability-index.");
        var chart  = [];
        $.each(json['data']['results'], function (i, value) {
            // console.log(value['ball'] +' => ' + value['count']);
            chart.push('<div id="probability_'+ i +'" class="row"> <span class="circle number">' + value['ball'] + '</span> <span class="bar" data="'+ value['count'] + '">' + value['count'] + ' times</span></div>');
        });
        $('#probability-index .results').html(chart.join(""));
    }
}(jQuery));