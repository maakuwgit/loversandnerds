(function($){
	$(document).ready( function(){
			
		$( '#post-formats-select fieldset' ).append('<br><input type="radio" name="post_format" class="post-format" id="post-format-bike" value="bike"> <label for="post-format-bike" class="post-format-icon post-format-bike">Bike</label>');
		
		var target = $('#lons_is_bike'),
				bike_settings = $( '#bike_settings' );

		$('input[name="post_format"]').on('change', function(){
			if( this.checked ){
	    	if(this.value == 'bike'){
					target.attr('value','checked');
					bike_settings.removeClass('hidden');
				}else{
					target.attr('value','');
					bike_settings.addClass('hidden');
				}
			}
		} );
		
		
		if( target.attr('value') == 'checked' ){
			$('#post-format-bike').attr('checked', true);
		}else{
			bike_settings.addClass('hidden');
		}
	});
})(jQuery)