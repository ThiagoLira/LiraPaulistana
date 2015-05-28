<?php
require_once "conexao.php";

abstract class Evento {
	private $eventoId;
	protected $data;
	protected $horario;

	public function getId(){
		return $this->eventoId;
	}
	public function setId($id){
		$this->eventoId = $id;
	}

	public function getData(){
		return $this->data->format("Y-m-d");
	}
	public function setData($novaData){
		$dataFormatada = DateTime::createFromFormat("d/m/Y", $novaData);
		$this->data = $dataFormatada;
	}

	public function getHorario(){
		return $this->horario;
	}
	public function setHorario($horario){
		$this->horario = $horario;
	}
}

class Aula extends Evento {
	private $instrumento;
	private $nivel;
	private $sala;
	private $tipo;
	private $presenca_aluno;
	private $alunoId;
	private $professorId;

	public function getInstrumento(){
		return $this->instrumento;
	}
	public function setInstrumento($instr){
		$this->instrumento = $instr;
	}

	public function getNivel(){
		return $this->nivel;
	}
	public function setNivel($niv){
		$this->nivel = $niv;
	}

	public function getSala(){
		return $this->sala;
	}
	public function setSala($sal){
		$this->sala = $sal;
	}

	public function getTipo(){
		return $this->tipo;
	}
	public function setTipo($tip){
		$this->tipo = $tip;
	}

	public function getPresenca(){
		return $this->presenca_aluno;
	}
	public function setPresenca($pres){
		$this->presenca_aluno = $pres;
	}

	public function getAlunoId(){
		return $this->alunoId;
	}
	public function setAlunoId($id){
		$this->alunoId = $id;
	}

	public function getProfessorId(){
		return $this->professorId;
	}
	public function setProfessorId($id){
		$this->professorId = $id;
	}

