/**
 * Created by williamchoy1 on 6/7/16.
 *
 * the order doesn't matter, in a Combination.
 */
jQuery(document).ready(function ($) {
    $(':input[type="number"].number').bind('change keyup mouseup', highlightCombination);
    highlightCombination();

    function highlightCombination (e) {
        $("span.number").removeClass('exactMatch');
        $(':input[type="number"].number').each(function () {
            var number = this.value;
            $("span.number").filter(function() { return ($(this).text() === number) }).addClass('exactMatch');
        });
    }

    //$( document ).ajaxStop(function() {
    //    // re-bind for new input elements.
    //    $(':input[type="number"].number').bind('change keyup mouseup', highlightCombination);
    //    // may have removed a ticket.
    //    highlightCombination();
    //});
});