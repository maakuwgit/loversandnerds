/* global screenReaderText */
/**
 * Theme functions file.
 *
 * @package WordPress
 * @subpackage Delos_Microsite
 * @since Delos Microsite 0.1.0
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	var vw,vh,
			backgrounder = new Backgrounder(),
			breakpoint = new Breakpoints(),
			gallery = $('.gallery'), 
			positions = [], scenes = [], sections = [],
			trigger = $('main figure, article section[data-scroll] > figure'), 
			figures = $('[data-scroll="horizontal"] figure'), 
			numSections = $(figures).length,
			controller;
	
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
			
	function setupScrollMagic(event){
		if(typeof ScrollMagic !== 'undefined') {
			var is_mobile = ( getSize() == 'small' ? true : false ),
					is_tablet = ( getSize() == 'medium' ? true : false );

			var logoscene = new ScrollMagic.Scene({
				  triggerElement: '#top', 
				  duration: '50%', 
				  tweenChanges: false,
				  reverse: true
				}).setClassToggle('#logo_svg', 'active');
				
			scenes.push(logoscene);
				
			//Push all the image wrappers into our arrays for later reference
			$(figures).each( function(f){
				positions[f] = $(this).offset().left;
				sections[f] 	= $(this).attr('id');
			});
			
			//Sets the active state for anchors		
			$('main, body > article, body > section').each(function(){
				if( $(this).attr('id') !== 'undefined' ) {
					duration = $(this).outerHeight();
					var offset = 0;
					var anchor = '#anchor-'+$(this).attr('id');
					if( $(this).attr('id') ){
						var ascene = new ScrollMagic.Scene({
						  triggerElement: '#'+$(this).attr('id'), 
						  duration: '100%', 
						  tweenChanges: false,
						  reverse: true,
						  offset:offset
						}).setClassToggle(anchor, 'active');
						
						scenes.push(ascene);
					}
				}
			});
				
			if ( !is_mobile  && !is_tablet){
				$('#evidence').css({'right': -1 * $('#evidence').outerWidth()});
				
				var pullSidequote = new TimelineMax()
														.add(TweenMax.to($('#evidence'), 0.025, {right: 0, opacity:1, ease:Linear.easeNone, onStart:function(){
																if( $('#evidence').css('opacity') < 1) $('#evidence').removeClass('in');
															}, onComplete:function(){
																$('#evidence').addClass('in');
															}
														}));
									
				var circscene = new ScrollMagic.Scene({
									  triggerElement: '#circadian_day', 
									  duration: $('#evidence').height()/2, 
									  tweenChanges: true,
									  reverse: true,
									}).setTween(pullSidequote)
									.setClassToggle('#evidence', 'in');
				
				scenes.push(circscene);
				
				var tsscene = new ScrollMagic.Scene({
				  triggerElement: '#top_scroll', 
				  duration: $('#top_scroll').outerHeight(), 
				  tweenChanges: true,
				  reverse: true,
				}).setClassToggle('#chopraDiv, #clintonDiv', 'in');
				
				scenes.push(tsscene);
									
				$(trigger).each( function(s){
					if(!event){
						var callouts 	= $(this).siblings('.callout'),
								img 			=	$(this).find('img').one(), 
								duration 	= 0, 
								targets 	= '';

						if(callouts){
							callouts.each(function(i){ 
								targets += '#' + $(this).attr('id');
								if(i + 1 < callouts.length) targets += ', ';
							});
						}
		
						if(typeof ScrollMagic !== 'undefined') {
							if( $(this).attr('id') !== 'undefined' ) {
								duration = $(this).outerHeight();
								if( $(this).attr('id') ){
									var cscene = new ScrollMagic.Scene({
									  triggerElement: '#'+$(this).attr('id'), 
									  duration: duration, 
									  tweenChanges: true,
									  reverse: true,
									}).setClassToggle(targets, 'in');
									
									scenes.push(cscene);
								}
							}
							
							if( $(img).attr('id') !== 'undefined' ){
								duration = ( $(img).outerWidth() > 0 ? $(img).outerWidth() : $(window).height() );
								if( !$(img).data('direction') ){
									$(img).css('margin-left', '-100vw');
									
									var pullLeft = new TimelineMax()
										.add(TweenMax.to($(img), 0.025, {marginLeft: 0, ease:Linear.easeNone}));
							
									var iscene = new ScrollMagic.Scene({
									  triggerElement: '#'+$(img).attr('id'), 
									  offset: $(window).height() * -1, 
									  duration: duration, 
									  tweenChanges: true,
									  reverse: true,
									})
									.setTween(pullLeft)
									.setClassToggle('#'+$(img).attr('id'), 'in');
								}else{
									$(img).css('margin-left', '100vw');
									
									var pullRight = new TimelineMax()
										.add(TweenMax.to($(img), 0.025, {marginLeft: 0, ease:Linear.easeNone}));
							
									var iscene = new ScrollMagic.Scene({
									  triggerElement: '#'+$(img).attr('id'), 
									  offset: $(window).height() * -1, 
									  duration: duration, 
									  tweenChanges: true,
									  reverse: true,
									})
									.setTween(pullRight);
								}
								scenes.push(iscene);
							}
						}
					}
				});
			}else{
				$('[data-pan]').css('background-position-x', 0);
				
				var panLeft = new TimelineMax()
											.add(TweenMax.to($('[data-pan]'), 0.025, {backgroundPositionX: '-100vw'}));
				
				var cp = '#circadian_parallax';
				var panscene = new ScrollMagic.Scene({
									  triggerElement: cp,
									  duration: '100%',
									  tweenChanges: true,
									  reverse: true,
									  offset: $(cp).height()/4 * -1
									})
									.setTween(panLeft);
				
				scenes.push(panscene);
			}
		}
	}

	function initScrollMagic(size){
		if(typeof ScrollMagic !== 'undefined') {
			controller = new ScrollMagic.Controller();
		
			setupScrollMagic();
		
			$(window).off('resize.setSM').on('resize.setSM', setupScrollMagic);
		
		}
		
		$.fn.activate = function(active){
			$('header a').removeClass('active');
			if(active){
				$(this).addClass('active');
			}
		}
		
		$('[data-anchor]').off('click.jumpTo').on('click.jumpTo', jumpTo);
		
		//  Bind anchors
		$('#nextBtn').off('click').on('click.gotoNext', gotoNext);
		$('#prevBtn').off('click').on('click.gotoPrev', gotoPrev);

		setTimeout(function(){	
			for (s = 0; s < scenes.length; s++){
				controller.addScene(scenes[s]);
			}
//			setHash();
		}, 300);
		
	}
		
	function jumpTo(event){
		event.preventDefault();
		$(this).activate(true);
		var anchor = '#'+$(this).data('anchor'),
				speed = $(window).height()/$(anchor).height(),
				topY = $(anchor).offset().top - $('#masthead').outerHeight();
				
		speed = ( speed ? speed.toFixed(2) : 0.5 );
		
		TweenMax.to(window, speed, {scrollTo:{
          y: topY, 
          autoKill: true
      }, ease:Power3.easeOut
    });
					
    // If supported by the browser we can also update the URL
    if (window.history && window.history.pushState) {
      history.pushState("", document.title, anchor);
    }
	}
	
	/* Gallery */
	if( gallery ) {
		var figs 		= gallery.find('figure'),
				current = gallery.find('figure:first-of-type');

		if(current){
			current.addClass('active');
			current.find('.callout').addClass('in');
		}
		
		function activate(active, fig, immediately = false){
			active.removeClass('active');
			fig.addClass('active').removeClass('deactive');
			fig.find('.callout').addClass('in');
		}

		function gotoNext(event) {
			event.preventDefault();
			$('#prevBtn').removeClass('disabled');
			current = gallery.find('.active');
			if(current.length < 1){
				current = gallery.find('figure:first-of-type');
				$('#prevBtn').addClass('disabled');
			}
			if(current){
				next = current.next('figure');
				if(next.length > 0){
					activate(current, next);
					if(next.next('figure').length <= 0 ){
						$('#nextBtn').addClass('disabled');
					}else{
						$('#nextBtn').removeClass('disabled');
					}
				}
			}
		}
	
		function gotoPrev(event) {
			event.preventDefault();
			$('#nextBtn').removeClass('disabled');
			current = gallery.find('.active');
			if(current.length < 1){
				current = gallery.find('figure:last-of-type');
				$('#nextBtn').addClass('disabled');
			}
			if(current){
				prev = current.prev('figure');
				if(prev.length > 0){
					activate(current, prev);
					if(prev.prev('figure').length <= 0 ){
						$('#prevBtn').addClass('disabled');
					}else{
						$('#prevBtn').removeClass('disabled');
					}
				}
			}
		}
	}
	
	function setSize(){
		vw = $(window).width();
		vh = $(window).height();
	}
	
	function getSize(){
		var size = 'small';
		if(vw >= breakpoint.xlarge){
			size = 'fullsize';
		}else if(vw >= breakpoint.large && vw < breakpoint.xlarge) {
			size = 'large';	
		}else if(vw > breakpoint.small && vw < breakpoint.large) {
			size = 'medium';
		}
		return size;
	}
	
	function refactor(event){
		setSize();
		var size = getSize();

		backgrounder.make(size);
	}

	function init(event){
//		if(typeof Parallax !== 'undefined') setupParallax(event);
		$(window).off('resize.refactor').on('resize.refactor', refactor);
		
		refactor(event);

		initScrollMagic(getSize());
	}
	
	function setupParallax(event){
		var main = $('#top').get(0);
		var mainParallax = new Parallax(main);
	}
	
	$(document).ready(function(){
		init(false);
	});
		
} )( jQuery );