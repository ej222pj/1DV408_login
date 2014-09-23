<?php
    class cookieStorage{
    	private $cookie = "cookieStorage";
		
		public function save($status){
			setcookie($this->cookie, $status, 0);
		}
		
		public function load(){
			if(isset($_COOKIE[$this->cookie])){
				$ret = $_COOKIE[$this->cookie];
			}
			else{
				$ret = "";
			}
			setcookie($this->cookie, "", time() -3600);
			return $ret;
		}
    }