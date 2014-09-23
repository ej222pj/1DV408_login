<?php

class HTMLView{
	
	public function echoHTML($body){
		
		if($body === NULL){
			throw new \Exception("HTMLView::echoHTML does not allow body to be null");		
		}
	
		echo "
			<!DOCTYPE HTML>
			<html>
				<head>
					<meta charset='UTF-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<title>Lab2 1DV408_Login EJ222PJ</title>
				</head>
				<body>
					<h1>Lab2 1DV408_Login EJ222PJ</h1>
					$body
				</body>
				</html>";	
	}
}
