jQuery(function() {	
	$( $('.stagger .pulsation').get().reverse() ).each(function(i){
		var delay = ((i*50) + 1550) + 'ms';
		$(this).css({'-webkit-animation-delay': delay, '-moz-animation-delay': delay, '-o-animation-delay': delay, 'animation-delay': delay});
	});
});	
var dropIt,
		percs = [0,'25%','50%'],
		drop1 = $('#biopsy path.drop').first(),
		drop2 = drop1.next('.drop');
		drop3 = drop2.next('.drop');
		drops = [drop1,drop2,drop3],
		i = 0,
		firstRun = true;
		
drop2.css('display','none');
drop3.css('display','none');

function droplets(){
	dropIt = setInterval(function(){
		if(i < 3){
			jQuery( drops[i] ).css('display','initial').attr('class',jQuery( drops[i] ).attr('data-class'));
			jQuery('#needle').css({'transform': 'translateX('+percs[i]+')'});
			i++;
		}else{
			jQuery('#needle').removeAttr('style');
			setDroplets();
			i = 0;
		}
	}, 1000);
}

function setDroplets(){
	jQuery.each(drops, function(){
		jQuery(this).attr('data-class',$(this).attr('class')).removeAttr('class').css('display','none');
	});
}