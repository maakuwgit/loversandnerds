(function($){
	$(document).ready( function(){
		$('#postdivrich').hide();
		$('label[rel="link"]').hide();
			
		$image_settings_box = $( '#image_settings' ),
		$gallery_settings_box = $( '#gallery_settings' ),
		$post_format_cb	= $( 'input.post-format' );
		
		function checkFormat( event ){
			var $target = $('input.post-format:checked');
			
			switch ( $target.attr( 'id' ) ) {
				case 'post-format-image':
					$image_settings_box.show();
					$gallery_settings_box.hide();
					$('#postdivrich').hide();
					$('label[rel="link"]').hide();
					break;
				case 'post-format-gallery':
					$gallery_settings_box.show();
					$image_settings_box.hide();
					$('#postdivrich').hide();
					$('label[rel="link"]').hide();
					break;
				case 'post-format-link':
					$gallery_settings_box.hide();
					$image_settings_box.hide();
					$('label[rel="link"]').show();
					$('#postdivrich').hide();
					break;
				default:
					$('#postdivrich').show();
					$image_settings_box.hide();
					$gallery_settings_box.hide();
					break;
			}
		}

		$('[name="lons_project_color"]').wpColorPicker();
		$post_format_cb.click( checkFormat );
		
		checkFormat();
		
	} );
})(jQuery)