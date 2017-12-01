(function($){
	$(document).ready( function(){
			
		$project_settings_box = $( '#project_settings' ),
		$project_cb	= $( '#lons_is_project' );
		
		function checkProject( event ){
			$project_settings_box.toggleClass('hidden');
		}

		$project_cb.click( checkProject );
		if(!$project_cb.is(':checked') ) $project_settings_box.addClass('hidden');
		
	} );
})(jQuery)