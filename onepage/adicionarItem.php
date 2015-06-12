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

$nome = $_POST['nome'];
$link = $_POST['link'];
$tipo = $_POST['tipo'];
$professorId = $_POST['professorId'];
$alunoId = $_POST['alunoId'];

if($tipo == "Vídeo"){
	$interface->insertItem($nome, $link, $tipo, $professorId, $alunoId);
	$_SESSION['msg'] = "Vídeo adicionado com sucesso!";
}
else {
	if (!empty($_FILES["arquivo"])) {
	    $arquivo = $_FILES["arquivo"];
	 
	    if ($arquivo["error"] !== UPLOAD_ERR_OK) {
	        $_SESSION['erro'] = "Erro ao enviar arquivo.";
	    }
	    else {
	    	$f = fopen($arquivo["tmp_name"], "rb");
			$resultado = $dbxClient->uploadFile("/".$arquivo["name"], dbx\WriteMode::add(), $f);
			fclose($f);

			$link = $resultado["path"];

			$interface->insertItem($nome, $link, $tipo, $professorId, $alunoId);
			$_SESSION['msg'] = "Arquivo adicionado com sucesso!";
	    }
	}
	else {
		$_SESSION['erro'] = "Escolha um arquivo.";
	}
}

header('Location: administrarRepositorio.php?alunoId='.$alunoId);
exit();