<?php
abstract class Evento {
	protected $data;
	protected $horario;

	public function getData(){
		return $this->data;
	}
	public function setData($novaData){
		$this->data = $novaData;
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
}