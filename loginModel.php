<?php

require_once("/loginModel.php");
require_once("/loginview.php");

class loginModel{
	
	public function __construct(){

		}
	public function loginModel(){
		
		
		return $this->view->inputHtml();
	}
}
