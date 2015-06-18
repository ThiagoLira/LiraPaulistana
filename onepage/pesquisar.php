<html>
	<head>
		<title>Resultado da pesquisa</title>	
		

		 <style type="text/css">
		 	.indice {

font-family: "Baron Neue",sans-serif;
 letter-spacing: 0px;
  font-size: 19px;
  color:  rgba(3,172,220,1);

}

		 </style>
	</head>
	
	<body>
	
	<?php
		require_once "php/usuario_classes.php";
		require_once "php/conexao.php";
		include_once('php/aplicacao.php');

		$aplicacao = new aplicacao;

		$usersName = $_POST['username'];

		$aplicacao->getProfessores($db->prepare("SELECT * FROM Professor P, Usuario U WHERE P.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));

		$aplicacao->getAlunos($db->prepare("SELECT * FROM Aluno A, Usuario U WHERE A.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));

		$aplicacao->getAdministradores($db->prepare("SELECT * FROM Administrador A, Usuario U WHERE A.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));

		$aplicacao->getOperadores($db->prepare("SELECT * FROM Operador O, Usuario U WHERE O.usuarioId = U.usuarioId AND U.nome = '" . $usersName . "'"));
	?>
	
	</body>
</html>