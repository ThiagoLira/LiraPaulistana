<?php
require_once "php/usuario_classes.php";
require_once "php/evento_classes.php";
require_once "php/repositorio_classes.php";

echo '<h1>Teste de Aluno</h1>';

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

var_dump($aluno);

echo 'Nome: ';
echo $aluno->getNome();
echo '<br>Data de nascimento: ';
echo $aluno->getDataNascimento();
echo '<br>RG: ';
echo $aluno->getRG();
echo '<br>CPF: ';
echo $aluno->getCPF();
echo '<br>Endereco: ';
echo $aluno->getEndereco();
echo '<br>Telefone: ';
echo $aluno->getTelefone();
echo '<br>Celular: ';
echo $aluno->getCelular();
echo '<br>E-mail: ';
echo $aluno->getEmail();
echo '<br>';

echo '<h1>Teste de Professor</h1>';

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

var_dump($professor);

echo 'Nome: ';
echo $professor->getNome();
echo '<br>Data de nascimento: ';
echo $professor->getDataNascimento();
echo '<br>RG: ';
echo $professor->getRG();
echo '<br>CPF: ';
echo $professor->getCPF();
echo '<br>Endereco: ';
echo $professor->getEndereco();
echo '<br>Telefone: ';
echo $professor->getTelefone();
echo '<br>Celular: ';
echo $professor->getCelular();
echo '<br>E-mail: ';
echo $professor->getEmail();
echo '<br>Instrumento: ';
echo $professor->getInstrumento();
echo '<br>Formacao musical: ';
echo $professor->getFormacaoMusical();
echo '<br>Preferencias: ';
echo $professor->getPreferencias();
echo '<br>';

echo '<h1>Teste de Aula</h1>';

$aula = new Aula();

$data = "05/05/2015";
$horario = "11:00";
$instrumento = "Guitarra";
$nivel = "Intermediario";
$sala = 3;
$tipo = "Reposicao";
$presenca = true;

$aula->setData($data);
$aula->setHorario($horario);
$aula->setInstrumento($instrumento);
$aula->setNivel($nivel);
$aula->setSala($sala);
$aula->setTipo($tipo);
$aula->setPresenca($presenca);

var_dump($aula);

echo 'Data: ';
echo $aula->getData();
echo '<br>Horario: ';
echo $aula->getHorario();
echo '<br>Instrumento: ';
echo $aula->getInstrumento();
echo '<br>Nivel: ';
echo $aula->getNivel();
echo '<br>Sala: ';
echo $aula->getSala();
echo '<br>Tipo: ';
echo $aula->getTipo();
echo '<br>Presenca: ';
echo $aula->getPresenca();
echo '<br>';