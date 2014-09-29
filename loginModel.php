<?php

require_once("/loginModel.php");
require_once("/loginView.php");

class loginModel{
	private $un;
	private $UnSession = "loginModel::un";
	private $pw;
	private $PwSession = "loginModel::pw";
	private $cryptedPw;
	private $userId = "loginModel::userId";
	private $Id;
	private $IdSession = "loginModel::Id";
	
	public function __construct($Id, $un, $pw){
		$this->Id = $Id;
		$this->un = $un;
		$this->pw = $pw;
	}
	
	public function loginModel($userId, $pass, $cryptedPw){
		if(crypt($pass, $cryptedPw) === $cryptedPw){
			$_SESSION[$this->IdSession] = $this->Id;
			$_SESSION[$this->UnSession] = $this->un;
			$_SESSION[$this->PwSession] = $this->pw;
			$_SESSION[$this->userId] = base64_encode($userId);
			
			return true;
		}
		
	}

	public function logoutModel(){
		unset($_SESSION[$this->IdSession]);
		unset($_SESSION[$this->UnSession]);
		unset($_SESSION[$this->PwSession]);
	}
	
	public function loggedIn($clientInfo){
		if(isset($_SESSION[$this->IdSession]) && $_SESSION[$this->IdSession] === $this->Id
		&& $_SESSION[$this->UnSession] === $this->un && $_SESSION[$this->PwSession] === $this->pw
		&& $_SESSION[$this->userId] === base64_encode($clientInfo)){
			return true;
		}
		return false;
	}
	
	public function getCryptedPass(){
		return $this->cryptedPw;
	}
	public function getUsername(){
		return $this->un;
	}
	public function getPassword(){
		return $this->pw;
	}
	public function cryptPw($pw){
		$this->cryptedPw = crypt($pw);
	}
}
