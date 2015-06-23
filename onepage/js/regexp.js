// JavaScript Document
//adiciona mascara de cnpj



jQuery(function($){
   //$("#cnpf").mask("00.000.000/0000-00");
   $("#cep").mask("99.999-999");
   $("#datanasc").mask("99/99/9999");
   $("#tel").mask("(99) 9999-9999");
   $("#cel").mask("(99) 99999-9999");
   $("#rg").mask("99.999.999-9");
   $("#cpf").mask("999.999.999-99");

});



//valida telefone
function ValidaTelefone(tel){
	exp = /\(\d{2}\)\ \d{4}\-\d{4}/
	if(!exp.test(tel.value))
		alert('Numero de Telefone Invalido!');
}

//valida CEP
function ValidaCep(cep){
	exp = /\d{2}\.\d{3}\-\d{3}/
	if(!exp.test(cep.value))
		alert('Numero de Cep Invalido!');		
}

//valida data
function ValidaData(data){
	exp = /\d{2}\/\d{2}\/\d{4}/
	if(!exp.test(data.value))
		alert('Data Invalida!');			
}

//valida o CPF digitado
function ValidarCPF(Objcpf){
	var cpf = Objcpf.value;
	exp = /\.|\-/g
	cpf = cpf.toString().replace( exp, "" ); 
	var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
	var soma1=0, soma2=0;
	var vlr =11;
	
	for(i=0;i<9;i++){
		soma1+=eval(cpf.charAt(i)*(vlr-1));
		soma2+=eval(cpf.charAt(i)*vlr);
		vlr--;
	}	
	soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
	soma2=(((soma2+(2*soma1))*10)%11);
	
	var digitoGerado=(soma1*10)+soma2;
	if(digitoGerado!=digitoDigitado)	
		alert('CPF Invalido!');		
}




