(function($){
	$(document).ready( function(){
			
		$anchors = $( '#theme-tabs a' ),
		$visuals = $( '#theme-visuals' ),
		$options = $( '#theme-options' );
		
		function checkTab( event ){
			event.preventDefault();
			var $target = $(this).attr( 'href' );
			$(this).parent().addClass('tabs').siblings().removeClass('tabs');
			switch ( $target ) {
				case '#theme-options':
					$options.show();
					$visuals.hide();
					break;
				case '#theme-visuals':
				default:
					$visuals.show();
					$options.hide();
					break;
			}
		}

		$anchors.click( checkTab );
		
	} );
})(jQuery)