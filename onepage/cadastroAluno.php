<?php
require_once "php/aplicacao.php";

session_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
    header("Location: meuPainel.php");
    exit();
}

$profaluno = $_POST['profaluno'];
$nome = $_POST['nome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$telefone = $_POST['tel'];
$nascimento = $_POST['datanasc'];
$celular = $_POST['cel'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$instrumento = $_POST['instrumento'];
$formacao = $_POST['formacao'];
$preferencia = $_POST['preferencia'];
$username = $_POST['username'];
$hash = $_POST['senha'];
$professorId = $_POST['professorId'];

if ($profaluno == "Aluno"){
	if(isset($nome) && isset($rg) && isset($cpf) && isset($telefone) && isset($nascimento) && isset($celular) && isset($endereco) && isset($email) && isset($username) && isset($hash) && isset($professorId)){
		$interface->insertAluno($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $username, $hash, $professorId);
		$interface->marcaPacote(24,$nome,"09/01/2015 00:00","Sala 4","13:00","Intermediário","Top");
		$_SESSION['msg'] = "Aluno cadastrado!";
	}
	else {
		$_SESSION['erro'] = "Preencha todos os campos.";
	}
}
else {
	if(isset($nome) && isset($rg) && isset($cpf) && isset($telefone) && isset($nascimento) && isset($celular) && isset($endereco) && isset($email) && isset($username) && isset($hash) && isset($instrumento) && isset($formacao) && isset($preferencia)){
		$interface->insertProf($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $username, $hash, $instrumento, $formacao, $preferencia);

		$_SESSION['msg'] = "Professor cadastrado!";
	}
	else {
		$_SESSION['erro'] = "Preencha todos os campos.";
	}
}

header('Location: paginaCadastro.php');
exit();