<?php
class loginView{
	private $username;
	private $password;
	
	public function __construct(){
		
		
		
	}
	
	public function inputHtml(){
		setlocale(LC_ALL, 'swedish');
		$clock = '<p>' . ucfirst(utf8_encode(strftime('%A'))) 
					. ', den ' . date('j ') . 
					ucfirst(strftime('%B')) . ' år ' . date('Y') . 
					'. Klockan är ['.date('H:i:s').']</p>';
		$ret = "
			<!DOCTYPE HTML>
			<html>
				<head>
					<meta charset='UTF-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<title>Lab2 1DV408_Login EJ222PJ</title>
				</head>
				<body>
					<h1>Lab2 1DV408_Login EJ222PJ</h1>
					<h2>Ej Inloggad</h2>
					<form action='?login' method='post' enctype='multipart/form-data'>
						<fieldset>
							<legend>Login - Skriv in användarnamn och lösenord</legend>
							<lable for='username'>Användarnamn:</lable>
							<input type='text' name='username' value=''/>
							<lable for='password'>Lösenord:</lable>
							<input type='password' name='password' id='password'/>
							<lable for='cookie'>Håll mig inloggad:</lable>
							<input type='checkbox' id='cookie' name='cookie' value='yes'/>
							<input type='submit' value='Logga in'/>
						</fieldset>
					</form>
				</body>
			</html>	";
			
		return $ret . $clock;
	}
	public function input(){
		if(isset($_POST['username'])){
			$this->username = $_POST['username'];
		}
		if(isset($_POST['password'])){
			$this->password = $_POST['password'];
		}
	}
	public function getUsername(){
		return $this->username;
	}
	public function getPassword(){
		return $this->password;
	}
}





