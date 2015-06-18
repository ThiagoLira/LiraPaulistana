<html>

<form action="pesquisar-alterar.html" method="post">

	<body>

		<?php
			require_once "usuario_classes.php";
			require_once "conexao.php";
			include_once('aplicacao.php');

			$aplicacao = new aplicacao;

			$alunoId = $_POST['id'];
			$nome = $_POST['nome'];
			$data = $_POST['data'];
			$rg = $_POST['rg'];
			$cpf = $_POST['cpf'];
			$endereco = $_POST['endereco'];
			$telefone = $_POST['telefone'];
			$celular = $_POST['celular'];
			$email = $_POST['email'];
			
			echo $endereco . $telefone . $celular. $email;

			if($data == null){
				$aplicacao->updateAluno($alunoId, $nome, "00/00/00", $rg, $cpf, $endereco, $telefone, $celular, $email);
			} else {
				$aplicacao->updateAluno($alunoId, $nome, $data, $rg, $cpf, $endereco, $telefone, $celular, $email);
			}
		?>

		<tr>
			<td colspan="2" align="enter"><input type="submit" value="Retornar"/></td>
		</tr>

	</body>

</html>