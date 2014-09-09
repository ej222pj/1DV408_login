<?php

require_once("/loginModel.php");
require_once("/loginview.php");

class loginModel{
	private $username = 'Admin';
	private $password = 'password';
	private $correctLogin = false;
	
	public function __construct(){
		
	}
	
	public function loginModel(){
	
		return $this->view->inputHtml();
	}
	public function checkLogin($username, $password){
		$this->correctLogin = ($this->username == $this->$password);
		
		return $this->correctLogin;
	}
}
