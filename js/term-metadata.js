jQuery(document).ready(function($) {
  // Media Uploader
  var mediaUploader;

  $('#term_feature_image_button').click(function(e) {
    e.preventDefault();

    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media({
      title: 'Choose Feature Image',
      button: {
        text: 'Use this image'
      },
      multiple: false
    });

    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#term_feature_image').val(attachment.id);
      $('#term_feature_image_wrapper').html('<img src="' + attachment.url + '" style="max-width:300px;height:auto;">');
    });

    mediaUploader.open();
  });

  // Remove image button
  $('#term_feature_image_remove').click(function() {
    $('#term_feature_image').val('');
    $('#term_feature_image_wrapper').html('');
  });
});