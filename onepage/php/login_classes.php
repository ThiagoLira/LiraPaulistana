<?php
require_once "conexao.php";

class Login {
	private $usuarioId;
	private $username;
	private $senha;

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

	public function SignIn() {
		global $db;

		try {
			$login = $db->prepare("SELECT *  FROM Login where username = :username AND hash = :hash") or die(mysql_error());
			$login->bindParam(":username", $this->getUsername());
			$login->bindParam(":hash", $this->getHash());

			$login->execute();

			$row = $login->fetch(PDO::FETCH_ASSOC);

			if(count($row) > 0) {
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
}
