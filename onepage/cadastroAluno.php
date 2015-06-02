<?php
require_once "php/usuario_classes.php";
require_once "php/login.php";

require_once "php/conexao.php";

global $db;


$aluno = new Aluno();

$nome = $_POST["nome"];
//$dataNascimento = $_POST["nome"];
$rg = $_POST["rg"];
$cpf = $_POST["cpf"];
$endereco = $_POST["nome"];
$telefone = $_POST["telefone"];
$celular = $_POST["cel"];
//$email = $_POST["email"];



echo $rg;





?>