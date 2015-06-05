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
    <link href="css/operador.css" rel="stylesheet">
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
    <link rel="stylesheet" type="text/css" href="css/shoko.css" />



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
                  <span class="input input--shoko">
                                                            <input name = "user" class="input__field input__field--shoko" type="text" id="user" required />
                                                                     <label class="input__label input__label--shoko" for="input-4">
                                                                            <span class="input__label-content input__label-content--shoko">Usuario</span>
                                                                     </label>
                                                                     <svg class="graphic graphic--shoko" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                                                                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                                                                        <path d="M0,2.5c0,0,298.666,0,399.333,0C448.336,2.5,513.994,13,597,13c77.327,0,135-10.5,200.999-10.5c95.996,0,402.001,0,402.001,0"/>
                                                                    </svg>
                                </span>

                                <span class="input input--shoko">
                                                            <input name = "pass" class="input__field input__field--shoko" type="text" id="pass" required />
                                                                     <label class="input__label input__label--shoko" for="input-4">
                                                                            <span class="input__label-content input__label-content--shoko">Senha</span>
                                                                     </label>
                                                                     <svg class="graphic graphic--shoko" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                                                                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                                                                        <path d="M0,2.5c0,0,298.666,0,399.333,0C448.336,2.5,513.994,13,597,13c77.327,0,135-10.5,200.999-10.5c95.996,0,402.001,0,402.001,0"/>
                                                                    </svg>
                                </span>
                <input style ="margin: 35px !important "class= "botaologin"type="submit" id="submit" name="submit" value="Entrar">
            </form>
        </section>
    </div>
</body>

</html>

