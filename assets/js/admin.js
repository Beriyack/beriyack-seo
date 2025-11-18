jQuery(document).ready(function($) {
	'use strict';

	var mediaUploader;

	$('#upload_image_button').on('click', function(e) {
		e.preventDefault();
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: beriyack_seo_admin.media_uploader_title, // Chaîne localisée
			button: { text: beriyack_seo_admin.media_uploader_button }, // Chaîne localisée
			multiple: false
		});
		mediaUploader.on('select', function() {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#og_image_id').val(attachment.id);
			$('#og-image-preview').attr('src', attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url).show();
			$('#remove_image_button').show();
		});
		mediaUploader.open();
	});

	$('#remove_image_button').on('click', function(e) {
		e.preventDefault();
		$('#og_image_id').val('');
		$('#og-image-preview').attr('src', '').hide();
		$(this).hide();
	});
});
