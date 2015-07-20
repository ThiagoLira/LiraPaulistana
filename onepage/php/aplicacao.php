<?php
	require_once "usuario_classes.php";
	require_once "evento_classes.php";
	require_once "repositorio_classes.php";
	require_once 'php/PasswordLib.phar';
	require_once "login_classes.php";
	require_once "dropbox-sdk/Dropbox/autoload.php";
	use \Dropbox as dbx;

	$appInfo = dbx\AppInfo::loadFromJsonFile("config.json");
	$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	$authorizeUrl = $webAuth->start();
	$accessToken = "Fqjo92WehEAAAAAAAAAACOkTKMu5NYdiGR37SR2wYmjSBFRizz6FKCgO4DXwFJQn";

	$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
	
	class Aplicacao {
		public function teste(){
			echo "este teste eh insano";		
		}
		
		//CRUD de Aluno-----------------------------------------------------//

		public function insertAluno($nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $username, $hash, $professorId){	
		$aluno = new Aluno();	
		$lib = new PasswordLib\PasswordLib(); 	
	
		$aluno->setNome($nome);
		$aluno->setDataNascimento($dataNascimento);
		$aluno->setRG($rg);
		$aluno->setCPF($cpf);
		$aluno->setEndereco($endereco);
		$aluno->setTelefone($telefone);
		$aluno->setCelular($celular);
		$aluno->setEmail($email);

		$aluno->insert();

		$login = new Login();

		$login->setUsuarioId($aluno->getId());
		$login->setUsername($username);
		$hash2 = $lib->createPasswordHash($hash);
		$login->setHash($hash2);

		$login->insert();

		$aluno->insertTemAula($professorId);
		
		echo "Informações sobre o aluno adicionadas com sucesso";
		}
		
		public function updateAluno($usuarioId, $nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $username, $hash, $professorId){
			$aluno = new Aluno();	
			$lib = new PasswordLib\PasswordLib(); 	
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

			if(isset($hash) && $hash != NULL){
				$login = new Login();
				
				$login->setUsuarioId($aluno->getId());
				$login->setUsername($username);
				$hash2 = $lib->createPasswordHash($hash);
				$login->setHash($hash2);

				$login->update();
			}

			$aluno->updateTemAula($professorId);
		
			echo "<p class='msg'>Informações sobre o aluno atualizadas com sucesso.</p>";
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
					echo "<span class=indice>Nome: </span> " . ($umAluno["nome"]) . "</br>";
					echo "<span class=indice>Nascimento: </span> " . ($umAluno["dataNascimento"]) . "</br>";
					echo "<span class=indice>RG:</span> " . ($umAluno["rg"]) . "</br>";
					echo "<span class=indice>CPF:</span> " . ($umAluno["cpf"]) . "</br>";
					echo "<span class=indice>Endereço:</span> " . ($umAluno["endereco"]) . "</br>";
					echo "<span class=indice>Telefone:</span> " . ($umAluno["telefone"]) . "</br>";
					echo "<span class=indice>Celular: </span>" . ($umAluno["celular"]) . "</br>";
					echo "<span class=indice>E-mail: </span>" . ($umAluno["email"]) . "</br>";
					echo "<a href='editar.php?alunoId=".($umAluno['usuarioId'])."''>Editar</a>";
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
					echo "<span class=indice>Nome: </span>" . ($umAdministrador["nome"]) . "</br>";
					echo "<span class=indice>Nascimento: </span>" . ($umAdministrador["dataNascimento"]) . "</br>";
					echo "<span class=indice>RG: </span>" . ($umAdministrador["rg"]) . "</br>";
					echo "<span class=indice>CPF: </span>" . ($umAdministrador["cpf"]) . "</br>";
					echo "<span class=indice>Endereço: </span>" . ($umAdministrador["endereco"]) . "</br>";
					echo "<span class=indice>Telefone: </span>" . ($umAdministrador["telefone"]) . "</br>";
					echo "<span class=indice>Celular: </span>" . ($umAdministrador["celular"]) . "</br>";
					echo "<span class=indice>E-mail: </span>" . ($umAdministrador["email"]) . "</br>";
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
					echo "<span class=indice>Nome: </span>" . ($umOperador["nome"]) . "</br>";
					echo "<span class=indice>Nascimento: </span>" . ($umOperador["dataNascimento"]) . "</br>";
					echo "<span class=indice>RG: </span>" . ($umOperador["rg"]) . "</br>";
					echo "<span class=indice>CPF: </span>" . ($umOperador["cpf"]) . "</br>";
					echo "<span class=indice>Endereço: </span>" . ($umOperador["endereco"]) . "</br>";
					echo "<span class=indice>Telefone: </span>" . ($umOperador["telefone"]) . "</br>";
					echo "<span class=indice>Celular: </span>" . ($umOperador["celular"]) . "</br>";
					echo "<span class=indice>E-mail: </span>" . ($umOperador["email"]) . "</br>";
					echo "</br>";
					}
				} catch(PDOException $e){
					var_dump($e) ;
			}
		}
		
		//CRUD de Professor-----------------------------------------------------//

		public function insertProf($nome, $dataNascimento, $rg, $cpf, $endereco, $telefone, $celular, $email, $username, $hash, $instrumento, $formacao, $pref){	
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

		$lib = new PasswordLib\PasswordLib(); 

		$login = new Login();

		$login->setUsuarioId($prof->getId());
		$login->setUsername($username);
		$hash2 = $lib->createPasswordHash($hash);
		$login->setHash($hash2);


		$login->insert();
		
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
				echo "<span class=indice>Nome: </span>" . ($umProf["nome"]) . "</br>";
				echo "<span class=indice>Nascimento: </span>" . ($umProf["dataNascimento"]) . "</br>";
				echo "<span class=indice>RG: </span>" . ($umProf["rg"]) . "</br>";
				echo "<span class=indice>CPF: </span>" . ($umProf["cpf"]) . "</br>";
				echo "<span class=indice>Endereço: </span>" . ($umProf["endereco"]) . "</br>";
				echo "<span class=indice>Telefone: </span>" . ($umProf["telefone"]) . "</br>";
				echo "<span class=indice>Celular: </span>" . ($umProf["celular"]) . "</br>";
				echo "<span class=indice>E-mail: </span>" . ($umProf["email"]) . "</br>";
				echo "<span class=indice>Instrumento: </span>" . ($umProf["instrumento"]) . "</br>";
				echo "<span class=indice>Formação Acadêmica: </span>" . ($umProf["formacao"]) . "</br>";
				echo "<span class=indice>Preferências: </span>" . ($umProf["preferencias"]) . "</br>";
				echo "<a href='editar.php?professorId=".($umAluno['usuarioId'])."''>Editar</a>";
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
	}
	
	public function deleteEventoMusical($eventoId){
			$eventoMusical = new EventoMusical();
			$eventoMusical->select($eventoId);
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
	
	
	public function returnHash($username){
		$login = new Login();
		$login->setUsername($username);
		
		return $login->ReturnHash();
		
		
	}
	
	
	
	public function loginUser($username){
		$login = new Login();
		$login->setUsername($username);
		

		return $login->SignIn();
	}
	
	
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

	//Todos os alunos-------------------------------
	public function todosAlunos() {
		try{
			global $db;
			
			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Aluno WHERE Usuario.usuarioId = Aluno.usuarioId");
			$select->execute();

			$todosAlunos = $select->fetchAll();

			foreach($todosAlunos as $umAluno){
				echo '<tr>';
				echo '<td>'.$umAluno['nome'].'</td>';
				echo '<td>'.$umAluno['dataNascimento'].'</td>';
				echo '<td>'.$umAluno['rg'].'</td>';
				echo '<td>'.$umAluno['cpf'].'</td>';
				echo '<td>'.$umAluno['telefone'].'</td>';
				echo '<td>'.$umAluno['celular'].'</td>';
				echo '<td>'.$umAluno['email'].'</td>';
				echo '</tr>';
			}
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	//Todos os professores-------------------------------
	public function todosProfessores() {
		try{
			global $db;
			
			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Professor WHERE Usuario.usuarioId = Professor.usuarioId");
			$select->execute();

			$todosProfessores = $select->fetchAll();

			foreach($todosProfessores as $umAluno){
				echo '<tr>';
				echo '<td>'.$umAluno['nome'].'</td>';
				echo '<td>'.$umAluno['instrumento'].'</td>';
				echo '<td>'.$umAluno['formacao'].'</td>';
				echo '<td>'.$umAluno['preferencias'].'</td>';
				echo '<td>'.$umAluno['dataNascimento'].'</td>';
				echo '<td>'.$umAluno['rg'].'</td>';
				echo '<td>'.$umAluno['cpf'].'</td>';
				echo '<td>'.$umAluno['telefone'].'</td>';
				echo '<td>'.$umAluno['celular'].'</td>';
				echo '<td>'.$umAluno['email'].'</td>';
				echo '</tr>';
			}
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	//Feed de eventos no calendário--------------------------------
	public function todosEventos() {
		try{
			global $db;
			
			$select = $db->prepare("SELECT Evento.eventoId, Evento.data, Evento.horario, Aula.instrumento, Aula.nivel, Aula.sala, Aula.tipo, Aula.presenca, Aula.alunoId, Aula.professorId, A.nome AS nomeAluno, P.nome AS nomeProfessor 
				FROM Evento INNER JOIN Aula ON Aula.eventoId = Evento.eventoId LEFT OUTER JOIN Usuario A ON Aula.alunoId = A.usuarioId LEFT OUTER JOIN Usuario P ON Aula.professorId = P.usuarioId");
			$select->execute();

			$todasAulas = $select->fetchAll();

			$select = $db->prepare("SELECT * FROM Evento INNER JOIN EventoMusical ON EventoMusical.eventoId = Evento.eventoId");
			$select->execute();

			$todosEventosMusicais = $select->fetchAll();

			$feed = array();

			foreach($todasAulas as $umaAula){
				$aux = array();

				$aux['id'] = $umaAula['eventoId'];
				$aux['title'] = $umaAula['instrumento'].": ".$umaAula['nomeAluno'];
				$aux['allDay'] = false;
				$aux['start'] = $umaAula['data'];
				$aux['backgroundColor'] = "#03ACDC";
				$aux['borderColor'] = "#03ACDC";

				$aux['tipo'] = "Aula";
				$aux['data'] = $umaAula['data'];
				$aux['nomeAluno'] = $umaAula['nomeAluno'];
				$aux['alunoId'] = $umaAula['alunoId'];
				$aux['nomeProfessor'] = $umaAula['nomeProfessor'];
				$aux['professorId'] = $umaAula['professorId'];
				$aux['instrumento'] = $umaAula['instrumento'];
				$aux['nivel'] = $umaAula['nivel'];
				$aux['sala'] = $umaAula['sala'];
				$aux['tipoAula'] = $umaAula['tipo'];
				$aux['presenca'] = $umaAula['presenca'];

				$feed[] = $aux;
			}

			foreach($todosEventosMusicais as $umEventoMusical){
				$aux = array();

				$aux['id'] = $umEventoMusical['eventoId'];
				$aux['title'] = $umEventoMusical['nome'];
				$aux['allDay'] = false;
				$aux['start'] = $umEventoMusical['data'];

				$aux['backgroundColor'] = "#FFCA28";
				$aux['borderColor'] = "#FFCA28";
				$aux['textColor'] = "#000000";

				$aux['tipo'] = "Evento musical";
				$aux['data'] = $umEventoMusical['data'];
				$aux['local'] = $umEventoMusical['local'];
				$aux['descricao'] = $umEventoMusical['descricao'];

				$feed[] = $aux;
			}

			echo json_encode($feed);
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	public function eventosProfessor($id) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT Evento.eventoId, Evento.data, Evento.horario, Aula.instrumento, Aula.nivel, Aula.sala, Aula.tipo, Aula.presenca, Aula.alunoId, Aula.professorId, A.nome AS nomeAluno, P.nome AS nomeProfessor 
				FROM Evento INNER JOIN Aula ON Aula.eventoId = Evento.eventoId LEFT OUTER JOIN Usuario A ON Aula.alunoId = A.usuarioId LEFT OUTER JOIN Usuario P ON Aula.professorId = P.usuarioId WHERE Aula.professorId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$minhasAulas = $select->fetchAll();

			$select = $db->prepare("SELECT * FROM Evento INNER JOIN EventoMusical ON EventoMusical.eventoId = Evento.eventoId");
			$select->execute();

			$todosEventosMusicais = $select->fetchAll();

			$feed = array();

			foreach($minhasAulas as $umaAula){
				$aux = array();

				$aux['id'] = $umaAula['eventoId'];
				$aux['title'] = $umaAula['instrumento'].": ".$umaAula['nomeAluno'];
				$aux['allDay'] = false;
				$aux['start'] = $umaAula['data'];
				$aux['backgroundColor'] = "#03ACDC";
				$aux['borderColor'] = "#03ACDC";

				$aux['tipo'] = "Aula";
				$aux['data'] = $umaAula['data'];
				$aux['nomeAluno'] = $umaAula['nomeAluno'];
				$aux['alunoId'] = $umaAula['alunoId'];
				$aux['nomeProfessor'] = $umaAula['nomeProfessor'];
				$aux['professorId'] = $umaAula['professorId'];
				$aux['instrumento'] = $umaAula['instrumento'];
				$aux['nivel'] = $umaAula['nivel'];
				$aux['sala'] = $umaAula['sala'];
				$aux['tipoAula'] = $umaAula['tipo'];
				$aux['presenca'] = $umaAula['presenca'];

				$feed[] = $aux;
			}

			foreach($todosEventosMusicais as $umEventoMusical){
				$aux = array();

				$aux['id'] = $umEventoMusical['eventoId'];
				$aux['title'] = $umEventoMusical['nome'];
				$aux['allDay'] = false;
				$aux['start'] = $umEventoMusical['data'];

				$aux['backgroundColor'] = "#FFCA28";
				$aux['borderColor'] = "#FFCA28";
				$aux['textColor'] = "#000000";

				$aux['tipo'] = "Evento musical";
				$aux['data'] = $umEventoMusical['data'];
				$aux['local'] = $umEventoMusical['local'];
				$aux['descricao'] = $umEventoMusical['descricao'];

				$feed[] = $aux;
			}

			echo json_encode($feed);
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	public function eventosAluno($id) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT Evento.eventoId, Evento.data, Evento.horario, Aula.instrumento, Aula.nivel, Aula.sala, Aula.tipo, Aula.presenca, Aula.alunoId, Aula.professorId, A.nome AS nomeAluno, P.nome AS nomeProfessor 
				FROM Evento INNER JOIN Aula ON Aula.eventoId = Evento.eventoId LEFT OUTER JOIN Usuario A ON Aula.alunoId = A.usuarioId LEFT OUTER JOIN Usuario P ON Aula.professorId = P.usuarioId WHERE Aula.alunoId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$minhasAulas = $select->fetchAll();

			$select = $db->prepare("SELECT * FROM Evento INNER JOIN EventoMusical ON EventoMusical.eventoId = Evento.eventoId");
			$select->execute();

			$todosEventosMusicais = $select->fetchAll();

			$feed = array();

			foreach($minhasAulas as $umaAula){
				$aux = array();

				$aux['id'] = $umaAula['eventoId'];
				$aux['title'] = $umaAula['instrumento'].": ".$umaAula['nomeAluno'];
				$aux['allDay'] = false;
				$aux['start'] = $umaAula['data'];
				$aux['backgroundColor'] = "#03ACDC";
				$aux['borderColor'] = "#03ACDC";

				$aux['tipo'] = "Aula";
				$aux['data'] = $umaAula['data'];
				$aux['nomeAluno'] = $umaAula['nomeAluno'];
				$aux['alunoId'] = $umaAula['alunoId'];
				$aux['nomeProfessor'] = $umaAula['nomeProfessor'];
				$aux['professorId'] = $umaAula['professorId'];
				$aux['instrumento'] = $umaAula['instrumento'];
				$aux['nivel'] = $umaAula['nivel'];
				$aux['sala'] = $umaAula['sala'];
				$aux['tipoAula'] = $umaAula['tipo'];
				$aux['presenca'] = $umaAula['presenca'];

				$feed[] = $aux;
			}

			foreach($todosEventosMusicais as $umEventoMusical){
				$aux = array();

				$aux['id'] = $umEventoMusical['eventoId'];
				$aux['title'] = $umEventoMusical['nome'];
				$aux['allDay'] = false;
				$aux['start'] = $umEventoMusical['data'];

				$aux['backgroundColor'] = "#FFCA28";
				$aux['borderColor'] = "#FFCA28";
				$aux['textColor'] = "#000000";

				$aux['tipo'] = "Evento musical";
				$aux['data'] = $umEventoMusical['data'];
				$aux['local'] = $umEventoMusical['local'];
				$aux['descricao'] = $umEventoMusical['descricao'];

				$feed[] = $aux;
			}

			echo json_encode($feed);
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	//Select com professores-----------------------------------------------------
	public function professoresPorInstrumento($instrumento) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT Usuario.usuarioId, Usuario.nome FROM Usuario INNER JOIN Professor ON Usuario.usuarioId = Professor.usuarioId WHERE Professor.instrumento = :instrumento");
			$select->bindParam(":instrumento", $instrumento, PDO::PARAM_STR);
			$select->execute();

			$todosProfessores = $select->fetchAll();

			echo '<option value="" selected disabled>Professor</option>';

			foreach($todosProfessores as $umProfessor){
				echo '<option value="'.$umProfessor['usuarioId'].'">'.$umProfessor['nome'].'</option>';
			}
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	public function selectTodosProfessores($selecionado = null) {
		try{
			global $db;
			
			$select = $db->prepare("SELECT Usuario.usuarioId, Usuario.nome FROM Usuario INNER JOIN Professor ON Usuario.usuarioId = Professor.usuarioId");
			$select->execute();

			$todosProfessores = $select->fetchAll();

			echo '<option selected disabled>Escolha o professor do aluno</option>';

			foreach($todosProfessores as $umProfessor){
				if($umProfessor['usuarioId'] == $selecionado) echo '<option value="'.$umProfessor['usuarioId'].'" selected>'.$umProfessor['nome'].'</option>';
				else echo '<option value="'.$umProfessor['usuarioId'].'">'.$umProfessor['nome'].'</option>';
			}
		} catch(PDOException $e){
			var_dump($e);
		}
	}

	//Select com alunos-----------------------------------------------------
	public function alunosPorProfessor($professorId) {
		try{
			global $db;

			$select = $db->prepare("SELECT Usuario.usuarioId, Usuario.nome FROM TemAula INNER JOIN Aluno ON TemAula.alunoId = Aluno.usuarioId INNER JOIN Usuario ON Aluno.usuarioId = Usuario.usuarioId WHERE TemAula.professorId = :id");
			$select->bindParam(":id", $professorId, PDO::PARAM_INT);
			$select->execute();

			$alunosDeUmProfessor = $select->fetchAll();

			echo '<option value="" selected disabled>Aluno</option>';

			foreach($alunosDeUmProfessor as $umAluno){
				echo '<option value="'.$umAluno['usuarioId'].'">'.$umAluno['nome'].'</option>';
			}
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}

	//Get aluno ------------------
	public function getAluno($id) {
		try{
			global $db;

			$select = $db->prepare("SELECT Usuario.usuarioId, Usuario.nome, Usuario.dataNascimento, Usuario.rg, Usuario.cpf, Usuario.endereco, Usuario.telefone, Usuario.celular, Usuario.email, Login.username, TemAula.professorId 
				FROM Usuario INNER JOIN Login ON Usuario.usuarioId = Login.usuarioId INNER JOIN TemAula ON TemAula.alunoId = Usuario.usuarioId WHERE Usuario.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$aluno = $select->fetch(PDO::FETCH_ASSOC);

			return $aluno;
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}

	//Get professor ---------------
	public function getProfessor($id) {
		try{
			global $db;

			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Professor ON Usuario.usuarioId = Professor.usuarioId WHERE usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$professor = $select->fetch(PDO::FETCH_ASSOC);

			return $professor;
		} catch(PDOException $e){
			var_dump($e) ;
		}
	}
}