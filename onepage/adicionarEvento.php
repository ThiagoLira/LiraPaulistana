<?php
require_once "php/conexao.php";
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(isset($_POST['verProfessores']) && $_POST['verProfessores']){
	$interface->professoresPorInstrumento($_POST['instrumento']);
	exit();
}
else if(isset($_POST['verAlunos']) && $_POST['verAlunos']){
	$interface->alunosPorProfessor($_POST['professorId']);
	exit();
}
else if(isset($_POST['adicionarEvento']) && $_POST['adicionarEvento']){
	if ($_POST['tipoEvento'] == "Aula") {
		if(isset($_POST['data']) && isset($_POST['instrumento']) && isset($_POST['professorId']) && isset($_POST['alunoId']) && isset($_POST['nivel']) && isset($_POST['sala']) && isset($_POST['tipo'])){
			$data = $_POST['data'];
			$horario = substr($data, 11);
			$instrumento = $_POST['instrumento'];
			$professorId = $_POST['professorId'];
			$alunoId = $_POST['alunoId'];
			$nivel = $_POST['nivel'];
			$sala = $_POST['sala'];
			$tipo = $_POST['tipo'];
			if ($_POST['presenca'] == null) $presenca = 0;
			else $presenca = $_POST['presenca'];

			$interface->insertAula($data, $horario, $instrumento, $nivel, $sala, $tipo, $presenca, $alunoId, $professorId);

			$_SESSION['msg'] = "Aula marcada!";
		}
		else {
			$_SESSION['erro'] = "Preencha corretamente o formulário de aula.";
		}
	}
	else if($_POST['tipoEvento'] == "Evento musical") {
		if(isset($_POST['data']) && isset($_POST['nome']) && isset($_POST['local']) && isset($_POST['descricao'])){
			$data = $_POST['data'];
			$horario = substr($data, 11);
			$nome = $_POST['nome'];
			$local = $_POST['local'];
			$descricao = $_POST['descricao'];

			$interface->insertEventoMusical($data, $horario, $nome, $local, $descricao);

			$_SESSION['msg'] = "Evento musical marcado!";
		}
		else {
			$_SESSION['erro'] = "Preencha corretamente o formulário de evento musical.";
		}
	}
	else {
		$_SESSION['erro'] = "Erro ao adicionar evento.";
	}
}

header('Location: administrarCalendario.php');
exit();