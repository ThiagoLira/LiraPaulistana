<?php
require_once "php/conexao.php";
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
    header("Location: meuPainel.php");
    exit();
}

if(isset($_GET['id'])){
	$eventoId = $_GET['id'];

	if(isset($_GET['tipo'])){
		if($_GET['tipo'] == "aula"){
			$interface->deleteAula($eventoId);

			$_SESSION['msg'] = "Aula deletada!";
		}
		else if($_GET['tipo'] == "eventomusical"){
			$interface->deleteEventoMusical($eventoId);

			$_SESSION['msg'] = "Evento musical deletado!";
		}
		else {
			$_SESSION['erro'] = "Erro ao deletar evento.";
		}
	}
	else{
		$_SESSION['erro'] = "Erro ao deletar evento.";
	}
}

header('Location: administrarCalendario.php');
exit();