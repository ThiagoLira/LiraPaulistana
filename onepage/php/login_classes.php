<?php
require_once "conexao.php";

class Login {
	private $usuarioId;
	private $username;
	private $hash;

	public function getUsuarioId(){
		return $this->usuarioId;
	}
	public function setUsuarioId($id){
		$this->usuarioId = $id;
	}

	public function getUsername(){
		return $this->username;
	}
	public function setUsername($username){
		$this->username = $username;
	}

	public function getHash(){
		return $this->hash;
	}
	public function setHash($hash){
		$this->hash = $hash;
	}

	public function insert(){
		try {
			global $db;

			$insertLogin = $db->prepare("INSERT INTO Login(username,hash,usuarioId) VALUES (:username,:hash,:usuarioId)");
			$insertLogin->bindParam(":username", $this->getUsername(), PDO::PARAM_STR);
			$insertLogin->bindParam(":hash", $this->getHash(), PDO::PARAM_STR);
			$insertLogin->bindParam(":usuarioId", $this->getUsuarioId(), PDO::PARAM_INT);
			$insertLogin->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function update(){
		try {
			global $db;

			$updateEvento = $db->prepare("UPDATE Login SET username = :username, hash = :hash WHERE usuarioId = :id");
			$updateEvento->bindParam(":username", $this->getUsername(), PDO::PARAM_STR);
			$updateEvento->bindParam(":hash", $this->getHash(), PDO::PARAM_STR);
			$updateEvento->bindParam(":id", $this->getUsuarioId(), PDO::PARAM_INT);
			$updateEvento->execute();

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}
	
	
	
	public function ReturnHash(){
		global $db;
		
		
		try{
			$login = $db->prepare("SELECT * FROM Login where username = :username ") or die(mysql_error());
			$login->bindParam(":username", $this->getUsername());
			$login->execute();
			
			$row=  $login->fetch(PDO::FETCH_ASSOC);
			
			
			return $row['hash'];
			
			
			}	
			
			catch(PDOException $e){
			//var_dump($e);
			return false;
		}
		
		
	}
	
	
	public function SignIn() {
		global $db;

		try {
			$login = $db->prepare("SELECT * FROM Login where username = :username") or die(mysql_error());
			
			$login->bindParam(":username", $this->getUsername());
			
			$login->execute();

			$row = $login->fetch(PDO::FETCH_ASSOC);

			if($row) {
				$_SESSION['login'] = true;
				$_SESSION['username'] = $row['username'];
				$_SESSION['usuarioId'] = $row['usuarioId'];
				return true;
			}
			else {
				return false;
			}
		}
		catch(PDOException $e){
			//var_dump($e);
			return false;
		}
	}

	public function SignOut() {
        $_SESSION = array();
        session_destroy();
    }

    public function checkSession() {
        if (isset($_SESSION['login']) and $_SESSION['login'] === true) {
            return true;
        } else {
            return false;
        }
    }



    public function isLogin(){
    	global $db;


    	try{
    	$login = $db->prepare("SELECT * FROM Login where username = :username") or die(mysql_error());
    	$login->bindParam(":username", $this->getUsername());
    	$login->execute();
    	$row = $login->fetch(PDO::FETCH_ASSOC);

    	if($row){
    		return true;
    	}
    	else {
    		return false;
    	}

    }

catch(PDOException $e){
			//var_dump($e);
			return false;
		}
}

}