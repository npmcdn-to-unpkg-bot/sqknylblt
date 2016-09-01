/**
 * Created by williamchoy1 on 6/7/16.
 *
 * the order doesn't matter, in a Combination.
 */
jQuery(document).ready(function ($) {

    $(':input[type="number"].number').bind('change keyup mouseup', highlightCombination);
    highlightCombination();

    $(':input[type="number"].bonus').bind('change keyup mouseup', hightlightBonus);
    hightlightBonus();

    function highlightCombination (e) {
        $("span.number").removeClass('exactMatch');
        $(':input[type="number"].number').each(function () {
            var number = this.value;
            $("span.number").filter(function() { return ($(this).text() === number) }).addClass('exactMatch');
            console.log(number);
        });
    }

    function hightlightBonus (e) {
        $("td.specialResult").removeClass('exactMatch');
        var bonus = $(':input[type="number"].bonus').val();
        console.log(bonus);
        $("td.specialResult").filter(function() { return ($(this).text() === bonus) }).addClass('exactMatch');

    }

    //$( document ).ajaxStop(function() {
    //    // re-bind for new input elements.
    //    $(':input[type="number"].number').bind('change keyup mouseup', highlightCombination);
    //    $(':input[type="number"].bonus').bind('change keyup mouseup', hightlightBonus);
    //    // may have removed a ticket.
    //    highlightCombination();
    //    hightlightBonus();
    //});
});