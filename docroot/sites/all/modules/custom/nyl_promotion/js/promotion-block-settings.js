Drupal.behaviors.promotionBlockSettings = {
    attach: function (context, settings) {
        var $form = jQuery("#nyl-core-promotion-blocks-settings", context);
        if($form.length) {
            //ensure have maximum of 2 promotions per block
            jQuery("fieldset", $form).each(function (index, value){
                var $fieldset_this = jQuery(this);
                var $fieldset_id = $fieldset_this.attr("id");
                var $block_name = $fieldset_id.replace('edit-', '').replace(/\-/g,'_');
                var $checkbox_selector = "[type='checkbox'][name^='"+$block_name+"_tableselect']";
                jQuery($checkbox_selector, $fieldset_this).change(function(e){
                    $checkbox_this = jQuery(this);
                    // console.watn($checkbox_this);
                    // alert(this.checked);
                    var $count_checked = jQuery($checkbox_selector+":checked", $fieldset_this).length;
                   // alert($count_checked);
                    if($count_checked > 2) {
                        alert('Please select maximum of 2 promotions per block.');
                        $checkbox_this.removeAttr('checked');
                        e.preventDefault();
                        e.stopPropagation();
                    }
                });
            });
            //ensure position for selected promotions are valid
            $form.submit(function(e){
                var $positions_invalid = false;
                var $positions_count_invalid = false;
                jQuery("fieldset", $form).each(function (index, value){
                    var $fieldset_this = jQuery(this);
                    var $fieldset_id = $fieldset_this.attr("id");
                    var $block_name = $fieldset_id.replace('edit-', '').replace(/\-/g,'_');
                    var $checkbox_selector = "[type='checkbox'][name^='"+$block_name+"_tableselect']:checked";
                    if(jQuery($checkbox_selector, $fieldset_this).length != 2) {
                        $positions_count_invalid = true;
                    }
                    var $position_values = [];
                    jQuery($checkbox_selector, $fieldset_this).each(function (index, value){
                        $select_id = jQuery(this).val();
                        var $position_selector = "[name='"+$block_name+"_position\["+$select_id+"\]'] option:selected";
                        var $position = jQuery($position_selector);
                        if($position.val() == 0) {
                            $positions_invalid = true;
                        }
                        $position_values.push($position.val());
                    });
                    if($position_values[0] == $position_values[1]) {
                        $positions_invalid = true;
                    }
                });
                if($positions_invalid == true) {
                    alert('Please select valid positions for your blocks');
                    e.preventDefault();
                } else
                if($positions_count_invalid == true) {
                    alert('Please select 2 positions for each blocks');
                    e.preventDefault();
                }
            });
        }
    }
};