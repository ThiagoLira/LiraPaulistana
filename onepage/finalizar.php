<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
// if(!$interface->isProfessor($_SESSION['usuarioId'])){
//     header("Location: meuPainel.php");
//     exit();
// }
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lira Paulistana | Área do usuário | Alterar cadastro</title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <link href="css/operador.css" rel="stylesheet">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
    <div id="wrapper">
		<section id="finalizar" class="section-white">
            <br><br><br>
        <?php
			$alunoId = $_POST['id'];
			$nome = $_POST['nome'];
			$data = $_POST['data'];
			$rg = $_POST['rg'];
			$cpf = $_POST['cpf'];
			$endereco = $_POST['endereco'];
			$telefone = $_POST['telefone'];
			$celular = $_POST['celular'];
			$email = $_POST['email'];

			if($data == null){
				$interface->updateAluno($alunoId, $nome, "00/00/00", $rg, $cpf, $endereco, $telefone, $celular, $email);
			} else {
				$interface->updateAluno($alunoId, $nome, $data, $rg, $cpf, $endereco, $telefone, $celular, $email);
			}
		?>
            <p><a href="meuPainel.php">Voltar a meu painel.</a></p>
        </section>
    </div>
</body>

</html>