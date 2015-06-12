<?php
	require_once "usuario_classes.php";
	require_once "evento_classes.php";
	require_once "repositorio_classes.php";
	require_once "login_classes.php";
	require_once "dropbox-sdk/Dropbox/autoload.php";
	use \Dropbox as dbx;

	$appInfo = dbx\AppInfo::loadFromJsonFile("config.json");
	$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

	$authorizeUrl = $webAuth->start();
	$accessToken = "Fqjo92WehEAAAAAAAAAACOkTKMu5NYdiGR37SR2wYmjSBFRizz6FKCgO4DXwFJQn";

	$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
	
	class Aplicacao {
		public function teste(){
			echo "este teste eh insano";		
		}
		
		//CRUD de Aluno-----------------------------------------------------//

		public function insertAluno($nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email){	
		$aluno = new Aluno();		
	
		$aluno->setNome($nome);
		$aluno->setDataNascimento($dataNascimento);
		$aluno->setRG($rg);
		$aluno->setCPF($cpf);
		$aluno->setEndereco($endereco);
		$aluno->setTelefone($telefone);
		$aluno->setCelular($celular);
		$aluno->setEmail($email);

		$aluno->insert();
		
		echo "Informações sobre o aluno adicionadas com sucesso";
		}
		
		public function updateAluno($usuarioId, $nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email){
			$aluno = new Aluno();		
			$aluno->select($usuarioId);		
	
			$aluno->setNome($nome);
			$aluno->setDataNascimento($dataNascimento);
			$aluno->setRG($rg);
			$aluno->setCPF($cpf);
			$aluno->setEndereco($endereco);
			$aluno->setTelefone($telefone);
			$aluno->setCelular($celular);
			$aluno->setEmail($email);

			$aluno->update();
		
			echo "Informações sobre o aluno atualizadas com sucesso";
		}

		
	public function deleteAluno($usuarioId){
		$aluno = new Aluno();
		$aluno->select($usuarioId);
		return $aluno->delete();
	}
		

		public function getAlunos($alunos){
				try{
				$alunos->execute();

				$todosAlunos = $alunos->fetchAll();


				foreach($todosAlunos as $umAluno){
					echo "Nome: " . ($umAluno["nome"]) . "</br>";
					echo "Nascimento: " . ($umAluno["dataNascimento"]) . "</br>";
					echo "RG: " . ($umAluno["rg"]) . "</br>";
					echo "CPF: " . ($umAluno["cpf"]) . "</br>";
					echo "Endereço: " . ($umAluno["endereco"]) . "</br>";
					echo "Telefone: " . ($umAluno["telefone"]) . "</br>";
					echo "Celular: " . ($umAluno["celular"]) . "</br>";
					echo "E-mail: " . ($umAluno["email"]) . "</br>";
					echo "</br>";
					}
				} catch(PDOException $e){
					var_dump($e) ;
			}
		}
		
		//CRUD de Administrador-----------------------------------------------------//

		public function insertAdministrador($nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email){	
		$Administrador = new Administrador();		
	
		$Administrador->setNome($nome);
		$Administrador->setDataNascimento($dataNascimento);
		$Administrador->setRG($rg);
		$Administrador->setCPF($cpf);
		$Administrador->setEndereco($endereco);
		$Administrador->setTelefone($telefone);
		$Administrador->setCelular($celular);
		$Administrador->setEmail($email);

		$Administrador->insert();
		
		echo "Informações sobre o Administrador adicionadas com sucesso";
		}
		
		public function updateAdministrador($usuarioId, $nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email){
			$Administrador = new Administrador();		
			$Administrador->select($usuarioId);		
	
			$Administrador->setNome($nome);
			$Administrador->setDataNascimento($dataNascimento);
			$Administrador->setRG($rg);
			$Administrador->setCPF($cpf);
			$Administrador->setEndereco($endereco);
			$Administrador->setTelefone($telefone);
			$Administrador->setCelular($celular);
			$Administrador->setEmail($email);

			$Administrador->update();
		
			echo "Informações sobre o Administrador atualizadas com sucesso";
		}

		
	public function deleteAdministrador($usuarioId){
		$Administrador = new Administrador();
		$Administrador->select($usuarioId);
		return $Administrador->delete();
	}
		

		public function getAdministradores($Administradors){
				try{
				$Administradors->execute();

				$todosAdministradors = $Administradors->fetchAll();


				foreach($todosAdministradors as $umAdministrador){
					echo "Nome: " . ($umAdministrador["nome"]) . "</br>";
					echo "Nascimento: " . ($umAdministrador["dataNascimento"]) . "</br>";
					echo "RG: " . ($umAdministrador["rg"]) . "</br>";
					echo "CPF: " . ($umAdministrador["cpf"]) . "</br>";
					echo "Endereço: " . ($umAdministrador["endereco"]) . "</br>";
					echo "Telefone: " . ($umAdministrador["telefone"]) . "</br>";
					echo "Celular: " . ($umAdministrador["celular"]) . "</br>";
					echo "E-mail: " . ($umAdministrador["email"]) . "</br>";
					echo "</br>";
					}
				} catch(PDOException $e){
					var_dump($e) ;
			}
		}
		
		//CRUD de Operador-----------------------------------------------------//

		public function insertOperador($nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email){	
		$Operador = new Operador();		
	
		$Operador->setNome($nome);
		$Operador->setDataNascimento($dataNascimento);
		$Operador->setRG($rg);
		$Operador->setCPF($cpf);
		$Operador->setEndereco($endereco);
		$Operador->setTelefone($telefone);
		$Operador->setCelular($celular);
		$Operador->setEmail($email);

		$Operador->insert();
		
		echo "Informações sobre o Operador adicionadas com sucesso";
		}
		
		public function updateOperador($usuarioId, $nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email){
			$Operador = new Operador();		
			$Operador->select($usuarioId);		
	
			$Operador->setNome($nome);
			$Operador->setDataNascimento($dataNascimento);
			$Operador->setRG($rg);
			$Operador->setCPF($cpf);
			$Operador->setEndereco($endereco);
			$Operador->setTelefone($telefone);
			$Operador->setCelular($celular);
			$Operador->setEmail($email);

			$Operador->update();
		
			echo "Informações sobre o Operador atualizadas com sucesso";
		}

		
	public function deleteOperador($usuarioId){
		$Operador = new Operador();
		$Operador->select($usuarioId);
		return $Operador->delete();
	}
		

		public function getOperadores($Operadors){
				try{
				$Operadors->execute();

				$todosOperadors = $Operadors->fetchAll();


				foreach($todosOperadors as $umOperador){
					echo "Nome: " . ($umOperador["nome"]) . "</br>";
					echo "Nascimento: " . ($umOperador["dataNascimento"]) . "</br>";
					echo "RG: " . ($umOperador["rg"]) . "</br>";
					echo "CPF: " . ($umOperador["cpf"]) . "</br>";
					echo "Endereço: " . ($umOperador["endereco"]) . "</br>";
					echo "Telefone: " . ($umOperador["telefone"]) . "</br>";
					echo "Celular: " . ($umOperador["celular"]) . "</br>";
					echo "E-mail: " . ($umOperador["email"]) . "</br>";
					echo "</br>";
					}
				} catch(PDOException $e){
					var_dump($e) ;
			}
		}
		
		//CRUD de Professor-----------------------------------------------------//

		public function insertProf($nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $instrumento, $formacao, $pref){	
		$prof = new Professor();		
	
		$prof->setNome($nome);
		$prof->setDataNascimento($dataNascimento);
		$prof->setRG($rg);
		$prof->setCPF($cpf);
		$prof->setEndereco($endereco);
		$prof->setTelefone($telefone);
		$prof->setCelular($celular);
		$prof->setEmail($email);
		$prof->setInstrumento($instrumento);
		$prof->setFormacaoMusical($formacao);
		$prof->setPreferencias($pref);
		

		$prof->insert();
		
		echo "Informações sobre o professor adicionadas com sucesso";
		}		
		
		public function updateProf($profId, $nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $instrumento, $formacao, $pref){	
		$prof = new Professor();		
		$prof->select($profId);
	
		$prof->setNome($nome);
		$prof->setDataNascimento($dataNascimento);
		$prof->setRG($rg);
		$prof->setCPF($cpf);
		$prof->setEndereco($endereco);
		$prof->setTelefone($telefone);
		$prof->setCelular($celular);
		$prof->setEmail($email);
		$prof->setInstrumento($instrumento);
		$prof->setFormacaoMusical($formacao);
		$prof->setPreferencias($pref);
		

		$prof->update();
		
		echo "Informações sobre o professor atualizadas com sucesso";
		}
		
		public function deleteProf($usuarioId){
		$prof = new Professor();
		$prof->select($usuarioId);
		return $prof->delete();
	}			
		
	public function getProfessores($profs){
			try{
			$profs->execute();

			$todosProfs = $profs->fetchAll();


			foreach($todosProfs as $umProf){
				echo "Nome: " . ($umProf["nome"]) . "</br>";
				echo "Nascimento: " . ($umProf["dataNascimento"]) . "</br>";
				echo "RG: " . ($umProf["rg"]) . "</br>";
				echo "CPF: " . ($umProf["cpf"]) . "</br>";
				echo "Endereço: " . ($umProf["endereco"]) . "</br>";
				echo "Telefone: " . ($umProf["telefone"]) . "</br>";
				echo "Celular: " . ($umProf["celular"]) . "</br>";
				echo "E-mail: " . ($umProf["email"]) . "</br>";
				echo "Instrumento: " . ($umProf["instrumento"]) . "</br>";
				echo "Formação Acadêmica: " . ($umProf["formacao"]) . "</br>";
				echo "Preferências: " . ($umProf["preferencias"]) . "</br>";
				echo "</br>";
				}
			} catch(PDOException $e){
				var_dump($e) ;
		}
	}


	//CRUD de Aula-----------------------------------------------------//
	public function insertAula($data, $horario, $instrumento, $nivel, $sala, $tipo, $presenca, $alunoId, $professorId){	
		$aula = new Aula();		
	
		$aula->setData($data);
		$aula->setHorario($horario);
		$aula->setInstrumento($instrumento);
		$aula->setNivel($nivel);
		$aula->setSala($sala);
		$aula->setTipo($tipo);
		$aula->setPresenca($presenca);
		$aula->setAlunoId($alunoId);
		$aula->setProfessorId($professorId);

		$aula->insert();
		
		echo "Informações sobre aula adicionadas com sucesso";
	}
	
	public function deleteAula($eventoId){
			$aula = new Aula();
			$aula->select($eventoId);
			return $aula->delete();
	}
	
	public function updateAula($eventoId, $data, $horario, $instrumento, $nivel, $sala, $tipo, $presenca, $alunoId, $professorId){
		$aula = new Aula();
		$aula->select($eventoId);		
	
		$aula->setData($data);
		$aula->setHorario($horario);
		$aula->setInstrumento($instrumento);
		$aula->setNivel($nivel);
		$aula->setSala($sala);
		$aula->setTipo($tipo);
		$aula->setPresenca($presenca);
		$aula->setAlunoId($alunoId);
		$aula->setProfessorId($professorId);

		$aula->update();
		
		echo "Informações sobre aula atualizadas com sucesso" . "</br>";
	}
	
	public function getAulas($aulas){
		try{
				$aulas->execute();

				$todosaulas = $aulas->fetchAll();


				foreach($todosaulas as $umaAula){
					echo "ID: " . ($umaAula["eventoId"]) . "</br>";
					echo "Instrumento: " . ($umaAula["instrumento"]) . "</br>";
					echo "Nivel: " . ($umaAula["nivel"]) . "</br>";
					echo "Sala: " . ($umaAula["sala"]) . "</br>";
					echo "Tipo: " . ($umaAula["tipo"]) . "</br>";
					echo "Presença: " . ($umaAula["presenca"]) . "</br>";
					echo "ID do aluno: " . ($umaAula["alunoId"]) . "</br>";
					echo "ID do professor: " . ($umaAula["professorId"]) . "</br>";
					echo "Data: " . ($umaAula["data"]) . "</br>";
					echo "Horário: " . ($umaAula["horario"]) . "</br>";
					echo "</br>";
					}
				} catch(PDOException $e){
					var_dump($e) ;
			}			
	}
	
	//CRUD de Evento Musical-----------------------------------------------------//
	public function insertEventoMusical($data, $horario, $nome, $local, $descricao){	
		$eventoMusical = new EventoMusical();		
	
		$eventoMusical->setData($data);
		$eventoMusical->setHorario($horario);
		$eventoMusical->setNome($nome);
		$eventoMusical->setLocal($local);
		$eventoMusical->setDescricao($descricao);

		$eventoMusical->insert();
		
		echo "Informações sobre Evento Musical adicionadas com sucesso";
	}
	
	public function deleteEventoMusical($eventoId){
			$eventoMusical = new EventoMusical();
			$eventMusical->select($eventoId);
			return $eventoMusical->delete();
	}
	
	public function updateEventoMusical($eventoId, $data, $horario, $nome, $local, $descricao){
		$eventoMusical = new EventoMusical();
		$eventoMusical->select($eventoId);
	
		$eventoMusical->setData($data);
		$eventoMusical->setHorario($horario);
		$eventoMusical->setNome($nome);
		$eventoMusical->setLocal($local);
		$eventoMusical->setDescricao($descricao);

		$eventoMusical->update();
		
		echo "Informações sobre Evento Musical atualizadas com sucesso";
	}
	
	public function getEventosMusicais($eventosMusicais){
		try{
				$eventosMusicais->execute();

				$todoseventosMusicais = $eventosMusicais->fetchAll();


				foreach($todoseventosMusicais as $umaEventoMusical){
					echo "ID: " . ($umaEventoMusical["eventoId"]) . "</br>";
					echo "Data: " . ($umaEventoMusical["data"]) . "</br>";
					echo "Horário: " . ($umaEventoMusical["horario"]) . "</br>";
					echo "Nome: " . ($umaEventoMusical["nome"]) . "</br>";
					echo "Local: " . ($umaEventoMusical["local"]) . "</br>";
					echo "Descrição: " . ($umaEventoMusical["descricao"]) . "</br>";
					echo "</br>";
					}
				} catch(PDOException $e){
					var_dump($e) ;
			}			
	}
	
	
	//CRUD de Item-----------------------------------------------------//
	public function insertItem($nome, $link, $tipo, $professorId, $alunoId){	
		$item = new Item();		
		
		$item->setNome($nome);
		$item->setLink($link);
		$item->setTipo($tipo);
		$item->setProfessorId($professorId);
		$item->setAlunoId($alunoId);

		$item->insert();
		
		//echo "Informações sobre Item adicionadas com sucesso";
	}
	
	public function deleteItem($itemId){
		$item = new Item();
		$item->select($itemId);
		return $item->delete();
	}
	
	public function updateItem($itemId, $nome, $link, $tipo, $professorId, $alunoId){	
		$item = new Item();
		$item->select($itemId);

		$item->setNome($nome);
		$item->setLink($link);
		$item->setTipo($tipo);
		$item->setProfessorId($professorId);
		$item->setAlunoId($alunoId);

		$item->update();
		
		echo "Informações sobre Item atualizadas com sucesso";
	}
	
	public function getItens($itens){
		try{
			$itens->execute();

			$todositens = $itens->fetchAll();

			foreach($todositens as $umItem){
				echo "ID: " . ($umItem["eventoId"]) . "</br>";
				echo "Nome: " . ($umItem["nome"]) . "</br>";
				echo "Link: " . ($umItem["link"]) . "</br>";
				echo "Tipo: " . ($umItem["tipo"]) . "</br>";
				echo "ID do aluno: " . ($umItem["alunoId"]) . "</br>";
				echo "ID do professor: " . ($umItem["professorId"]) . "</br>";
				echo "</br>";
			}
		} catch(PDOException $e){
			var_dump($e) ;
		}			
	}

	//Login ----------------------------------------------
	public function login($username, $hash){
		$login = new Login();
		$login->setUsername($username);
		$login->setHash($hash);

		return $login->SignIn();
	}

	public function logout(){
		$login = new Login();
		$login->SignOut();
	}

	public function checkLogin(){
		$login = new Login();
		return $login->checkSession();
	}

	//Alunos de um professor----------------------------------
	public function alunosDeUmProfessor($id){
		try{
			global $db;

			$select = $db->prepare("SELECT Usuario.usuarioId, Usuario.nome FROM TemAula INNER JOIN Aluno ON TemAula.alunoId = Aluno.usuarioId INNER JOIN Usuario ON Aluno.usuarioId = Usuario.usuarioId WHERE TemAula.professorId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$alunosDeUmProfessor = $select->fetchAll();

			foreach($alunosDeUmProfessor as $umAluno){
				echo '<tr>
                        <td class="nomeItem"><a href="administrarRepositorio.php?alunoId='.$umAluno['usuarioId'].'">'.$umAluno['nome'].'</a></td>
                    </tr>';
			}
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}

	//Itens de um aluno, visão do professor----------------------------------
	public function itensProfessor($idAluno){
		try{
			global $db;
			global $dbxClient;
			
			$select = $db->prepare("SELECT Item.itemId, Item.nome, Item.link, Item.tipo FROM Item WHERE Item.alunoId = :id");
			$select->bindParam(":id", $idAluno, PDO::PARAM_INT);
			$select->execute();

			$itensProfessor = $select->fetchAll();

			foreach($itensProfessor as $umItem){
				echo '<tr>
                        <td>'.$umItem['tipo'].'</td>';
                if($umItem["tipo"] == "Arquivo"){
                	echo '<td class="nomeItem"><a href="'.$dbxClient->createShareableLink($umItem["link"]).'" target="_blank">'.$umItem['nome'].'</a></td>';
                }
                else {
                	echo '<td class="nomeItem"><a href="'.$umItem['link'].'" target="_blank">'.$umItem['nome'].'</a></td>';
                }
                echo '<td><a href="deletarItem.php?itemId='.$umItem['itemId'].'"><img src="images/delete.png" alt="Deletar"></a></td>
                    </tr>';
			}
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}

	//Itens de um aluno, visão do aluno----------------------------------
	public function itensAluno($idAluno){
		try{
			global $db;
			global $dbxClient;
			
			$select = $db->prepare("SELECT Item.itemId, Item.nome, Item.link, Item.tipo FROM Item WHERE Item.alunoId = :id");
			$select->bindParam(":id", $idAluno, PDO::PARAM_INT);
			$select->execute();

			$itensAluno = $select->fetchAll();

			foreach($itensAluno as $umItem){
				echo '<tr>
                        <td>'.$umItem['tipo'].'</td>';
                if($umItem["tipo"] == "Arquivo"){
                	echo '<td class="nomeItem"><a href="'.$dbxClient->createShareableLink($umItem["link"]).'" target="_blank">'.$umItem['nome'].'</a></td>';
                }
                else {
                	echo '<td class="nomeItem"><a href="'.$umItem['link'].'" target="_blank">'.$umItem['nome'].'</a></td>';
                }
                echo '</tr>';
			}
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}

	//Nome
	public function nome($id){
		try{
			global $db;
			
			$select = $db->prepare("SELECT Usuario.nome FROM Usuario WHERE Usuario.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umUser = $select->fetch(PDO::FETCH_ASSOC);

			echo $umUser['nome'];
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}

	//Tipo de usuário---------------------------------
	public function isAdministrador($id) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT * FROM Administrador WHERE Administrador.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$result = $select->fetchAll();

			if(count($result) > 0) return true;
			else return false;
		} catch(PDOException $e){
			return false;
		}
	}

	public function isOperador($id) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT * FROM Operador WHERE Operador.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$result = $select->fetchAll();

			if(count($result) > 0) return true;
			else return false;
		} catch(PDOException $e){
			return false;
		}
	}

	public function isProfessor($id) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT * FROM Professor WHERE Professor.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$result = $select->fetchAll();

			if(count($result) > 0) return true;
			else return false;
		} catch(PDOException $e){
			return false;
		}
	}

	public function isAluno($id) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT * FROM Aluno WHERE Aluno.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$result = $select->fetchAll();

			if(count($result) > 0) return true;
			else return false;
		} catch(PDOException $e){
			return false;
		}
	}
}