	public function insert(){
		try {
			global $db;

			$insertEvento = $db->prepare("INSERT INTO Evento(data,horario) VALUES (:data,:horario)");
			$insertEvento->bindParam(":data", $this->getData(), PDO::PARAM_STR);
			$insertEvento->bindParam(":horario", $this->getHorario(), PDO::PARAM_STR);
			$insertEvento->execute();

			$this->setId($db->lastInsertId());

			$insertAula = $db->prepare("INSERT INTO Aula(eventoId,instrumento,nivel,sala,tipo,presenca,alunoId,professorId) VALUES (:id,:instrumento,:nivel,:sala,:tipo,:presenca,:alunoId,:professorId)");
			$insertAula->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$insertAula->bindParam(":instrumento", $this->getInstrumento(), PDO::PARAM_STR);
			$insertAula->bindParam(":nivel", $this->getNivel(), PDO::PARAM_STR);
			$insertAula->bindParam(":sala", $this->getSala(), PDO::PARAM_STR);
			$insertAula->bindParam(":tipo", $this->getTipo(), PDO::PARAM_STR);
			$insertAula->bindParam(":presenca", $this->getPresenca(), PDO::PARAM_INT);
			$insertAula->bindParam(":alunoId", $this->getAlunoId(), PDO::PARAM_INT);
			$insertAula->bindParam(":professorId", $this->getProfessorId(), PDO::PARAM_INT);
			$insertAula->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateEvento = $db->prepare("UPDATE Evento SET data = :data, horario = :horario WHERE eventoId = :id");
			$updateEvento->bindParam(":data", $this->getData(), PDO::PARAM_STR);
			$updateEvento->bindParam(":horario", $this->getHorario(), PDO::PARAM_STR);
			$updateEvento->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateEvento->execute();

			$updateAula = $db->prepare("UPDATE Aula SET instrumento = :instrumento, nivel = :nivel, sala = :sala, tipo = :tipo, presenca = :presenca, alunoId = :alunoId, professorId = :professorId WHERE eventoId = :id");
			$updateAula->bindParam(":instrumento", $this->getInstrumento(), PDO::PARAM_STR);
			$updateAula->bindParam(":nivel", $this->getNivel(), PDO::PARAM_STR);
			$updateAula->bindParam(":sala", $this->getSala(), PDO::PARAM_STR);
			$updateAula->bindParam(":tipo", $this->getTipo(), PDO::PARAM_STR);
			$updateAula->bindParam(":presenca", $this->getPresenca(), PDO::PARAM_INT);
			$updateAula->bindParam(":alunoId", $this->getAlunoId(), PDO::PARAM_INT);
			$updateAula->bindParam(":professorId", $this->getProfessorId(), PDO::PARAM_INT);
			$updateAula->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateAula->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function select($id){
		try {
			global $db;

			$select = $db->prepare("SELECT * FROM Evento INNER JOIN Aula ON Evento.eventoId = Aula.eventoId WHERE Evento.eventoId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umaAula = $select->fetch(PDO::FETCH_ASSOC);

			if(count($umaAula)>0){
				$this->setId($umaAula['eventoId']);
				$this->setData($umaAula['data']);
				$this->setHorario($umaAula['horario']);
				$this->setInstrumento($umaAula['instrumento']);
				$this->setNivel($umaAula['nivel']);
				$this->setSala($umaAula['sala']);
				$this->setTipo($umaAula['tipo']);
				$this->setPresenca($umaAula['presenca']);
				$this->setAlunoId($umaAula['alunoId']);
				$this->setProfessorId($umaAula['professorId']);
			}

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function delete(){
		try {
			$delete = $db->prepare("DELETE FROM Evento WHERE eventoId = :id");
			$delete->bindParam(":id", $this->getId());
			$delete->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}
}

class EventoMusical extends Evento {
	private $nome;
	private $local;
	private $descricao;

	public function getNome(){
		return $this->nome;
	}
	public function setNome($nom){
		$this->nome = $nom;
	}

	public function getLocal(){
		return $this->local;
	}
	public function setLocal($loc){
		$this->local = $loc;
	}

	public function getDescricao(){
		return $this->descricao;
	}
	public function setDescricao($desc){
		$this->descricao = $desc;
	}

	public function insert(){
		try {
			global $db;

			$insertEvento = $db->prepare("INSERT INTO Evento(data,horario) VALUES (:data,:horario)");
			$insertEvento->bindParam(":data", $this->getData(), PDO::PARAM_STR);
			$insertEvento->bindParam(":horario", $this->getHorario(), PDO::PARAM_STR);
			$insertEvento->execute();

			$this->setId($db->lastInsertId());

			$insertEventoMusical = $db->prepare("INSERT INTO EventoMusical(eventoId,nome,local,descricao) VALUES (:id,:nome,:local,:descricao)");
			$insertEventoMusical->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$insertEventoMusical->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$insertEventoMusical->bindParam(":local", $this->getLocal(), PDO::PARAM_STR);
			$insertEventoMusical->bindParam(":descricao", $this->getDescricao(), PDO::PARAM_STR);
			$insertEventoMusical->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateEvento = $db->prepare("UPDATE Evento SET data = :data, horario = :horario WHERE eventoId = :id");
			$updateEvento->bindParam(":data", $this->getData(), PDO::PARAM_STR);
			$updateEvento->bindParam(":horario", $this->getHorario(), PDO::PARAM_STR);
			$updateEvento->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateEvento->execute();

			$updateEventoMusical = $db->prepare("UPDATE EventoMusical SET nome = :nome, local = :local, descricao = :descricao WHERE eventoId = :id");
			$updateEventoMusical->bindParam(":nome", $this->getNome(), PDO::PARAM_STR);
			$updateEventoMusical->bindParam(":local", $this->getLocal(), PDO::PARAM_STR);
			$updateEventoMusical->bindParam(":descricao", $this->getDescricao(), PDO::PARAM_STR);
			$updateEventoMusical->bindParam(":id", $this->getId(), PDO::PARAM_INT);
			$updateEventoMusical->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function select($id){
		try {
			global $db;

			$select = $db->prepare("SELECT * FROM Evento INNER JOIN EventoMusical ON Evento.eventoId = EventoMusical.eventoId WHERE Evento.eventoId = :id");
			$select->bindParam(":id", $id, PDO::PARAM_INT);
			$select->execute();

			$umEvento = $select->fetch(PDO::FETCH_ASSOC);

			if(count($umEvento)>0){
				$this->setId($umEvento['eventoId']);
				$this->setData($umEvento['data']);
				$this->setHorario($umEvento['horario']);
				$this->setNome($umEvento['nome']);
				$this->setLocal($umEvento['local']);
				$this->setDescricao($umEvento['descricao']);
			}

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}

	public function delete(){
		try {
			$delete = $db->prepare("DELETE FROM Evento WHERE eventoId = :id");
			$delete->bindParam(":id", $this->getId());
			$delete->execute();

			return true;
		}
		catch(PDOException $e) {
			return false;
		}
	}
}