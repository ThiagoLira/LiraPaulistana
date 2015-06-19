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


$nome = $_POST['pesquisa'];







if ($profaluno == "Aluno"){
	$interface->insertAluno($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email);
	echo "estou aqui";
}
else {
	$interface->insertProf($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $instrumento, $formacao, $preferencia);
}

// header('Location: login-aluno.html');
// exit();
