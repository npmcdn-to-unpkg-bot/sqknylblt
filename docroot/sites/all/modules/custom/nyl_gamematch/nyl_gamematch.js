jQuery(document).ready(function($) {
	$('#gm-form').submit(function(event){
		event.preventDefault();
	});

	$("#gm-form .form-type-radios").first().addClass('first current');
	$("#gm-form .form-type-radios").last().addClass('last');

	$('#gm-form input').on('click', function() {
		var kv = $(this).serialize();
		var kv_arr = kv.split("=");

		// Get orignal values
		nyl_gamematch = Drupal.settings.nyl_gamematch;
		// Set the gamematch choices
		Drupal.settings.nyl_gamematch[kv_arr[0]] = kv_arr[1];

		// Move onto the next step
		current = $('.current');
		next = current.next();
		current.removeClass('current');
		next.addClass('current');

		// Store results
		if (current.hasClass('last')) {
			var nyl_gamematch_container_str = '';
			$.each(Drupal.settings.nyl_gamematch, function(index, value){
				$.each(Drupal.settings.nyl_gamematch_map, function(i, v){
					if (index == i && value in v) {
						nyl_gamematch_container_str += v[value].join() + ',';
					}
				});
			});

			nyl_gamematch_container = nyl_gamematch_container_str.split(',');
			Drupal.settings.nyl_gamematch_container = nyl_gamematch_container.filter(Boolean);
			console.log('Results', Drupal.settings.nyl_gamematch_container);
			$('#gm_results').html(Drupal.settings.nyl_gamematch_container);
		}
	});
});
