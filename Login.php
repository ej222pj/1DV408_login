<?php
class Login{
	
	public function __construct(){
		
		
		
	}
	
	public function inputHtml(){
		
		?>
			<!DOCTYPE HTML>
			<html>
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>Lab2 1DV408_Login EJ222PJ</title>
				</head>
				<body>
					<h1>Lab2 1DV408_Login EJ222PJ</h1>
					<h2>Ej Inloggad</h2>
					<form action="?login" method="post" enctype="multipart/form-data">
						<fieldset>
							<legend>Login - Skriv in användarnamn och lösenord</legend>
							<lable for="username">Användarnamn:</lable>
							<input type="text" name="username" value=""/>
							<lable for="password">Lösenord:</lable>
							<input type="password" name="password" id="password"/>
							<lable for="cookie">Håll mig inloggad:</lable>
							<input type="checkbox" id="cookie" name="cookie" value="yes"/>
							<input type="submit" value="Logga in"/>
						</fieldset>
					</form>
				</body>
			</html>	
		<?php	
	}
	
	
}
