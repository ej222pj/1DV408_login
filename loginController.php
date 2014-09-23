<?php

require_once("/loginModel.php");
require_once("/loginView.php");

class loginController{
	private $User = "Admin";
	private $Pass = "Password";
	private $Id = 1; 
	private $view;
	private $model;
	
	public function __construct(){
		$this->model = new loginModel($this->Id, $this->User, $this->Pass);
		$this->view = new loginView($this->model);
		$this->model->cryptPw($this->model->getPassword());
	}
	
	public function loginPage(){
		if($this->model->loggedIn($this->view->getClientInfo())){
			return $this->logout();
		}
		else{
			return $this->login();
		}
	}
	
	public function login(){		
		if($this->view->clickLogin()){//Kollar om man vill logga in å om du skrivit rätt
			if($this->view->checkInput()){
				if($this->view->remeberChecked()){
					$this->view->setCookie();
				}//Loginmodel är den som functionen som loggar in användaren
				$this->model->loginModel(
					$this->view->getClientInfo(),
					$this->model->getPassword(),
					$this->model->getCryptedPass()
				);
			}
		}
		//var_dump($_SERVER);
		return $this->view->loginPrint();
	}
	
	
	public function logout(){
		if($this->view->clickLogout()){
			if($this->view->checkCookie()){
				$this->view->killCookie();
			}
			$this->model->logoutModel();
		}
		return $this->view->logoutPrint();
	}
}
