<?php
try {
		$db = new PDO("mysql:host=localhost;dbname=lirapaulistana","root","123456",array(
		PDO::ATTR_EMULATE_PREPARES => False, //prepared statements nativos
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //comando executada logo no início da conexão
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //usa exceções pro tratamento de erros
		//PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
	));
}
catch (PDOException $error) {
	echo $error->getMessage();
	//header("Location: ../missing.html");
	//exit();
}
