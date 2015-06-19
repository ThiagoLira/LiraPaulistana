<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
// if($interface->isAdministrador($_SESSION['usuarioId']) || $interface->isOperador($_SESSION['usuarioId'])){
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

    <title>Lira Paulistana | Área do usuário | Calendário</title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <link href='css/fullcalendar.min.css' rel='stylesheet'>
    <link href="css/operador.css" rel="stylesheet">

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <script src="../default/js/jquery.js"></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='js/lang/pt-br.js'></script>
</head>

<body>
    <div id="wrapper">
		<section id="listaAlunos" class="section-white">
            <h1 class="tituloPagina">Calendário</h1>
            <div class="divider"></div>
            <p>Veja aqui o calendário de aulas e eventos.</p>
            <div id='calendario'></div>
            <div id='eventoInfo'></div>
            <p><a href="meuPainel.php">Voltar a meu painel.</a></p>
        </section>
    </div>
    <div class='overlay'></div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        $("body").on('click', ".overlay", function() {
            $(".overlay, #eventoInfo").hide();
        });

        $('#calendario').fullCalendar({
            header: {
                left:   'title',
                center: '',
                right:  'month,agendaWeek,agendaDay today prev,next'
            },
            defaultTimedEventDuration: '00:30:00',
            events: 'feedCalendario.php',
            timeFormat: 'H:mm',
            eventClick: function(event) {
                $("#eventoInfo").html("");
                $("#eventoInfo").html("<h1>Informações</h1>");
                $("#eventoInfo").append("<p><strong>"+event.title+"</strong></p>");
                $("#eventoInfo").append("<p><strong>Tipo:</strong> "+event.tipo+"</p>");
                $("#eventoInfo").append("<p><strong>Data:</strong> <span class='datepicker'>"+event.data+"</span></p>");

                if(event.tipo == "Aula"){
                    $("#eventoInfo").append("<br><p><strong>Aluno:</strong> "+event.nomeAluno+"</p>");
                    $("#eventoInfo").append("<p><strong>Professor:</strong> "+event.nomeProfessor+"</p>");
                    $("#eventoInfo").append("<p><strong>Instrumento:</strong> "+event.instrumento+"</p>");
                    $("#eventoInfo").append("<p><strong>Nível:</strong> "+event.nivel+"</p>");
                    $("#eventoInfo").append("<p><strong>Sala:</strong> "+event.sala+"</p>");
                    $("#eventoInfo").append("<p><strong>Tipo de aula:</strong> "+event.tipoAula+"</p>");
                    if(event.presenca){
                        $("#eventoInfo").append("<p><strong>Presença:</strong> sim</p>");
                    }
                    else{
                        $("#eventoInfo").append("<p><strong>Presença:</strong> não</p>");
                    }
                }
                else {
                    $("#eventoInfo").append("<p><strong>Local:</strong> "+event.local+"</p>");
                    $("#eventoInfo").append("<p><strong>Descrição:</strong> "+event.descricao+"</p>");
                }

                $(".overlay, #eventoInfo").show();
            }
        });
    });
</script>

</html>