<?php
	class Item{
		private $link;
		private $tipo;
		private $data_adicao;

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

		public function getData_adicao(){
			return $this->data_adicao;
		}
		public function setData_adicao($data){
			$this->data_adicao = $data;
		}
	}
?>