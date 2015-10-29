$(document).ready(function(){

    $(".nav.navbar-nav li").hover(
	
	    function(){
		    $('ul', this).fadeIn();

		    console.log("OIEEEEEE");
		},
		
		function(){
		   $('ul', this).fadeOut();
		}
	
	);

});