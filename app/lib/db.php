<?php

class db{

// This might be useful:
// 	include $_SERVER['DOCUMENT_ROOT']."/lib/sample.lib.php";
// So you can move script anywhere in web-project tree without changes.

	// private $type = "mysql";
	// private $host = "localhost";
	// private $name = "employees";
	// private $user = "root";
	// private $pass = "";

	private $type;
	private $host;
	private $name;
	private $user;
	private $pass;

	protected $test;

	function __construct(){
		include "config.php";
		//include $_SERVER['DOCUMENT_ROOT']."/lib/sample.lib.php";

	}

	public function __get($propName){
		return $this->$propName;
	}

	// public function getHost(){
	// 	return $this->host;
	// }

	// public function getUser(){
	// 	return $this->user;
	// }

	// public function getPass(){
	// 	return $this->pass;
	// }


}//end of db class
