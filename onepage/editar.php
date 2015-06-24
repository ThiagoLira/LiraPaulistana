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
if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
    header("Location: meuPainel.php");
    exit();
}
?>


<html>

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lira Paulistana | Área do usuário | Alterar cadastro</title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href="css/operador.css" rel="stylesheet">
	<script src="../default/js/jquery.js"></script>
	<script src="js/jquery.maskedinput.min.js"></script>

	<script src="js/regexp.js"></script>
</head>

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
	<td align="center"><input type="text" id="datanasc" name="data" size="30" value="<?php echo substr($data, 8, 2).'/'.substr($data, 5, 2).'/'.substr($data, 0, 4) ?>" required /></td>
</tr>

<tr>
	<td>RG:</td>
	<td align="center"><input type="text" name="rg" size="30" id = "rg" value="<?php echo $user['rg'] ?>" required /></td>
</tr>

<tr>
	<td>CPF:</td>
	<td align="center"><input type="text" name="cpf" size="30" id = "cpf" value="<?php echo $user['cpf'] ?>" required /></td>
</tr>

<tr>
	<td>Endereco:</td>
	<td align="center"><input type="text" name="endereco" size="30"  value="<?php echo $user['endereco'] ?>" required /></td>
</tr>

<tr>
	<td>Telefone:</td>
	<td align="center"><input type="text" name="telefone" size="30" id = "tel" value="<?php echo $user['telefone'] ?>" required /></td>
</tr>

<tr>
	<td>Celular:</td>
	<td align="center"><input type="text" name="celular" size="30" id = "cel" value="<?php echo $user['celular'] ?>" required /></td>
</tr>

<tr>
	<td>E-mail:</td>
	<td align="center"><input type="text" name="email" size="30" value="<?php echo $user['email'] ?>" required /></td>
</tr>

<tr>
	<td>Login:</td>
	<td align="center"><input type="text" name="username" size="30" value="<?php echo $user['username'] ?>" /></td>
</tr>

<tr>
	<td>Senha:</td>
	<td align="center"><input type="password" name="senha" size="30" value="" /></td>
</tr>

<tr>
	<td>Professor do aluno:</td>
	<td align="center"><select id="profdoaluno2" name="professorId"><?php $interface->selectTodosProfessores($user['professorId']) ?></select></td>
</tr>

	


</table>
<button type="submit" class="button" name="finalizar" value="finalizar" > Enviar </button>
</form>
<p><a href="meuPainel.php">Voltar a meu painel.</a></p>
</section>
</body>

<script type="text/javascript">
	$("#datanasc").mask("99/99/9999");
</script>

</html>