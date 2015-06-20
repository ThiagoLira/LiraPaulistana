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
    
	<title>Lira Paulistana | Área do usuário | Resultado de pesquisa</title>
</head>

<body>
	<section id="visualizarRepositorio" class="section-white">
        <h1 class="tituloPagina">Resultado de pesquisa</h1>
		<?php
		$usersName = $_POST['username'];

		//$interface->getProfessores($db->prepare("SELECT * FROM Professor P, Usuario U WHERE P.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));

		$interface->getAlunos($db->prepare("SELECT * FROM Aluno A, Usuario U WHERE A.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));

		//$interface->getAdministradores($db->prepare("SELECT * FROM Administrador A, Usuario U WHERE A.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));

		//$interface->getOperadores($db->prepare("SELECT * FROM Operador O, Usuario U WHERE O.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));
		?>
		<br>
		<p><a href="meuPainel.php">Voltar a meu painel.</a></p>
	</section>
</body>

</html>