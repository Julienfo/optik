	$(window).on('load', function() { 
		//$('.loader').delay(800).slideUp('slow'); // will fade out the white DIV that covers the website. 
		$(".loader").delay(800).animate({width:'toggle'},1850);
		$('body').delay(350).css({
			'overflow': 'visible'
		});
	});