$(document).ready(function(){
	//init
	$('.dv_form').hide();
	$('#form_audios').show();

	$('[data-toggle="pop_ayuda"]').popover({
        html : true,
        title: function() {
          return $("#popover-head").html();
        },
        content: function() {
          return $("#popover-content").html();
        }
    });

	$('[data-toggle="popover"]').popover();
	$('[data-toggle="pop_ayuda"]').popover();


	$(function(){

		var nav_tabs = $('#nav_tabs');

    	nav_tabs.delegate('li.inactive','click',function(e){
    		$('.dv_form').hide();
	        nav_tabs.find('.active').toggleClass('active inactive');
	        $(this).toggleClass('active inactive');
	        switch( $(this).attr('id') ) {
			    case 'tab_1':
			    		$('#form_audios').show();
			        break;
			    case 'tab_2':
			    		$('#form_audiovisuales').show();
			        break;
			    case 'tab_3':
			    		$('#form_proyectos').show();
			    	break;
			     case 'tab_4':
			    		$('#form_imagenes').show();
			    	break;
			}

    	});

	});


});