jQuery(document).ready(function ($) {

	let pdfIconHtml = '<img alt="PDF File" src="' + SourceMetadata.pdfIconUrl + '" class="file-icon">';

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

	$('#term_source_file_button').click(function (e) {
		e.preventDefault();

		let mediaUploader = wp.media({
			title: 'Choose Source PDF File',
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
			$('#term_source_file').val(attachment.id);
			$('#term_source_file_wrapper').html(pdfIconHtml + attachment.filename);
		});

		mediaUploader.open();
	});

	// Remove image button
	$('#term_source_file_remove').click(function () {
		$('#term_source_file').val('');
		$('#term_source_file_wrapper').html('');
	});

	$('#term_translation_file_button').click(function (e) {
		e.preventDefault();

		let mediaUploader = wp.media({
			title: 'Choose Translation PDF File',
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
			$('#term_translation_file').val(attachment.id);
			$('#term_translation_file_wrapper').html(pdfIconHtml + attachment.filename);
		});

		mediaUploader.open();
	});

	// Remove image button
	$('#term_translation_file_remove').click(function () {
		$('#term_translation_file').val('');
		$('#term_translation_file_wrapper').html('');
	});

	$('#term_transcription_file_button').click(function (e) {
		e.preventDefault();

		let mediaUploader = wp.media({
			title: 'Choose Transcription PDF File',
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
			$('#term_transcription_file').val(attachment.id);
			$('#term_transcription_file_wrapper').html(pdfIconHtml + attachment.filename);
		});

		mediaUploader.open();
	});

	// Remove image button
	$('#term_transcription_file_remove').click(function () {
		$('#term_transcription_file').val('');
		$('#term_transcription_file_wrapper').html('');
	});
});
