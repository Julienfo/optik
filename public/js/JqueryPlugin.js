$(document).ready(function () {

	//----- PRELOADER
	/*
	$(window).on('load', function () { // makes sure the whole site is loaded 
		$('#status').fadeOut(50000); // will first fade out the loading animation 
		$('#preloader').delay(2000).slideToggle('slow'); // will fade out the white DIV that covers the website. 
		$('body').delay(350).css({
			'overflow': 'visible'
		});
	})*/

	//----- FULLPAGE

	$('.fullpage').fullpage({
		navigation: true,

	});

	//----- INFOBULLE ADMINISTRATION

	$(function () {
		$(".open-event").tooltip({
			show: null,
			position: {
				my: "left top",
				at: "left bottom"
			},
			open: function (event, ui) {
				ui.tooltip.animate({
					top: ui.tooltip.position().top + 10
				}, "fast");
			}
		});
	});

	
	//----- RESERVATION GENERER UN INPUT
	$(function () {

		$(document).keypress(function (e) {
			if (e.which == 13) {
				var entrer = $('<input>');
				entrer.attr('type', 'text');
				entrer.attr('class', 'input_reserve');
				entrer.attr('name', 'nom_du_nouveau_champ');
				entrer.attr('placeholder', 'Reference materiel reserver');
				entrer.appendTo('.reserve_bloc_input');
			}
		});

		$('#plus').click(function () {
			var champ = $('<input>');
			champ.attr('type', 'text');
			champ.attr('class', 'input_reserve');
			champ.attr('name', 'nom_du_nouveau_champ');
			champ.attr('placeholder', 'Reference materiel reserver');
			champ.appendTo('.reserve_bloc_input');
		});
		
		//----- SUPPRIMER UN INPUT
		$('#moins').click(function () {
			$('.input_reserve').last().remove();
		});
				
	});
	
	//----- SLIDE RESERVATION
	$(function () {
		
	$('.reserv_valid_slide').click(function() {
	$( '.page_slider').slideToggle();
		});
		
	$('#reserv_slider_no').click(function() {
	$( '.page_slider').slideToggle("slow");
	});
		
});
	
	//----- SLIDE ADMINISTRER
	$(function () {


	$('.column7').click(function() {
		$( '.page_slider').slideToggle();

		var id = $(this).attr('data-id');

		$('.reserv_slider_yes').html("<a href='/remove_mat/"+id+"' id='reserv_slider_yes' style='color:#000; background-color: lawngreen;' ><i class='fa fa-check'></i>Oui</a>");

	});
		
	$('.page_slider_no').click(function() {
	$( '.page_slider').slideToggle("slow");

	});
		
});

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

});
