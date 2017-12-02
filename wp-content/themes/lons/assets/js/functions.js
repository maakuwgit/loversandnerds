/* global screenReaderText */
/**
 * Theme functions file.
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 1.7.3
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	var vw,vh,
			backgrounder = new Backgrounder(),
			breakpoint = new Breakpoints();
			is_dev = true;
			
//Dev Note: Is this still relevant?	
	$('.menu.nested').attr({'data-submenu':'','aria-hidden':true,'role':'tabpanel'});
	
	function initScrollMagic(){
		var curr = 0, next = 1, 
				positions = [], scenes = [], sections = [], 
				numSections = $('main .entry-content').length,
				first_run = true,
				controller;
				if(typeof ScrollMagic !== 'undefined') controller = new ScrollMagic.Controller();
		
		function setupScrollMagic(event){
			if(!$('body').hasClass('wp-admin')) {
				$('main .entry-content').each( function(s){
					positions[s] = $(this).offset().top;
					if(!event){
						sections[s] = $(this).attr('id');
						var duration = $(this).outerHeight();
						var target = $(this);
						if(typeof ScrollMagic !== 'undefined') {
								var scene = new ScrollMagic.Scene({
							  triggerElement: '#'+$(this).attr('id'), // starting scene, when the section
							  duration: duration // do the thing for the element for its total height
							}).on('enter', function(event){
								if(first_run == false){
									setNext(s + 1);
								}
							}).on('leave', function(event){
							});
					
							scenes.push(scene);
						}
					}
				});
				var scene = new ScrollMagic.Scene({
					triggerElement: '#lans_instagram',
					offset: -1.5*$('#portfolios').outerHeight(), 
				}).on('enter', function(event){
					$('.home .entry-content:first-of-type').addClass('unfix');
				}).on('leave', function(event){
					$('.home .entry-content:first-of-type').removeClass('unfix');
				});
				
				scenes.push(scene);
			}
		}
		
		setupScrollMagic();
		$(window).on('resize.setSM', setupScrollMagic);
				
		if(typeof ScrollMagic !== 'undefined') {
			controller.scrollTo(function(target) {
			  TweenMax.to($('.site-inner'), 0.75, {
			    scrollTo : {
			      y : target,
			      offsetY : $('#masthead').outerHeight(),
			      autoKill : true
			    },
			    ease : Strong.easeOut,
			    onComplete: function(x){
				    //animate in the ellipsis
				  }
			  });
		
			});
		}else{			
			$('#nextBtn').off('click').addClass('disabled');
		}
		function setNext(to) {
			if(!$('body').hasClass('single')){
				if(to == numSections){
					if( !$('body').hasClass('archive') ) $('#masthead').addClass('bottom');
//					$('#content > a').stop().addClass('disabled');
					$('#nextBtn').stop().off('click').addClass('disabled');
				}else{
					next = to;
					curr = to - 1;
					if( !$('body').hasClass('archive') ) $('#masthead').removeClass('bottom');
//					$('#content > a').stop().removeClass('disabled');
					$('#nextBtn').attr("data-href",sections[to]).stop().removeClass('disabled').off('click').on('click', gotoNext);
				}
			}
		}
	
		function gotoNext(e) {
			if(curr == numSections) return;
		  var id = '#' + $(this).attr('data-href');
	
		  if($(id).length > 0) {
		    e.preventDefault();
	
		    // trigger scroll
		    controller.scrollTo(positions[next]);
	
		    // If supported by the browser we can also update the URL
		    if (window.history && window.history.pushState) {
		      history.pushState("", document.title, id);
		    }
	
		    curr++;
		    next++;
				setNext(next);
		  }
	
		}
		
		//  Bind anchors
		$('#nextBtn').on('click', gotoNext);
			
		$('[href*="#"]').on('click', function(event){
			event.preventDefault();
			$('main').toggleClass('social-active');
			$(this).toggleClass('active');
			$($(this).attr('href')).toggleClass('active');
		});
	
		setTimeout(function(){
			first_run = false;		
			for (s = 0; s < scenes.length; s++){
				controller.addScene(scenes[s]);
			}
		}, 300);	

	}
//Dev Note: come back to fix the 'snap-to' functionality
	function toggleContent(event){
		var target = $(this).attr('data-show-id');
				
		if(target){
			$('main > button, .off-canvas-content > a, .off-canvas-content > .scrollmagic-pin-spacer a').toggleClass('inactive');
//			$(offcan).toggleClass('fixed');
			$('#'+target).toggleClass('active');
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
		//Dev Note: Create a date attr for the size and only call 'backgrounder' once per size.
		backgrounder.make(size);
		if( !$('body').hasClass('single') && is_dev === false ){
			if(size !== 'small'){
				$('#content, #masthead').on('mouseenter', function(){$(this).addClass('enter');});
				$('#content, #masthead').on('mouseleave', function(){$(this).removeClass('enter');});
			}else{
				$('#content, #masthead').off('mouseenter');
				$('#content, #masthead').off('mouseleave');
			}
		}
	}

	function init(event){
		$('button.ellipsis, .button.ellipsis').click(toggleContent);
		$(window).on('resize.refactor', refactor);
		$('[data-href]').on('click', function(event){
			window.open($(this).attr('data-href'), '_blank');
		});
		
		$('#content').addClass('enter');
		if(is_dev) $('#masthead').addClass('enter');
		
		$('[data-hover-target]').hover(function(){
			$('[rel="default"]').addClass('inactive');
			$('[data-hover="'+$(this).data().hoverTarget+'"]').addClass('active');
		}, function(){
			$('[rel="default"]').removeClass('inactive');
			$('[data-hover]').removeClass('active');
		});
		
		var figcaption = $('.title-bar-title'),
				title = figcaption.find('figcaption').text(),
				lovers = title.substr(0, title.search(' ')),
				nerds = title.substr(title.search(' ') + 3);
		
		if(	!$('body').hasClass('archive') && !$('body').hasClass('wp-admin')){
			if(!$('body').hasClass('single'))$('h1').html('<span class="unicorns">'+lovers+'</span> & <span class="chava">'+nerds+'</span>');
			$(figcaption).html('<span class="unicorns">L</span><span class="plus">+</span><span class="chava">N</span>');
		}
		
		refactor(event);
		initScrollMagic();
	}
	
	$(document).ready(function(){
		init(false);
	});
		
} )( jQuery );
