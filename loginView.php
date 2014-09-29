<?php

require_once("/cookieStorage.php");

class loginView{
	private $model;
	private $status;
	private $rememberUn = "loginView::Username";
	private $rememberPw = "loginView::Password";
	private $unFromForm = "loginView::Form::Username";
		
	public function __construct(loginModel $model){
		$this->model = $model;
		$this->status = new cookieStorage();
	}
	
	public function loginPrint(){
		if($this->clickLogin()){
			setcookie($this->unFromForm, $_POST["username"], 0);
		}
		else{
			setcookie($this->unFromForm, "",time() -3600);
		}
		$username = $this->getunFromForm();
		//Klockan
		setlocale(LC_ALL, 'swedish');
		$clock = '<p>' . ucfirst(utf8_encode(strftime('%A'))) 
					. ', den ' . date('j ') . 
					ucfirst(strftime('%B')) . ' år ' . date('Y') . 
					'. Klockan är ['.date('H:i:s').']</p>';
					
		$ret = "
				<h2>Ej Inloggad</h2>
				<Form action='.' method='post' enctype='multipart/Form-data'>
					<fieldset>
						<legend>Login - Skriv in användarnamn och lösenord</legend>
							<label>Användarnamn:</label>
							<input type='text' name='username' value='$username'/>
							<label>Lösenord:</label>
							<input type='password' name='password' value=''/>
							<label>Håll mig inloggad:</label>
							<input type='checkbox' id='remember' name='remember'/>
							<input type='submit' name='loggaIn' value='Logga in'/>
					</fieldset>
				</Form>
				";
		if($this->clickLogin()){
			header('Location: ' . $_SERVER['PHP_SELF']);
		}
		elseif($this->cookieLogin() == true){
			$this->status->save("Inloggning genom kakor!");
			header('Location: ' . $_SERVER['PHP_SELF']);
   		}
	    elseif($this->checkCookie() && $this->cookieLogin() == false){
		        $this->status->save("Felaktig information i kakan!");
		        header('Location: ' . $_SERVER['PHP_SELF']);
	    }
	    else{
	        $ret .= $this->status->load();
	    }
				
		return $ret . $clock;
	}
	
	public function logoutPrint(){
		$user = $this->model->getUsername();
		//Klockan
		$clock = '<p>' . ucfirst(utf8_encode(strftime('%A'))) 
			. ', den ' . date('j ') . 
			ucfirst(strftime('%B')) . ' år ' . date('Y') . 
			'. Klockan är ['.date('H:i:s').']</p>';
		
		$ret = "
			<h2>$user är inloggad</h2>
			<p><a href='?loggaUt'>Logga ut</a></p>
		";
		if($this->clickLogout()){
			$this->status->save("Du har loggat ut!");
			header('Location: ' . $_SERVER['PHP_SELF']);
		}
		else{
			$ret .= $this->status->load();
		}
		setcookie($this->unFromForm, "" , time() -3600);
		return $ret . $clock;
	}
	
  	//Logga in med kakor
	public function cookieLogin() {//Kolla om kakan finns och inte har gått ut
	    if($this->checkCookie() && $this->expiredCookie() == false){
			$cookie = $this->getCookie();
	      //Loggar om allt username och password stämmer
	      if($cookie['user']->username === $this->model->getUsername() 
	      	&& 
	      	$this->model->loginModel(
		      	$this->getClientInfo(), 
		      	$this->model->getPassword(), 
				$cookie['pass']->password)
			){
	        return true;
	      }
	    }
		$this->killCookie();
	    return false;
	  }

	public function clickLogin(){
		return isset($_POST["loggaIn"]);
	}
	public function remeberChecked(){
		return isset($_POST["remember"]);
	}
	public function clickLogout(){
		return isset($_GET["loggaUt"]);
	}
	public function getunFromForm(){
		if(isset($_COOKIE[$this->unFromForm])){
			return $_COOKIE[$this->unFromForm];
		}
		else{
			return "";
		}
	}
	//Kollar om man klarar inloggning
	public function checkInput(){
			$un = $_POST['username'];
			$pw = $_POST['password'];
			//Klarade
			if($this->model->getUsername() === $un && $this->model->getPassword() === $pw && $this->remeberChecked() == false){
				$this->status->save("Inloggning lyckades!");
				return true;
			}//Klarade med komihåg
    		elseif($this->model->getUsername() === $un && $this->model->getPassword() === $pw && $this->remeberChecked()) {
			    $this->status->save("Inloggning lyckades och vi kommer ihåg dig nästa gång!");
			    return true;
    		}//Saknar username
    		elseif(empty($un) && empty($pw) || $pw && empty($un)) {
      			$this->status->save("Användarnamn saknas!");
    		}//Saknar Pass
    		elseif($un && empty($pw)) {
      			$this->status->save("Lösenord saknas!");
    		}//Fel lösen eller pass
    		elseif($un === $this->model->getUsername() && $pw !== $this->model->getPassword()
      			|| $un !== $this->model->getUsername() && $pw !== $this->model->getPassword()
      			|| $pw === $this->model->getPassword() && $un !== $this->model->getUsername()){
      			$this->status->save("Felaktigt användarnamn och/eller lösenord");
    		}
		return false;
	}
	
	public function getClientInfo(){
		return $_SERVER["HTTP_USER_AGENT"];
	}

	//Sätter kakor
	public function setCookie(){
		//Ger variablar ett värde för att sen sätta kakorna.
		$username = array('username' => $this->model->getUsername(), 'time' => time() +100);
		$password = array('password' => $this->model->getCryptedPass(), 'time' => time() +100);

		//Sätter kakorna och krypterar
	    setcookie($this->rememberUn, json_encode($username), time() +100);
	    setcookie($this->rememberPw, base64_encode(json_encode($password)), time() +100);	
	}
	//Tar bort kakorna
	public function killCookie() {
		setcookie($this->rememberUn, "", time() -3600);
		setcookie($this->rememberPw, "", time() -3600);
	}
	//Hämtar kakaorna. Inte helt 100% på vad jag göra här fullt ut.
	public function getCookie() {
		//Ta bort Json och base64 cryptet
		$username = json_decode($_COOKIE[$this->rememberUn]);
	    $password = json_decode(base64_decode($_COOKIE[$this->rememberPw]));

	    if(isset($username) && isset($password)){
	    	//Ger en array 2 värden med user och lösen
	      	return array('user' => $username, 'pass' => $password);
	    }
	    else{
	      	return false;
	    }
  }
	//Kollar om tiden på kakorna gått ut. true betyder att dom har gått ut.
  	public function expiredCookie(){
	    $cookie = $this->getCookie();
		
	    if ($cookie['user']->time < time() && $cookie['pass']->time < time()) {
	      return true;
	    }
	    else{
	      return false;
	    }
  	}
	public function checkCookie(){
		if(isset($_COOKIE[$this->rememberUn]) && isset($_COOKIE[$this->rememberPw])){
			return true;
		}
		else{
			return false;
		}
	}
}

	



