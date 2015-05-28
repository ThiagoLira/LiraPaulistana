<?php
require_once "php/conexao.php";
require_once "php/usuario_classes.php";
require_once "php/evento_classes.php";

// global $db;

// $usuarios = $db->prepare("SELECT * FROM Usuario");
// $usuarios->execute();

// $todosUsuarios = $usuarios->fetchAll();

// foreach($todosUsuarios as $umUsuario){
// 	var_dump($umUsuario);
// }

// $aula = new Aula();

// $aula->setData("11/06/2015");
// $aula->setHorario("11:00");
// $aula->setInstrumento("Guitarra");
// $aula->setNivel("Iniciante");
// $aula->setSala("Sala 2");
// $aula->setTipo("Reposição");
// $aula->setPresenca(0);
// $aula->setAlunoId(0);
// $aula->setProfessorId(0);

// $aula->insert();

// $teste = new Aula();

// $teste->select($aula->getId());

// var_dump($teste);

$aluno = new Aluno();

$nome = "Novo Aluno";
$dataNascimento = "21/05/1990";
$rg = 123456789;
$cpf = 12345678909;
$endereco = "Rua Exemplo, 900";
$telefone = 1144444444;
$celular = 11988888888;
$email = "novoaluno@email.com";

$aluno->setNome($nome);
$aluno->setDataNascimento($dataNascimento);
$aluno->setRG($rg);
$aluno->setCPF($cpf);
$aluno->setEndereco($endereco);
$aluno->setTelefone($telefone);
$aluno->setCelular($celular);
$aluno->setEmail($email);

if($aluno->insert()) {
	echo "Aluno adicionado!";
	$teste = new Aluno();

	$teste->select($aluno->getId());

	var_dump($teste);
}

$professor = new Professor();

$nome = "Novo Professor";
$dataNascimento = "22/11/1970";
$rg = 123456789;
$cpf = 12345678909;
$endereco = "Rua Exemplo 2, 111";
$telefone = 1144444444;
$celular = 11988888888;
$email = "novoprofessor@email.com";
$instrumento = "Bateria";
$formacaoMusical = "Formado na Faculdade de Musica";
$preferencias = "Preferencia de aulas para jovens e adultos";

$professor->setNome($nome);
$professor->setDataNascimento($dataNascimento);
$professor->setRG($rg);
$professor->setCPF($cpf);
$professor->setEndereco($endereco);
$professor->setTelefone($telefone);
$professor->setCelular($celular);
$professor->setEmail($email);
$professor->setInstrumento($instrumento);
$professor->setFormacaoMusical($formacaoMusical);
$professor->setPreferencias($preferencias);

if($professor->insert()) {
	echo "Professor adicionado!";
	$teste = new Professor();

	$teste->select($professor->getId());

	var_dump($teste);
}

$aula = new Aula();

$aula->setData("11/06/2015");
$aula->setHorario("11:00");
$aula->setInstrumento("Guitarra");
$aula->setNivel("Iniciante");
$aula->setSala("Sala 2");
$aula->setTipo("Reposição");
$aula->setPresenca(0);
$aula->setAlunoId($aluno->getId());
$aula->setProfessorId($professor->getId());

if($aula->insert()) {
	echo "Aula adicionada!";

	$teste = new Aula();

	$teste->select($aula->getId());

	var_dump($teste);
}