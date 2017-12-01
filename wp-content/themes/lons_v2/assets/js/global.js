( function( $ ) {
	var return_top = $(window).scrollTop();
	var vw, vh = 0;
	var breakpoint = new Object();
	breakpoint.small = 420;
	breakpoint.medium = 768;
	breakpoint.large = 1024;
	breakpoint.xlarge = 1600;
	
	function setSize(){
		vw = $(window).width();
		vh = $(window).height();
	}
	
	function getSize(){
		if(vw >= breakpoint.xlarge){
			return 'fullsize';
		}else if(vw >= breakpoint.large && vw < breakpoint.xlarge) {
			return 'large';	
		}else if(vw > breakpoint.small && vw < breakpoint.large) {
			return 'medium';
		}else{
			return 'small';
		}
	}
	
	function refactor(event){
		setSize();
		setBg();
	}	
	
	function setHash(){		
		var hash = window.location.hash,
				anchor = $('a[href="'+hash+'"]'),
				slide = sections.indexOf(hash.substr(1));

		if(hash){
			if(anchor.length > 0){
				$(anchor).trigger('click');
			}else if(slide !== -1){
				TweenMax.to(window, 1, {scrollTo:'#home_wellness', onComplete:function(){
					TweenMax.to($('#home_wellness'), 0.3, {scrollTo:{x:positions[slide]}, onComplete:function(){
				    var callout = $('#'+sections[slide]).next();
				    if( callout ) $(callout).addClass('in');
				  }});	
				}});
			}
		}
	}
	
	function setBg() {
		$('[data-background]').each(function(args){
			var size 		= getSize();
			var feat	 	= $(this).find('.feature');
			var is_img 	= $(this).hasClass('format-image');
			var img 		= false;
			if(feat.length > 0) {
				img = $(feat).find('img');
			}else{
				img = $(this).find('img');
			}
			if(img.length > 0) {
				var src = $(img).attr('src');
				if($(img).attr('data-src-xlarge') && size == 'xlarge') src = $(img).attr('data-src-xlarge');
				if($(img).attr('data-src-large') && size == 'large') src = $(img).attr('data-src-large');
				if($(img).attr('data-src-medium') && size == 'medium') src = $(img).attr('data-src-medium');
				if($(this).attr('style')){
						if(feat.length > 0) $(feat).delay(300).fadeOut(300);
						$(this).css('background-image', 'url('+src+')');
				}else{
					$(this).css({'background-image':'url('+src+')', 'background-color':$(this).css('background-color')});
					if(feat.length > 0) $(feat).delay(300).fadeOut(300);
				}
			}
		});
	}
	
	function openMenu(event){
		return_top = $(window).scrollTop();
		var target = $(this).data('toggle');
		$('#'+target).toggleClass('collapsed');
	}
	
	function init(){
		refactor();
		$('[data-toggle]').on('click.openMenu', openMenu);
		$('[data-href]').on('click', function(event){
			window.open($(this).attr('data-href'), '_self');
		});
	}
	
	$(document).ready(init);
	
})( jQuery);