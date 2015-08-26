
function changeColor(element){


 	var $this   = $(element);



if($this.css("background-color")==="rgb(255, 0, 0)"){
	
	$this.css("background-color", "green");

}
else if ($this.css("background-color")=="rgb(0, 128, 0)"){
	$this.css("background-color", "red");
}


}



function salvar(){

var matrizCores = new Array(11);

for(var i=0; i<11; i++) {
    matrizCores[i] = new Array(5);
}


for (var i=0 ; i < 11; i++) {    //percorre matriz de horarios salvando dados no formato 1==disponivel 0== no disponivel
	
	for(var j=0;j<5;j++){

		switch (j){
 	case 0:
        id = "Seg".concat((i+1).toString()); //fabrica o id de cada celula 
                    if($("#"+id).css("background-color")==="rgb(255, 0, 0)"){ //eh vermelho == 0
						
					matrizCores[i][j]= 0;	

					}else if ($("#"+id).css("background-color")=="rgb(0, 128, 0)"){ //eh verde == 1 
					matrizCores[i][j]= 1;	
					}
        break;
    case 1:
        id = "Ter".concat((i+1).toString());
					if($("#"+id).css("background-color")==="rgb(255, 0, 0)"){ //eh vermelho == 0
						
					matrizCores[i][j]= 0;	

					}else if ($("#"+id).css("background-color")=="rgb(0, 128, 0)"){ //eh verde == 1 
					matrizCores[i][j]= 1;	
					}
        break;
    case 2:
        id = "Qua".concat((i+1).toString());
                    if($("#"+id).css("background-color")==="rgb(255, 0, 0)"){ //eh vermelho == 0
						
					matrizCores[i][j]= 0;	

					}else if ($("#"+id).css("background-color")=="rgb(0, 128, 0)"){ //eh verde == 1 
					matrizCores[i][j]= 1;	
					}
        break;
    case 3:
        id = "Qui".concat((i+1).toString());
                    if($("#"+id).css("background-color")==="rgb(255, 0, 0)"){ //eh vermelho == 0
						
					matrizCores[i][j]= 0;	

					}else if ($("#"+id).css("background-color")=="rgb(0, 128, 0)"){ //eh verde == 1 
					matrizCores[i][j]= 1;	
					}
        break;
    case 4:
        id = "Sex".concat((i+1).toString());
                    if($("#"+id).css("background-color")==="rgb(255, 0, 0)"){ //eh vermelho == 0
						
					matrizCores[i][j]= 0;	

					}else if ($("#"+id).css("background-color")=="rgb(0, 128, 0)"){ //eh verde == 1 
					matrizCores[i][j]= 1;	
					}
        break;

		}


	}


};



var dumpMatriz="";

for(var i=0; i<11; i++) {   //codifica matriz em um string de 0s e 1s separados por pontos a cada linha 
 
	for(var j=0; j<5; j++)
		dumpMatriz+=matrizCores[i][j].toString();
    	//console.log(matrizCores[i][j]);
    	dumpMatriz+=".";
		//console.log(".");
}




 
 $.post( "test.php", { matriz: dumpMatriz })
  .done(function( data ) {
    alert( "Data Loaded: " + data );
  });

/*
 $.ajax({
    type: 'POST',
    url: 'test.php',
    data: '{"matriz":"dumpMatriz"}' ,
    success: function(data) { alert('data: ' + data); },
    contentType: "application/json",
    dataType: 'json'
});
*/


}

