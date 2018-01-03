class Backgrounder {
	constructor(target, size)	{
		this.target = ( !target ? jQuery('[data-background]') : target );
		this.size = ( !size ? 'small' : size );
	};
	
	make(size) {
		if( !size ) size = this.size;
		
		jQuery(this.target).each(function(args){
			
			var feat	 	= jQuery(this).find('.feature');
			var target  = feat;
			if(feat.length <= 0) target = jQuery(this);
			
			var img 		= false, 
					is_img 	= jQuery(this).hasClass('format-image');

			if(feat.length > 0) {
				img = jQuery(feat).find('img');
			}else{
				img = jQuery(this).find('img');
			}
			
			if(img.length > 0) {
				var src = jQuery(img).attr('src');

				if(jQuery(img).attr('data-src-xlarge') && size == 'xlarge') src = jQuery(img).attr('data-src-xlarge');
				if(jQuery(img).attr('data-src-large') && size == 'large') src = jQuery(img).attr('data-src-large');
				if(jQuery(img).attr('data-src-medium') && size == 'medium') src = jQuery(img).attr('data-src-medium');
				if(jQuery(this).attr('style')){
						if(feat.length > 0) {
							jQuery(feat).css('background-color',jQuery(this).css('background-color'));
							jQuery(feat).delay(300).fadeOut(300);
						}
						jQuery(this).css({'background-image': 'url('+src+')'});
				}else{
					jQuery(this).css({'background-image':'url('+src+')', 'background-color':jQuery(this).css('background-color')});
					if(feat.length > 0) {
						jQuery(feat).delay(300).fadeOut(300);
					}
				}
			}
		});
	}
	
}