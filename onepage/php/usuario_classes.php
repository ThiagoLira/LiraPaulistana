<?php

abstract class Usuario {
	private $nome;
	private $dataNascimento;
	private $rg;
	private $cpf;
	private $endereco;
	private $telefone;
	private $celular;
	private $email;
	private $grauPermissao = 1;

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function setDataNascimento($dataNascimento){
		$this->dataNascimento = $dataNascimento;
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

	public function getNome(){
		return $this->nome;
	}

	public function getDataNascimento(){
		return $this->dataNascimento;
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
}

class Administrador extends Usuario {
	// $grauPermissao = 5;
}

class Operador extends Usuario {
	// $grauPermissao = 5;
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
}