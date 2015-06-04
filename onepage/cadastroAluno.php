<?php
require_once "php/usuario_classes.php";
require_once "php/login.php";
require_once "php/aplicacao";
require_once "php/conexao.php";

global $db;


$aluno = new Aluno();
if (is_null($preferencia) && is_null($formacao) && is_null($instrumento)){
	echo $preferencia;
	insertAluno($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email);
}

else{

	insertProf($nome, $nascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $instrumento, $formacao, $preferencia);


}














?>