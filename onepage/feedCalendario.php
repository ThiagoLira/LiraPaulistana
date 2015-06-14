<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}

if($interface->isAdministrador($_SESSION['usuarioId'])){
	$interface->todosEventos();
}
else if($interface->isOperador($_SESSION['usuarioId'])){
	$interface->todosEventos();
}
else if($interface->isProfessor($_SESSION['usuarioId'])){
	$interface->eventosProfessor($_SESSION['usuarioId']);
}
else {
	$interface->eventosAluno($_SESSION['usuarioId']);
}