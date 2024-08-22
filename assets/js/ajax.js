function sendAjaxRequest() {
	jQuery.ajax({
		url: AcademyAjax.ajax_url,
		method: 'POST',
		data: {
			action: 'academy_ajax_get_posts',
			per_page: 3,
			_ajax_nonce: AcademyAjax.ajax_nonce,
		},
		success: function(response) {
			if ( Array.isArray( response ) ) {
				var html = '<ul>';

				response.forEach(function(item) {
					html += '<li>' +  item.post_title + '</li>';
				});

				html += '</ul>';

				jQuery('.academy-wp-plugin-ajax').append(html);
			}
		}
	});
}

jQuery(document).ready(function($) {

	$('.academy-wp-plugin-ajax-click').click(function() {
		sendAjaxRequest();
	});

});
