<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if($interface->checkLogin()){
    header("Location: meuPainel.php");
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

    <title>Lira Paulistana | Área do usuário | Login</title>

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
		<section id="loginAreaUsuario" class="section-white">
            <h1 class="tituloPagina">Fazer login</h1>
            <div class="divider"></div>
            <p>Digite nome de usuário e senha para ter acesso seu painel de usuário.</p>
            <?php if(isset($_SESSION['erro']) && $_SESSION['erro'] != NULL) {
                echo "<p>".$_SESSION['erro']."</p>";
                $_SESSION['erro'] = NULL;
            }
            ?>
            <form method="POST" action="login.php">
                <input type="text" id="user" name="user" required />
                <input type="password" id="pass" name="pass" required />
                <input type="submit" id="submit" name="submit" value="Entrar">
            </form>
        </section>
    </div>
</body>

</html>