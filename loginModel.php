<?php

require_once("/loginModel.php");
require_once("/loginview.php");

class loginModel{
	private $un = 'Admin';
	private $pw = 'password';
	private $correctLogin;
	
	public function __construct(){
		
	}
	
	public function loginModel(){
	
		return $this->view->inputHtml();
	}
	public function checkLogin($username, $password){
		
		if($this->un = $username || $this->pw = $password){
			return $this->correctLogin = TRUE;
		}else{
			return $this->correctLogin = FALSE;
		}
		
		
	}
}
