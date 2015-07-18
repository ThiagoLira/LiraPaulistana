<?php
require_once "php/aplicacao.php";

session_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}

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

    <title>Lira Paulistana | Área do usuário</title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <script src="../default/js/jquery.js"></script>
    <script type="text/javascript" src="js/AnimateList.js" ></script>
     



    <link href="css/operador.css" rel="stylesheet">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
    <div id="wrapper">
		<section id="areaUsuario" class="section-white">
            <h1 class="tituloPagina">Meu Painel</h1>
            <div class="divider"></div>
            <p>Bem-vindo:</p>
            <p id="NomeUsuario"><?php $interface->nome($_SESSION['usuarioId']) ?></p>
            <ul class="listaOp">
                <?php
                if($interface->isAdministrador($_SESSION['usuarioId'])){
                    echo '<li><a href="paginaCadastro.php">Cadastro</a></li>';
                    echo '<li><a href="pesquisa-alterar.php">Alteração/Pesquisar</a></li>';
                    echo '<li><a href="listaDeAlunos.php">Lista de alunos</a></li>';
                    echo '<li><a href="listaDeProfessores.php">Lista de professores</a></li>';
                    echo '<li><a href="administrarCalendario.php">Administrar calendário</a></li>';
                }
                else if($interface->isOperador($_SESSION['usuarioId'])){
                    echo '<li><a href="listaDeAlunos.php">Lista de alunos</a></li>';
                    echo '<li><a href="listaDeProfessores.php">Lista de professores</a></li>';
                    echo '<li><a href="administrarCalendario.php">Administrar calendário</a></li>';
                }
                else if($interface->isProfessor($_SESSION['usuarioId'])){
                    echo '<li><a href="calendario.php">Calendário</a></li>';
                    echo '<li><a href="indiceRepositorios.php">Índice de repositórios</a></li>';
                }
                else {
                    echo '<li><a href="calendario.php">Calendário</a></li>';
                    echo '<li><a href="repositorio.php">Repositório</a></li>';
                }
                ?>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </section>
    </div>
</body>

</html>