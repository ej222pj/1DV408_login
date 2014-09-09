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
		$username = $this->view->getUsername();
		$password = $this->view->getPassword();
		
		
		if($username){
			return $control = $this->view->inputHtml("g");
		}
		
		//if(isset($_POST['submit'])){
		//	$this->view->input();

		//	$this->model->checkLogin($username, $password);
		//}
		return $control = $this->view->inputHtml("");
	}
}
