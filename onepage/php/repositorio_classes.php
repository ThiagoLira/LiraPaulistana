<?php
	class Item {
		private $itemId;
		private $nome;
		private $link;
		private $tipo;
		// private $data_adicao;
		private $professorId;
		private $alunoId;

		public function getId(){
			return $this->itemId;
		}
		public function setId($id){
			$this->itemId = $id;
		}

		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getLink(){
			return $this->link;
		}
		public function setLink($lin){
			$this->link = $lin;
		}

		public function getTipo(){
			return $this->tipo;
		}
		public function setTipo($tip){
			$this->tipo = $tip;
		}

		// public function getData_adicao(){
		// 	return $this->data_adicao;
		// }
		// public function setData_adicao($data){
		// 	$this->data_adicao = $data;
		// }

		public function getProfessorId(){
			return $this->professorId;
		}
		public function setProfessorId($id){
			$this->professorId = $id;
		}

		public function getAlunoId(){
			return $this->alunoId;
		}
		public function setAlunoId($id){
			$this->alunoId = $id;
		}

		public function insert() {
			try {
				global $db;

				$insert = $db->prepare("INSERT INTO Item(nome,link,tipo,professorId,alunoId) VALUES (:nome,:link,:tipo,:professorId,:alunoId)");
				$insert->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
				$insert->bindParam(":link", $this->getLink(), PDO::PARAM_STR);
				$insert->bindParam(":tipo", $this->getTipo(), PDO::PARAM_STR);
				$insert->bindParam(":professorId", $this->getProfessorId(), PDO::PARAM_INT);
				$insert->bindParam(":alunoId", $this->getAlunoId(), PDO::PARAM_INT);
				$insert->execute();

				$this->setId($db->lastInsertId());

				return true;
			}
			catch(PDOException $e) {
				return false;
			}
		}

		public function update() {
			try {
				global $db;

				$update = $db->prepare("UPDATE Item SET nome = :nome, link = :link, tipo = :tipo, professorId = :professorId, alunoId = :alunoId WHERE itemId = :id");
				$update->bindParam(":id", $this->getId(), PDO::PARAM_INT);
				$insert->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
				$update->bindParam(":link", $this->getLink(), PDO::PARAM_STR);
				$update->bindParam(":tipo", $this->getTipo(), PDO::PARAM_STR);
				$update->bindParam(":professorId", $this->getProfessorId(), PDO::PARAM_INT);
				$update->bindParam(":alunoId", $this->getAlunoId(), PDO::PARAM_INT);
				$update->execute();

				return true;
			}
			catch(PDOException $e) {
				return false;
			}
		}

		public function select($id) {
			try {
				global $db;

				$select = $db->prepare("SELECT * FROM Item WHERE Item.itemId = :id");
				$select->bindParam(":id", $id, PDO::PARAM_INT);
				$select->execute();

				$umItem = $select->fetch(PDO::FETCH_ASSOC);

				if(count($umItem)>0){
					$this->setId($umItem['itemId']);
					$this->setNome($umItem['nome']);
					$this->setLink($umItem['link']);
					$this->setTipo($umItem['tipo']);
					$this->setProfessorId($umItem['professorId']);
					$this->setAlunoId($umItem['alunoId']);
				}

				return true;
			}
			catch(PDOException $e) {
				return false;
			}
		}

		public function delete() {
			try {
			global $db;			
			
			$delete = $db->prepare("DELETE FROM Item WHERE itemId = :id");
			$delete->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$delete->execute();

				return true;
			}
			catch (PDOException $e) {
				return false;
			}
		}
	}