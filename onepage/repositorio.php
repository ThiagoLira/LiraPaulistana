<?php
require_once "php/aplicacao.php";

session_start();

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

    <title>Lira Paulistana | Área do usuário | Repositório</title>

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
		<section id="visualizarRepositorio" class="section-white">
            <h1 class="tituloPagina">Repositório</h1>
            <div class="divider"></div>
            <p>Veja os itens de seu repositório aqui.</p>
            <table class="repositorio">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th class="nomeItem">Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $interface->itensAluno($_SESSION['usuarioId']) ?>
                </tbody>
            </table>
            <p><a href="meuPainel.php">Voltar a meu painel.</a></p>
        </section>
    </div>
</body>

</html>