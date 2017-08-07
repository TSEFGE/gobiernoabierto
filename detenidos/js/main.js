$(document).ready(main);
 
var contador = 1;



function main () {
	$('.menu_bar').click(function(){
		if (contador == 1) {
			$('nav').animate({
				left: '0'
			});
			contador = 0;
			
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
			$('#submenudetenidos').children('#detenidos').slideUp();
			$('#submenudesaparecidos').children('#desaparecidos').slideUp();	
		}
	});


	$('.conta').click(function(){
		
			contador = 1;
			$('nav').animate({
				left: '-100%'
				});
			$('#submenudetenidos').children('#detenidos').slideUp();
			$('#submenudesaparecidos').children('#desaparecidos').slideUp();	
		
	});
 
	// Mostramos y ocultamos submenus
	/*
	$('.submenu').click(function(){
		$(this).children('.children').slideToggle();
	});
	*/

	$('#submenudesaparecidos').click(function(){
		$(this).children('#desaparecidos').slideToggle();
		
		$('#submenudetenidos').children('#detenidos').slideUp();	
	});

	$('#submenudetenidos').click(function(){
		$(this).children('#detenidos').slideToggle() ;
		$('#submenudesaparecidos').children('#desaparecidos').slideUp();	
	});
}