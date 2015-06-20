<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}

if(isset($_GET['alunoId'])){
	$user = $interface->getAluno($_GET['alunoId']);
	$data = $user['dataNascimento'];
}
// else if(isset($_GET['professorId'])){
// 	$user = $interface->getProfessor($_GET['professorId']);
// }
else {
    header("Location: pesquisa-alterar.php");
    exit();
}
// if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
//     header("Location: meuPainel.php");
//     exit();
// }
?>


<html>

<link href="css/operador.css" rel="stylesheet">
<body>
	<section id="listaAlunos" class="section-white">
<form action="finalizar.php" method="post">
<p class = "tituloPagina" style="margin: 10px">Editar Aluno</p>
<table    class="tabela" style = "margin: auto"  border="0">

<input type="hidden" name="id" size="30" value="<?php echo $user['usuarioId']; ?>" /></td>

<tr>
	<td>Nome:</td>
	<td align="center"><input type="text" name="nome" size="30" value="<?php echo $user['nome'] ?>" required /></td>
</tr>

<tr>
	<td>Data de nascimento:</td>
	<td align="center"><input type="text" name="data" size="30" value="<?php echo substr($data, 8, 2).'/'.substr($data, 5, 2).'/'.substr($data, 0, 4) ?>" required /></td>
</tr>

<tr>
	<td>RG:</td>
	<td align="center"><input type="text" name="rg" size="30" value="<?php echo $user['rg'] ?>" required /></td>
</tr>

<tr>
	<td>CPF:</td>
	<td align="center"><input type="text" name="cpf" size="30" value="<?php echo $user['cpf'] ?>" required /></td>
</tr>

<tr>
	<td>Endereco:</td>
	<td align="center"><input type="text" name="endereco" size="30" value="<?php echo $user['endereco'] ?>" required /></td>
</tr>

<tr>
	<td>Telefone:</td>
	<td align="center"><input type="text" name="telefone" size="30" value="<?php echo $user['telefone'] ?>" required /></td>
</tr>

<tr>
	<td>Celular:</td>
	<td align="center"><input type="text" name="celular" size="30" value="<?php echo $user['celular'] ?>" required /></td>
</tr>

<tr>
	<td>E-mail:</td>
	<td align="center"><input type="text" name="email" size="30" value="<?php echo $user['email'] ?>" required /></td>
</tr>


	


</table>
<button type="submit" class="button" name="finalizar" value="finalizar" > Enviar </button>
</form>
<p><a href="meuPainel.php">Voltar a meu painel.</a></p>
</section>
</body>
</html>