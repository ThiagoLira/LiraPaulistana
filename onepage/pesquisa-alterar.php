<!DOCTYPE HTML PUBLIC>
<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
// if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
//     header("Location: meuPainel.php");
//     exit();
// }
?>


<html>



<head>


	<link href="css/operador.css" rel="stylesheet">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    
	<title>Operador</title>



</head>

<p class = "tituloPagina">Bem vindo: Operador</p>

<body>

			<div>
				<form  name="pesquisaOperador" method="post" action="pesquisar.php">Digite aqui o nome do Aluno/Professor que deseja procurar:
					
				<input type="text" name="username">



				<button type = "submit"  > Pesquisar</button>
				</form>		
			</div>


</body>



</html>
