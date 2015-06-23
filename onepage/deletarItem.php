<?php
require_once "php/conexao.php";
require_once "php/aplicacao.php";
require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;

$appInfo = dbx\AppInfo::loadFromJsonFile("config.json");
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

$authorizeUrl = $webAuth->start();
$accessToken = "Fqjo92WehEAAAAAAAAAACOkTKMu5NYdiGR37SR2wYmjSBFRizz6FKCgO4DXwFJQn";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
if($interface->isAluno($_SESSION['usuarioId'])){
    header("Location: meuPainel.php");
    exit();
}

if(isset($_GET['itemId'])){
	$itemId = $_GET['itemId'];

	$item = new Item();

	$item->select($itemId);

	$alunoId = $item->getAlunoId();

	if($tipo == "Vídeo"){
		$interface->deleteItem($itemId);
		$_SESSION['msg'] = "Vídeo deletado com sucesso!";
	}
	else {
		$dbxClient->delete($item->getLink());
		$item->delete();
		$_SESSION['msg'] = "Arquivo deletado com sucesso!";
	}
}

header('Location: administrarRepositorio.php?alunoId='.$alunoId);
exit();