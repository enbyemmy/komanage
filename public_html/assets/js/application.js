
/* on page load */

$(document).live('ready', function() {

	// open a window modally by clicking an anchor
	$(".modal").live('click', function() {
		var href = $(this).attr('href');
		jQuery.colorbox({href:href});
		return false;
	});


	$(".delete").live('click', function() {
		var title = $(this).attr('title');
		var thisparent = $(this).parents('li');
		confirm('Are you sure you want to delete '+title+'?');

		$.ajax({
			url: $(this).attr('href'),
			success: function(data) {
				thisparent.remove();
			}

		});
		return false;
		
	});

	/** begin ajax forms **/

	// submit a form asynchronously
	$('form.async', '.content').submit(function() {
		
		var buttonSubmit = $('input[type=submit]', this);
		var action = $(this).attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serializeArray(),
			success: function(data) {
				buttonSubmit.val('Saved!').attr('disabled', 'disabled');
			}
		});
		return false;
	});

	// disable the submit button by default
	$('input[type=submit]', 'form.async').attr('disabled', 'disabled');

	// on input change activate the save link
	$('input, textarea', 'form.async').live('change', function() {
		$('input[type=submit]', 'form.async').removeAttr('disabled');

	});
	

});
