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

    <title>Lira Paulistana | Área do usuário | Administrar calendário</title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <link href='css/fullcalendar.min.css' rel='stylesheet'>
    <link href="css/operador.css" rel="stylesheet">
    <link href="css/jquery.datetimepicker.css" rel="stylesheet">

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <script src="../default/js/jquery.js"></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='js/lang/pt-br.js'></script>
    <script src="js/jquery.datetimepicker.js"></script>
</head>

<body>
    <div id="wrapper">
		<section id="listaAlunos" class="section-white">
            <h1 class="tituloPagina">Administrar calendário</h1>
            <div class="divider"></div>
            <p>Veja aqui o calendário de aulas e eventos.</p>
            <?php if(isset($_SESSION['erro']) && $_SESSION['erro'] != NULL) {
                echo "<p class='erro'>".$_SESSION['erro']."</p>";
                $_SESSION['erro'] = NULL;
            }
            if(isset($_SESSION['msg']) && $_SESSION['msg'] != NULL) {
                echo "<p class='msg'>".$_SESSION['msg']."</p>";
                $_SESSION['msg'] = NULL;
            }
            ?>
            <p><a class="addEvento" href="#">Adicionar evento.</a></p>
            <form class="adicionarEvento" method="post" action="adicionarEvento.php">
            	<fieldset>
            		<select id="tipoEvento" name="tipoEvento" required>
	                    <option value="Aula" selected>Aula</option>
	                    <option value="Evento musical">Evento musical</option>
	                </select>
	                <input id="data" type="text" name="data" placeholder="Data" required>
            	</fieldset>
                <fieldset class="tipoAula">
                	<select id="instrumento" name="instrumento" required>
                		<option value="" selected disabled>Instrumento</option>
                		<option value="Baixo">Baixo</option>
                		<option value="Bateria">Bateria</option>
	                    <option value="Canto">Canto</option>
	                    <option value="Guitarra">Guitarra</option>
	                    <option value="Piano">Piano</option>
	                    <option value="Teclado">Teclado</option>
	                    <option value="Violão">Violão</option>
                	</select>
                	<select id="professor" name="professor" required>
                		<option value="" selected disabled>Escolha o instrumento</option>
                	</select>
                	<select id="aluno" name="aluno" required>
                		<option value="" selected disabled>Escolha o professor</option>
                	</select>
            		<select id="nivel" name="nivel" required>
	                    <option value="" selected disabled>Nível</option>
	                    <option value="Iniciante">Iniciante</option>
	                    <option value="Intermediário">Intermediário</option>
	                    <option value="Avançado">Avançado</option>
                	</select>
                	<select id="sala" name="sala" required>
	                    <option value="" selected disabled>Sala</option>
	                    <option value="1">Sala 1</option>
	                    <option value="2">Sala 2</option>
	                    <option value="3">Sala 3</option>
	                    <option value="4">Sala 4</option>
	                    <option value="5">Sala 5</option>
                	</select>
                	<select id="tipo" name="tipo" required>
	                    <option value="" selected disabled>Tipo de aula</option>
	                    <option value="Normal">Normal</option>
	                    <option value="Reposição">Reposição</option>
                	</select>
                	<select id="presenca" name="presenca" required>
	                    <option value="" selected disabled>Presença</option>
	                    <option value="1">Sim</option>
	                    <option value="0">Não</option>
                	</select>
                </fieldset>
                <fieldset class="tipoEventoMusical">
                	<input id="nome" type="text" name="nome" placeholder="Nome" required>
                	<input id="local" type="text" name="local" placeholder="Local">
                	<input id="descricao" type="text" name="descricao" placeholder="Descrição">
                </fieldset>
                <button type="submit" class="btn btn-primary btn-lg border-radius">Enviar</button>
            </form>
            <div id='calendario'></div>
            <div id='eventoInfo'></div>
            <p><a href="meuPainel.php">Voltar a meu painel.</a></p>
        </section>
    </div>
    <div class='overlay'></div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
    	$(".adicionarEvento").hide();
        $(".tipoEventoMusical").hide();

        $("#wrapper").on('click', '.addEvento', function(event){
            $(".adicionarEvento").slideToggle("slow");
        });

        $('#tipoEvento').on('change', function() {
            if($(this).val() == "Aula"){
                $(".tipoAula").show();
                $(".tipoEventoMusical").hide();
            }
            else {
                $(".tipoAula").hide();
                $(".tipoEventoMusical").show();
            }
        });

        $("body").on('click', ".overlay", function() {
            $(".overlay, #eventoInfo").hide();
        });

        jQuery('#data').datetimepicker({
        	format:'d/m/Y H:i:s'
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
                    $("#eventoInfo").append("<br><p><a href='deletarEvento.php?id="+event.id+"&tipo=aula'>Deletar aula</a></p>");
                }
                else {
                	$("#eventoInfo").append("<p><strong>Local:</strong> "+event.local+"</p>");
                    $("#eventoInfo").append("<p><strong>Descrição:</strong> "+event.descricao+"</p>");
                	$("#eventoInfo").append("<br><p><a href='deletarEvento.php?id="+event.id+"&tipo=eventomusical'>Deletar evento</a></p>");
                }

                $(".overlay, #eventoInfo").show();
            }
        });
    });
</script>

</html>