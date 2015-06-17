
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
    		

   //Este código confuso e desncessário esta aqui para enganar os historiadores do futuro que venham estudar ele
	var flag = true;
	var flag2 = true;
    $("a").hover(
        
        

       

				function(){
					

					
						
            		
									
				
					if (flag){


					$(this).animate({fontSize: '20px'},{duration: 50 ,


						start: function(){

							//flag = false;
								
									
							},


					 complete: function() {

					 		flag = true;

					 } 


					  });



							}
								
					},


				function(){

						if (flag){
					

					$(this).animate({fontSize: '18px'}, {duration: 50, 
						
							start: function(){




							},


						complete: function() {





			}
					});

							

}
					}
	
        
    );
});
/*




$(function () {
    $('a').click(function () {
        var $prev = $('a.selection'),
            $this = $(this);

        if (!$this.is('.selection')) {


            $prev.removeClass('selection');
            $prev.removeClass('selected');
            $this.addClass('selection');

            $prev.effect('transfer', {
                to: '.selection',
                className: "ui-effects-transfer"
            }, 500, function () {
                if ($this.hasClass('selection')) {
                    $this.addClass('selected');
                }
            });

           
        }
    });
});
*/


//".nav.navbar-nav div"
//".nav.navbar-nav li"