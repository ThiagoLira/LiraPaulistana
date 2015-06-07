
$(document).ready(function(){

    $("#teste3").hover(
	
	    function(){
		    $("#logbar").fadeIn();

		    	console.log("OIEEEEEE");
		    
		},
		
		function(){
		   $("#logbar").fadeOut();
		}
	
	);

});



$(document).ready(function(){
    
    $("a").hover(
        //var li = $("li");

				function(){
					
					$(this).animate({fontSize: '32px'}, "slow");


					},
				function(){

					$(this).animate({fontSize: '18px'}, "fast");




					}
	
        //li.animate({height: '300px', opacity: '0.4'}, "slow");
        //li.animate({width: '300px', opacity: '0.8'}, "slow");
        //li.animate({height: '100px', opacity: '0.4'}, "slow");
        //li.animate({width: '100px', opacity: '0.8'}, "slow");
    );
});




//".nav.navbar-nav div"
//".nav.navbar-nav li"