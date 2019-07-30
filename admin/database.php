



<?php

/*
class database {

	public $host = db_host;
	public $user = db_user;
	public $pass = db_pass;
	public $name = db_name;

	public $link;
	public $error;


	private function db_connect(){

		$this->$link = new mysqli($this->$host, $this->$user, $this->$pass, $this->$name);
		if(!$this->$link){
			$this->$error = "Connection Failed! " . $this->$link->connect_error;	
		}
	}
}
*/


$db = new mysqli(db_host, db_user, db_pass, db_name);
