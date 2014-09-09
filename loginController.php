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
		
		
		return $this->view->inputHtml();
	}
}
