<?php
	require_once "usuario_classes.php";
	require_once "conexao.php";
	include_once('aplicacao.php');

	$aplicacao = new aplicacao;


	//$aplicacao->insertAluno("Henrique", "05/08/1993", "333123", "33722", "Rua Ricardo J", "123321", "9123321", "hen@gmail");
	
	//$aplicacao->updateAluno("9", "Lira", "06/06/1966", "666", "666", "Rua Ricardo J", "666", "666", "lira@gmail");
	
	//if ($aplicacao->deleteAluno("9")) echo "Aluno deletado com sucesso" . "</br>";			
	
	//$aplicacao->getAlunos($db->prepare("SELECT * FROM Aluno A, Usuario U WHERE A.usuarioId = U.usuarioId"));

	//---------------------------------------------------------------------------------------------------------------	
	
	//$aplicacao->insertProf("Henrique", "05/08/1993", "333123", "33722", "Rua Ricardo J", "123321", "9123321", "hen@gmail", "clarineta", "alto grau", "nenhuma");
	
	
	
	$aplicacao->getProfessores($db->prepare("SELECT * FROM Professor P, Usuario U WHERE P.usuarioId = U.usuarioId"));
	
	//---------------------------------------------------------------------------------------------------------------	
	
	//$aplicacao->insertAula("01/06/2015", "15:00", "violão", "básico", "B2-08", "padrão", "1", "3", "2");	
	
	/*
	if ($aplicacao->deleteAula("9")){ 
		echo "Aula deletada com sucesso";
	} else {
		echo "Erro, não fo possível deletar";	
	}	
	*/
	
	//$aplicacao->updateAula("9", "10/06/2050", "16:00", "clarineta", "avançadíssimo", "B2-08", "padrão", "1", "3", "2");	
	
	//$aplicacao->getAulas($db->prepare("SELECT * FROM Aula A, Evento E WHERE A.eventoId = E.eventoId"));
?>