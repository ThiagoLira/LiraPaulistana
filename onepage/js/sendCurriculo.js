var myfile="";

$('#resume_link').click(function( e ) {
    e.preventDefault();
    $('#resume').trigger('click');
});

$('#resume').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   if(ext=="pdf"){
       alert(ext);
   } else{
       alert(ext);
   }
});