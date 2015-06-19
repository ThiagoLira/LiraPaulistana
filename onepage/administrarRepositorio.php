<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
// if($interface->isAluno($_SESSION['usuarioId'])){
//     header("Location: meuPainel.php");
//     exit();
// }
if(!isset($_GET['alunoId'])){
    header("Location: indiceRepositorios.php");
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

    <title>Lira Paulistana | Área do usuário | Administrar repositório</title>

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

    <script src="../default/js/jquery.js"></script>
</head>

<body>
    <div id="wrapper">
		<section id="visualizarRepositorio" class="section-white">
            <h1 class="tituloPagina">Administrar repositório: <?php $interface->nome($_GET['alunoId']); ?></h1>
            <div class="divider"></div>
            <p>Veja os itens do repositório aqui.</p>
            <?php if(isset($_SESSION['erro']) && $_SESSION['erro'] != NULL) {
                echo "<p class='erro'>".$_SESSION['erro']."</p>";
                $_SESSION['erro'] = NULL;
            }
            if(isset($_SESSION['msg']) && $_SESSION['msg'] != NULL) {
                echo "<p class='msg'>".$_SESSION['msg']."</p>";
                $_SESSION['msg'] = NULL;
            }
            ?>
            <p><a class="addItem" href="#">Adicionar item.</a></p>
            <form class="adicionarItem" method="post" action="adicionarItem.php" enctype="multipart/form-data">
                <input id="alunoId" type="hidden" name="alunoId" value="<?php echo $_GET['alunoId'] ?>">
                <input id="professorId" type="hidden" name="professorId" value="<?php echo $_SESSION['usuarioId'] ?>">
                <select id="tipo" name="tipo" required>
                    <option value="Vídeo" selected>Vídeo</option>
                    <option value="Arquivo">Arquivo</option>
                </select>
                <input id="nome" type="text" name="nome" placeholder="Nome" required>
                <input id="link" type="text" name="link" placeholder="Link do vídeo">
                <input id="arquivo" type="file" name="arquivo">
                <button type="submit" class="btn btn-primary btn-lg border-radius">Enviar</button>
            </form>
            <table class="repositorio">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th class="nomeItem">Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $interface->itensProfessor($_GET['alunoId']); ?>
                </tbody>
            </table>
            <p><a href="meuPainel.php">Voltar a meu painel.</a></p>
        </section>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        $(".adicionarItem").hide();
        $("#arquivo").hide();

        $("#wrapper").on('click', '.addItem', function(event){
            $(".adicionarItem").slideToggle("slow");
        });

        $('#tipo').on('change', function() {
            if($(this).val() == "Vídeo"){
                $("#link").show();
                $("#arquivo").hide();
            }
            else {
                $("#link").hide();
                $("#arquivo").show();
            }
        });
    });
</script>

</html>