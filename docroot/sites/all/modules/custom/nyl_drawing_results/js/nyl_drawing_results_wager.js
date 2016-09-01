/**
 * Created by williamchoy1 on 6/13/16.
 *
 * Wager Type : straight, box, straight/ box, combination, or close enough
 */
jQuery(document).ready(function ($) {

    $(':input[type="number"]').bind('change keyup mouseup', highlight);
    $(':input[name="wagerType"]').bind('change', highlight);
    highlight();

    function highlight() {
        var wagerType = $('input:checked[name="wagerType"]').val();
        if (typeof wagerType !== 'undefined') {
            switch (wagerType) {
                case 'str':
                    highlightStraight();
                    break;
                case 'close_enough':
                    highlightCloseEnough();
                    break;
                case 'str_box':
                    highlightStraightBox();
                    break;
                case 'box':
                case 'comb':
                    highlightCombination();
                    break;
                // default: do nothing.
            }
        }
    }


    /* StraightPlay - Match the winning numbers draw in their exact order */
    function highlightStraight(e) {
        $("span.number").removeClass('exactMatch');
        $("span.number").removeClass('wagerMatch');
        $(':input[type="number"]').each(function () {
            var myNumber = parseInt(this.value);
            var selector = this.name.match(/\[(\w*)\]$/)[1]; // my_numbers[0][number_0]
            $("span."+ selector).filter(function() { return ($(this).text() == myNumber) }).addClass('exactMatch');
        });
    }

    /* StraightBoxPlay - Win both the straight and box prizes if you match the winning numbers draw in the their exact order
     *                   Win ONLY the box prize if you match the winning numbers drawn in any order. */
    function highlightStraightBox(e) {
        $("span.number").removeClass('exactMatch');
        $("span.number").removeClass('wagerMatch');
        $(':input[type="number"].number').each(function () {
            var myNumber = parseInt(this.value);
            var selector = this.name.match(/\[(\w*)\]$/)[1]; // my_numbers[0][number_0]
            $("span."+ selector).filter(function() { return ($(this).text() == myNumber) }).addClass('exactMatch');
            $(".results").each(function () {
                // match only the first numbers that is not already a match.
                var numbers = $('.number:not(.exactMatch)', this);
                for (i=0, len = numbers.length; i < len; i++)  {
                    if ($(numbers[i]).text() == myNumber) {
                        $(numbers[i]).addClass('wagerMatch');
                        return; // stop after first.
                    }
                }
            });
        });
    }

    /* CombinationPlay - Match the winning numbers drawn in any order. */
    function highlightCombination (e) {
        $("span.number").removeClass('exactMatch');
        $("span.number").removeClass('wagerMatch');
        $(':input[type="number"].number').each(function () {
            var myNumber = this.value;
            $(".results").each(function () {
                // match only the first numbers that is not already a match.
                var numbers = $('.number:not(.exactMatch)', this);
                for (i=0, len = numbers.length; i < len; i++)  {
                    if ($(numbers[i]).text() == myNumber) {
                        $(numbers[i]).addClass('exactMatch');
                        return; // stop after first.
                    }
                }
            });
        });
    }

    // Close Enough  - Players win if their numbers match in exact order (or if they are 1-off on any or all of their numbers.
    function highlightCloseEnough(e) {
        $("span.number").removeClass('exactMatch');
        $("span.number").removeClass('wagerMatch');
        $(':input[type="number"]').each(function () {
            var number = parseInt(this.value);
            var number_plus = number + 1;
            var number_minus = number - 1;
            var selector = this.name.match(/\[(\w*)\]$/)[1]; // my_numbers[0][number_0]
            $("span."+ selector).filter(function() { return ($(this).text() == number) }).addClass('exactMatch');
            $("span."+ selector).filter(function() { return ($(this).text() == number_plus) }).addClass('wagerMatch');
            $("span."+ selector).filter(function() { return ($(this).text() == number_minus) }).addClass('wagerMatch');
        });
    }
    //
    //$( document ).ajaxStop(function() {
    //    // re-bind for new input elements.
    //    $(':input[type="number"]').bind('change keyup mouseup', highlight);
    //    // may have removed a ticket.
    //    highlight();
    //});
});