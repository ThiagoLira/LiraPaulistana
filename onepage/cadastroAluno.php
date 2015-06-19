<?php
require_once "php/usuario_classes.php";
require_once "php/login.php";
require_once "php/aplicacao.php";
require_once "php/conexao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
// if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
//     header("Location: meuPainel.php");
//     exit();
// }

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

if ($profaluno == "Aluno"){
	$interface->insertAluno($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email);
	echo "estou aqui";
}
else {
	$interface->insertProf($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $instrumento, $formacao, $preferencia);
}

// header('Location: login-aluno.html');
// exit();
