<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
?>


<html>

<link href="css/operador.css" rel="stylesheet">
<body>
<form action="finalizar.php" method="post">
<p class = "tituloPagina" style="margin: 10px">Editar Aluno</p>
<table    class="tabela" style = "margin: 20px"  border="0">

<tr>
	<td>ID:</td>
	<td align="center"><input type="text" name="id" size="30" /></td>
</tr>

<tr>
	<td>Nome:</td>
	<td align="center"><input type="text" name="nome" size="30" /></td>
</tr>

<tr>
	<td>Data de nascimento:</td>
	<td align="center"><input type="text" name="data" size="30" /></td>
</tr>

<tr>
	<td>RG:</td>
	<td align="center"><input type="text" name="rg" size="30" /></td>
</tr>

<tr>
	<td>CPF:</td>
	<td align="center"><input type="text" name="cpf" size="30" /></td>
</tr>

<tr>
	<td>Endereco:</td>
	<td align="center"><input type="text" name="endereco" size="30" /></td>
</tr>

<tr>
	<td>Telefone:</td>
	<td align="center"><input type="text" name="telefone" size="30" /></td>
</tr>

<tr>
	<td>Celular:</td>
	<td align="center"><input type="text" name="celular" size="30" /></td>
</tr>

<tr>
	<td>E-mail:</td>
	<td align="center"><input type="text" name="email" size="30" /></td>
</tr>


	


</table>
<button type="submit" class="button" name="finalizar" value="finalizar" > Enviar </button>
</form>
</body>
</html>