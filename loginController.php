<?php

require_once("/loginModel.php");
require_once("/loginview.php");

class loginController{
	
	private $view;
	private $model;
	
	public function __construct(){
		$this->model = new loginModel();
		$this->view = new loginView();
		}
	public function doLogin(){
		$control = $this->view->inputHtml();
		if(isset($_POST['submit'])){
			$this->view->input();
			$username = $this->view->getUsername();
			$password = $this->view->getPassword();
			$this->model->checkLogin($username, $password);
		}
		return $control;
	}
}
