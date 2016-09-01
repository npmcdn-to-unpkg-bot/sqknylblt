/**
 * Created by williamchoy1 on 6/7/16.
 *
 * the order doesn't matter, in a Combination.
 * highlight Bonus Ball if it is in the your numbers
 */
jQuery(document).ready(function ($) {
    $(':input[type="number"].number').bind('change keyup mouseup', highlightCombinationAndBonus);
    highlightCombinationAndBonus();

    function highlightCombinationAndBonus (e) {
        $("span.number").removeClass('exactMatch');
        $("td.specialResult").removeClass('exactMatch');
        $(':input[type="number"]').each(function () {
            var number = this.value;
            $("span.number").filter(function() { return ($(this).text() === number) }).addClass('exactMatch');
            $("td.specialResult").filter(function() { return ($(this).text() === number) }).addClass('exactMatch');
        });
    }

    //$( document ).ajaxStop(function() {
    //    // re-bind for new input elements.
    //    $(':input[type="number"]').bind('change keyup mouseup', highlightCombinationAndBonus);
    //    // may have removed a ticket.
    //    highlightCombinationAndBonus();
    //});
});