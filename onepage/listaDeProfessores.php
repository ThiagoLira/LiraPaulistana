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

    <title>Lira Paulistana | Área do usuário | Lista de professores</title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/dataTables.tableTools.min.css" rel="stylesheet">
    <link href="css/operador.css" rel="stylesheet">

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <script src="../default/js/jquery.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.tableTools.min.js"></script>
</head>

<body>
    <div id="wrapper">
		<section id="listaAlunos" class="section-white">
            <h1 class="tituloPagina">Lista de professores</h1>
            <div class="divider"></div>
            <p>Veja as informações dos professores aqui.</p>
            <table id="verTodosAlunos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Instrumento</th>
                        <th>Formação</th>
                        <th>Preferências</th>
                        <th>Data de nascimento</th>
                        <th>RG</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $interface->todosProfessores() ?>
                </tbody>
            </table>
            <p><a href="meuPainel.php">Voltar a meu painel.</a></p>
        </section>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        $('#verTodosAlunos').dataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
            },
            "columnDefs": [
                {
                    "targets": [ 4 ],
                    "visible": false
                },
                {
                    "targets": [ 5 ],
                    "visible": false
                },
                {
                    "targets": [ 6 ],
                    "visible": false
                },
                {
                    "targets": [ 7 ],
                    "visible": false
                },
                {
                    "targets": [ 8 ],
                    "visible": false
                }
            ]
        });
    });
</script>

</html>