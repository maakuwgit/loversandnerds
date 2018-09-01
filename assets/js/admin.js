/* global screenReaderText */
/**
 * Theme admin functions file.
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 1.4
 */

( function( $ ) {
	var breakpoint = new Breakpoints(),
			gallery = [],
			ids 		= [],
			used 		= $('#used_images a[data-href]');
			
	if ( used ) {
		$(used).each(function() {
			ids.push($(this).attr('data-href'));
		});
	}

	function init(event){
		$('[data-add]').on('click.addImage', addImage);
		
		function addImage(event){
			event.preventDefault();
			$(this).off('addImage');
			
			var add 			= $(this),
					figure 		= $(this).parents('figure'),
					subtract 	= $(this).parent().siblings().find('[data-remove]'),
					anchor 		= $(figure).find('[data-href]'),
					target 		= $(figure).parent(),
					id 				= $(anchor).attr('data-href');
			
			$(add).hide();
					
			gallery.push($(target).detach());
			ids.push(id);
			
			$('#used_images').siblings('legend').show();
			$('#used_images').append(target);
			
			$('#lons_gallery').val(ids);
			$(subtract).delay(150).fadeIn(150);
		}
		
		$('[data-remove]').on('click.removeImage', removeImage);
		
		function removeImage(event){
			event.preventDefault();
			
			$(this).off('removeImage');
			
			var subtract  = $(this),
					figure 		= $(this).parents('figure'),
					add 			= $(this).parent().siblings().find('[data-add]'),
					anchor 		= $(figure).find('[data-href]'),
					target 		= $(figure).parent(),
					id 				= $(anchor).attr('data-href'),
					gid 			= gallery.indexOf(target),
					iid 			= ids.indexOf(id);
				
			$(subtract).hide();
			$(add).delay(150).fadeIn(150);
			
			if(gid > -1) gallery.splice(target, 1);
			if(iid > -1) {
				if (ids.length > 1) {
					ids.splice(iid, 1);
					txt = ids;
				}else{
					ids = [];
					txt = '';
					$('#used_images').siblings('legend').hide();
				}
			}
			
			$('#available_images').append(target);
			$('#lons_gallery').val(txt);
			$(add).delay(150).fadeIn(150);
		}
	}
	
	$(document).ready(function(){
		init(false);
	});
		
} )( jQuery );
