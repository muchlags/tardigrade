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



class poiDb{

	private $dbType = "";
	private $dbHost = "";
	private $dbName = "";
	private $dbUser = "";
	private $dbPass = "";
	private $theSQL = "";
	private $parameters = ""; //array

	function __construct(){
		$fileContents = file_get_contents("./.config");
		$config = json_decode($fileContents);
		
		$this->dbType = $config->dbType;
		$this->dbHost = $config->dbHost;
		$this->dbName = $config->dbName;
		$this->dbUser = $config->dbUser;
		$this->dbPass = $config->dbPass;
	}

	function connect(){

		try{

			$connStr = "$this->dbType:host=$this->dbHost;dbname=$this->dbName";
			$conn = new PDO($connStr, $this->dbUser, $this->dbPass);
		
		}catch(Exception $e){

			echo $e->getLine().'<br>';
			echo $e->getFile().'<br>';
			echo $e->getMessage().'<br>';
			echo 'Unreachable Database.<br>';
			echo 'No connection established.';
			die();

		}

		return $conn;
	}

	function execSQL($theSQL = NULL, $parameterVals = NULL){
		if(is_null($theSQL)){
			$theSQL = $this->theSQL;
		}
		if(is_null($parameterVals)){
			$parameterVals = $this->parameters;
		}
		$conn = $this->connect();
		$command = $conn->prepare($theSQL);
		$parameterVals = str_replace(", ", ",", $parameterVals); //here
		$parameters = explode(",", $parameterVals);
	
		if($command->execute($parameters)){
			//$resultSet = $command->fetchAll();
			//return $resultSet;
			return $command;

		}else{			
			echo 'Invalid query.<br>';
			echo 'Check your SQL.<br>';
			//var_dump($parameters);
			echo '<code>'.$theSQL.'</code>';
			die();

		}
	}


	function getRS($theSQL = NULL, $parameterVals = NULL){
		$command = $this->execSQL($theSQL, $parameterVals);
		return $command->fetchAll();
	}

	function getSQL(){
		return $this->theSQL;
	}

	function sel($cols = "*"){
		$this->theSQL = "";
		$this->theSQL .= "SELECT ".$cols;
		return $this;
	}

	function del($cols = NULL){
		$this->theSQL = "";
		$this->theSQL .= "DELETE ".$cols;
		return $this;
	}

	function ins($cols = NULL){
		$this->theSQL = "";
		$this->theSQL .= "INSERT";
		$this->cols = "";
		$this->cols = (is_null($cols))?"":" (".$cols.")";
		return $this;
	}

	function upd($tblNym){
		$this->theSQL = "";
		$this->theSQL .= "UPDATE ".$tblNym;
		return $this;
	}

	function from($tblNym){
		$this->theSQL .= " FROM ".$tblNym;
		return $this;
	}

	function into($tblNym){
		$this->theSQL .= " INTO ".$tblNym.$this->cols;
		return $this;
	}

	function set($newData){
		$this->theSQL .= " SET ".$newData;
		return $this;
	}

	function where($condition){
		$this->theSQL .= " WHERE ".$condition;
		return $this;
	}

	function vals($values){
		$this->theSQL .= " VALUES (".$values.")";
		return $this;
	}

	function _and($condition){
		$this->theSQL .= " AND ".$condition;
		return $this;
	}

	function _or($condition){
		$this->theSQL .= " OR ".$condition;
		return $this;
	}

	function orderBy($column, $order){
		$this->theSQL .= " ORDER BY ".$column." ".$order;
		return $this;
	}

	function groupBy($group){
		$this->theSQL .= " GROUP BY ".$group;
		return $this;
	}
	
	//BOUND PARAMETERS

	function parameters($parameterVals){
		$this->theSQL .= " DISTINCT";
		return $this;
	}

	//JOINS
	function innerJ(){
		$this->theSQL .= " INNER JOIN";
		return $this;
	}
	function outerJ(){
		$this->theSQL .= " OUTER JOIN";
		return $this;
	}
	function fullJ(){
		$this->theSQL .= " FULL JOIN";
		return $this;
	}

	// function distinct(){
	// 	$this->theSQL .= " DISTINCT";
	// 	return $this;
	// }


	function makeForm1($fields, $formName){
		$poiForm = "<div align='center'><form id='".$formName."'>";
		
		foreach ($fields as $field) {
			$poiForm .=	"<input type='text' style='padding: 7px; margin: 7px;' placeholder='".$field."' id='".$field."' class='poiTxtBx'/><br/>";
		}
		
		$poiForm .= "<input type='submit' style='padding: 7px; margin: 7px;'><input type='reset' style='padding: 7px;'></form></div>";

		echo $poiForm;
	}

	function makeTable($dataSet){
		//get column count
		//get row count
		//loop

	}

}//end of poiDb
