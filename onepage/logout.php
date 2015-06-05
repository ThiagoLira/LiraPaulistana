<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

$interface->logout();

header('Location: index.html');
exit();