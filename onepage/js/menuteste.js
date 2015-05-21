
$(document).ready(function(){

    $(".nav.navbar-nav ul").hover(
	
	    function(){
		    $('ul', this).fadeIn();

		    
		},
		
		function(){
		   $('div', this).fadeOut();
		}
	
	);

});