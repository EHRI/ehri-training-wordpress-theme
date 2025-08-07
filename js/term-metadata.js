jQuery(document).ready(function ($) {

	$('#term_feature_image_button').click(function (e) {
		e.preventDefault();

		let mediaUploader = wp.media({
			title: 'Choose Feature Image',
			button: {
				text: 'Use this image'
			},
			library: {
				type: ['image/jpeg', 'image/png'] // Restrict to image files
			},
			multiple: false
		});

		mediaUploader.once('select', function () {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#term_feature_image').val(attachment.id);
			$('#term_feature_image_wrapper').html('<img alt="Featured Image" src="' + attachment.url + '" style="max-width:300px;height:auto;">');
		});

		mediaUploader.open();
	});

	// Remove image button
	$('#term_feature_image_remove').click(function () {
		$('#term_feature_image').val('');
		$('#term_feature_image_wrapper').html('');
	});

	$('#term_file_1_button').click(function (e) {
		e.preventDefault();

		let mediaUploader = wp.media({
			title: 'Choose Source File',
			button: {
				text: 'Use this file'
			},
			library: {
				type: 'application/pdf' // Restrict to PDF files
			},
			multiple: false
		});

		mediaUploader.once('select', function () {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			console.log(attachment);
			$('#term_file_1').val(attachment.id);
			$('#term_file_1_wrapper').html(attachment.filename);
		});

		mediaUploader.open();
	});

	// Remove image button
	$('#term_file_1_remove').click(function () {
		$('#term_file_1').val('');
		$('#term_file_1_wrapper').html('');
	});

	$('#term_file_2_button').click(function (e) {
		e.preventDefault();

		let mediaUploader = wp.media({
			title: 'Choose Source Translation File',
			button: {
				text: 'Use this file'
			},
			library: {
				type: 'application/pdf' // Restrict to PDF files
			},
			multiple: false
		});

		mediaUploader.once('select', function () {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#term_file_2').val(attachment.id);
			$('#term_file_2_wrapper').html(attachment.filename);
		});

		mediaUploader.open();
	});

	// Remove image button
	$('#term_file_2_remove').click(function () {
		$('#term_file_2').val('');
		$('#term_file_2_wrapper').html('');
	});
});
