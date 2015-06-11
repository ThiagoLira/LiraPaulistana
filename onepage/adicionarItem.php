<?php
require_once "php/conexao.php";
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

$nome = $_POST['nome'];
$link = $_POST['link'];
$tipo = $_POST['tipo'];
$professorId = $_POST['professorId'];
$alunoId = $_POST['alunoId'];

if($tipo == "Vídeo"){
	$interface->insertItem($nome, $link, $tipo, $professorId, $alunoId);
	$_SESSION['msg'] = "Vídeo adicionado com sucesso!";
}

header('Location: administrarRepositorio.php?alunoId='.$alunoId);
exit();