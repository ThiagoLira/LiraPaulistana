<?php
require_once "php/conexao.php";
require_once "php/evento_classes.php";

global $db;

$usuarios = $db->prepare("SELECT * FROM Usuario");
$usuarios->execute();

$todosUsuarios = $usuarios->fetchAll();

foreach($todosUsuarios as $umUsuario){
	var_dump($umUsuario);
}

$aula = new Aula();

$aula->setData("11/06/2015");
$aula->setHorario("11:00");
$aula->setInstrumento("Guitarra");
$aula->setNivel("Iniciante");
$aula->setSala("Sala 2");
$aula->setTipo("Reposição");
$aula->setPresenca(0);
$aula->setAlunoId(0);
$aula->setProfessorId(0);

$aula->insert();

$teste = new Aula();

$teste->select($aula->getId());

var_dump($teste);