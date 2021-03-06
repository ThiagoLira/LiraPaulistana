<?php

abstract class Usuario {
	private $usuarioId;
	private $nome;
	private $dataNascimento;
	private $rg;
	private $cpf;
	private $endereco;
	private $telefone;
	private $celular;
	private $email;
	private $grauPermissao = 1;

	public function setId($id) {
		$this->usuarioId = $id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function setDataNascimento($dataNascimento){
		$data = DateTime::createFromFormat("d/m/Y", $dataNascimento);
		$this->dataNascimento = $data;
	}

	public function setRG($rg){
		$this->rg = $rg;
	}

	public function setCPF($cpf){
		$this->cpf = $cpf;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function setCelular($celular){
		$this->celular = $celular;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setGrauPermissao($grauPermissao){
		$this->grauPermissao = $grauPermissao;
	}

	public function getId() {
		return $this->usuarioId;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getDataNascimento(){
		return $this->dataNascimento->format("Y-m-d");
	}

	public function getRG(){
		return $this->rg;
	}

	public function getCPF(){
		return $this->cpf;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function getCelular(){
		return $this->celular;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getGrauPermissao(){
		return $this->grauPermissao;
	}
}

class Aluno extends Usuario {
	// $grauPermissao = 1;

	public function insert(){
		try {
			global $db;

			$insertUsuario = $db->prepare("INSERT INTO Usuario(nome,dataNascimento,rg,cpf,endereco,telefone,celular,email,grauPermissao) VALUES (:nome,:dataNascimento,:rg,:cpf,:endereco,:telefone,:celular,:email,:grauPermissao)");
			$insertUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":dataNascimento", $this->getDataNascimento());
			$insertUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$insertUsuario->execute();

			$this->setId($db->lastInsertId());

			$insertAluno = $db->prepare("INSERT INTO Aluno(usuarioId) VALUES (:id)");
			$insertAluno->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$insertAluno->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function insertTemAula($professorId){
		try {
			global $db;

			$insertAluno = $db->prepare("INSERT INTO TemAula(alunoId,professorId) VALUES (:alunoId,:professorId)");
			$insertAluno->bindParam(":alunoId", $this->getId(), PDO::PARAM_INT);
			$insertAluno->bindParam(":professorId", $professorId, PDO::PARAM_INT);
			$insertAluno->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateUsuario = $db->prepare("UPDATE Usuario SET nome = :nome, dataNascimento = :dataNascimento, rg = :rg, cpf = :cpf, endereco = :endereco, telefone = :telefone, celular = :celular, email = :email, grauPermissao = :grauPermissao WHERE usuarioId = :id");
			$updateUsuario->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$updateUsuario->execute();

			// $updateAluno = $db->prepare("UPDATE Aluno SET nome = :nome WHERE eventoId = :id");
			// $updateAluno->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			// $updateAluno->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function updateTemAula($professorId){
		try {
			global $db;

			$updateUsuario = $db->prepare("UPDATE TemAula SET usuarioId = :usuarioId, professorId = :professorId WHERE usuarioId = :id");
			$updateUsuario->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":professorId", $professorId, PDO::PARAM_STR);
			$updateUsuario->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function select($id){
		try {
			global $db;

			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Aluno ON Usuario.usuarioId = Aluno.usuarioId WHERE Usuario.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umAluno = $select->fetch(PDO::FETCH_ASSOC);

			if(count($umAluno)>0){
				$this->setId($umAluno['usuarioId']);
				$this->setNome($umAluno['nome']);
				$this->setDataNascimento($umAluno['dataNascimento']);
				$this->setRG($umAluno['rg']);
				$this->setCPF($umAluno['cpf']);
				$this->setEndereco($umAluno['endereco']);
				$this->setTelefone($umAluno['telefone']);
				$this->setCelular($umAluno['celular']);
				$this->setEmail($umAluno['email']);
				$this->setGrauPermissao($umAluno['grauPermissao']);
			}

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function delete(){
		try {
			global $db;			
			
			$delete = $db->prepare("DELETE FROM Usuario WHERE usuarioId = :id");
			$delete->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$delete->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}
}

class Administrador extends Usuario {
	// $grauPermissao = 5;

		public function insert(){
		try {
			global $db;

			$insertUsuario = $db->prepare("INSERT INTO Usuario(nome,dataNascimento,rg,cpf,endereco,telefone,celular,email,grauPermissao) VALUES (:nome,:dataNascimento,:rg,:cpf,:endereco,:telefone,:celular,:email,:grauPermissao)");
			$insertUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$insertUsuario->execute();

			$this->setId($db->lastInsertId());

			$insertAdmin = $db->prepare("INSERT INTO Administrador(usuarioId) VALUES (:id)");
			$insertAdmin->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$insertAdmin->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateUsuario = $db->prepare("UPDATE Usuario SET nome = :nome, dataNascimento = :dataNascimento, rg = :rg, cpf = :cpf, endereco = :endereco, telefone = :telefone, celular = :celular, email = :email, grauPermissao = :grauPermissao WHERE usuarioId = :id");
			$updateUsuario->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$updateUsuario->execute();

			// $updateAluno = $db->prepare("UPDATE Aluno SET nome = :nome WHERE eventoId = :id");
			// $updateAluno->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			// $updateAluno->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function select($id){
		try {
			global $db;

			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Administrador ON Usuario.usuarioId = Administrador.usuarioId WHERE Usuario.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umAdmin = $select->fetch(PDO::FETCH_ASSOC);

			if(count($umAdmin)>0){
				$this->setId($umAdmin['usuarioId']);
				$this->setNome($umAdmin['nome']);
				$this->setDataNascimento($umAdmin['dataNascimento']);
				$this->setRG($umAdmin['rg']);
				$this->setCPF($umAdmin['cpf']);
				$this->setEndereco($umAdmin['endereco']);
				$this->setTelefone($umAdmin['telefone']);
				$this->setCelular($umAdmin['celular']);
				$this->setEmail($umAdmin['email']);
				$this->setGrauPermissao($umAdmin['grauPermissao']);
			}

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function delete(){
		try {
			global $db;			
			
			$delete = $db->prepare("DELETE FROM Evento WHERE usuarioId = :id");
			$delete->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$delete->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}
}

class Operador extends Usuario {
	// $grauPermissao = 5;

		public function insert(){
		try {
			global $db;

			$insertUsuario = $db->prepare("INSERT INTO Usuario(nome,dataNascimento,rg,cpf,endereco,telefone,celular,email,grauPermissao) VALUES (:nome,:dataNascimento,:rg,:cpf,:endereco,:telefone,:celular,:email,:grauPermissao)");
			$insertUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$insertUsuario->execute();

			$this->setId($db->lastInsertId());

			$insertOperador = $db->prepare("INSERT INTO Operador(usuarioId) VALUES (:id)");
			$insertOperador->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$insertOperador->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateUsuario = $db->prepare("UPDATE Usuario SET nome = :nome, dataNascimento = :dataNascimento, rg = :rg, cpf = :cpf, endereco = :endereco, telefone = :telefone, celular = :celular, email = :email, grauPermissao = :grauPermissao WHERE usuarioId = :id");
			$updateUsuario->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$updateUsuario->execute();

			// $updateAluno = $db->prepare("UPDATE Aluno SET nome = :nome WHERE eventoId = :id");
			// $updateAluno->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			// $updateAluno->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function select($id){
		try {
			global $db;

			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Operado ON Usuario.usuarioId = Operador.usuarioId WHERE Usuario.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umOperador = $select->fetch(PDO::FETCH_ASSOC);

			if(count($umOperador)>0){
				$this->setId($umOperador['usuarioId']);
				$this->setNome($umOperador['nome']);
				$this->setDataNascimento($umOperador['dataNascimento']);
				$this->setRG($umOperador['rg']);
				$this->setCPF($umOperador['cpf']);
				$this->setEndereco($umOperador['endereco']);
				$this->setTelefone($umOperador['telefone']);
				$this->setCelular($umOperador['celular']);
				$this->setEmail($umOperador['email']);
				$this->setGrauPermissao($umOperador['grauPermissao']);
			}

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function delete(){
		try {
			global $db;			
			
			$delete = $db->prepare("DELETE FROM Evento WHERE usuarioId = :id");
			$delete->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$delete->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}
}

class Professor extends Usuario {
	private $instrumento;
	private $formacaoMusical;
	private $preferencias;

	public function getInstrumento(){
		return $this->instrumento;
	}
	public function setInstrumento($instr){
		$this->instrumento = $instr;
	}

	public function getFormacaoMusical(){
		return $this->formacaoMusical;
	}
	public function setFormacaoMusical($form){
		$this->formacaoMusical = $form;
	}

	public function getPreferencias(){
		return $this->preferencias;
	}
	public function setPreferencias($pref){
		$this->preferencias = $pref;
	}

		public function insert(){
		try {
			global $db;

			$insertUsuario = $db->prepare("INSERT INTO Usuario(nome,dataNascimento,rg,cpf,endereco,telefone,celular,email,grauPermissao) VALUES (:nome,:dataNascimento,:rg,:cpf,:endereco,:telefone,:celular,:email,:grauPermissao)");
			$insertUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$insertUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$insertUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$insertUsuario->execute();

			$this->setId($db->lastInsertId());

			$insertProfessor = $db->prepare("INSERT INTO Professor(usuarioId,instrumento,formacao,preferencias) VALUES (:id,:instrumento,:formacao,:preferencias)");
			$insertProfessor->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$insertProfessor->bindParam(":instrumento", $this->getInstrumento(), PDO::PARAM_INT);
			$insertProfessor->bindParam(":formacao", $this->getFormacaoMusical(), PDO::PARAM_INT);
			$insertProfessor->bindParam(":preferencias", $this->getPreferencias(), PDO::PARAM_INT);
			$insertProfessor->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateUsuario = $db->prepare("UPDATE Usuario SET nome = :nome, dataNascimento = :dataNascimento, rg = :rg, cpf = :cpf, endereco = :endereco, telefone = :telefone, celular = :celular, email = :email, grauPermissao = :grauPermissao WHERE usuarioId = :id");
			$updateUsuario->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":dataNascimento", $this->getDataNascimento(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":rg", $this->getRG(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":cpf", $this->getCPF(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":endereco", $this->getEndereco(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":telefone", $this->getTelefone(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":celular", $this->getCelular(), PDO::PARAM_INT);
			$updateUsuario->bindParam(":email", $this->getEmail(), PDO::PARAM_STR);
			$updateUsuario->bindParam(":grauPermissao", $this->getGrauPermissao(), PDO::PARAM_INT);
			$updateUsuario->execute();

			$updateProfessor = $db->prepare("UPDATE Professor SET instrumento = :instrumento, formacao = :formacao, preferencias = :preferencias WHERE usuarioId = :id");
			$updateProfessor->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateProfessor->bindParam(":instrumento", $this->getInstrumento(), PDO::PARAM_INT);
			$updateProfessor->bindParam(":formacao", $this->getFormacaoMusical(), PDO::PARAM_INT);
			$updateProfessor->bindParam(":preferencias", $this->getPreferencias(), PDO::PARAM_INT);
			$updateProfessor->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function select($id){
		try {
			global $db;

			$select = $db->prepare("SELECT * FROM Usuario INNER JOIN Professor ON Usuario.usuarioId = Professor.usuarioId WHERE Usuario.usuarioId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umProfessor = $select->fetch(PDO::FETCH_ASSOC);

			if(count($umProfessor)>0){
				$this->setId($umProfessor['usuarioId']);
				$this->setNome($umProfessor['nome']);
				$this->setDataNascimento($umProfessor['dataNascimento']);
				$this->setRG($umProfessor['rg']);
				$this->setCPF($umProfessor['cpf']);
				$this->setEndereco($umProfessor['endereco']);
				$this->setTelefone($umProfessor['telefone']);
				$this->setCelular($umProfessor['celular']);
				$this->setEmail($umProfessor['email']);
				$this->setGrauPermissao($umProfessor['grauPermissao']);
				$this->setInstrumento($umProfessor['instrumento']);
				$this->setFormacaoMusical($umProfessor['formacao']);
				$this->setPreferencias($umProfessor['preferencias']);
			}

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function delete(){
		try {
			global $db;			
			
			$delete = $db->prepare("DELETE FROM Evento WHERE usuarioId = :id");
			$delete->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$delete->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}
}