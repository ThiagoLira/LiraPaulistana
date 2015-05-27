<?php
require_once "php/conexao.php";

global $db;

$usuarios = $db->prepare("SELECT * FROM Usuario");
$usuarios->execute();

$todosUsuarios = $usuarios->fetchAll();

foreach($todosUsuarios as $umUsuario){
	var_dump($umUsuario);
}