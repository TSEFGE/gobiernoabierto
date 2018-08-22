$(document).ready(main);
 
var contador = 1;
var fuera = 0;


function main () {
	$('.menu_bar').click(function(){
		if (contador == 1) {
			$('nav').animate({
				left: '0'
			});
			contador = 0;
			fuera=1;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
			$('#submenudetenidos').children('#mdetenidos').slideUp();
			$('#submenudesaparecidos').children('#mdesaparecidos').slideUp();	
		}
	});


	$('.conta').click(function(){
		
			contador = 1;
			$('nav').animate({
				left: '-100%'
				});
			$('#submenudetenidos').children('#mdetenidos').slideUp();
			$('#submenudesaparecidos').children('#mdesaparecidos').slideUp();	
		
	});
 
	// Mostramos y ocultamos submenus
	/*
	$('.submenu').click(function(){
		$(this).children('.children').slideToggle();
	});
	*/

	$('#submenudesaparecidos').click(function(){
		$(this).children('#mdesaparecidos').slideToggle();
		
		$('#submenudetenidos').children('#mdetenidos').slideUp();	
	});

	$('#submenudetenidos').click(function(){
		$(this).children('#mdetenidos').slideToggle() ;
		$('#submenudesaparecidos').children('#mdesaparecidos').slideUp();	
	});
}