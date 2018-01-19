<?php 
session_start();
error_reporting(0);
if(isset($_POST['dbhost'])){
	set_time_limit(30);
	extract($_POST);
	$dbhost = mysql_real_escape_string($dbhost);
	$dbuser = mysql_real_escape_string($dbuser);
	$dbpass = mysql_real_escape_string($dbpass);
	try{
			$conn = mysql_connect($dbhost,$dbuser,$dbpass);
			if($conn){
				$_SESSION['dbcred'] = array(
					'dbhost' => $dbhost,
					'dbuser' => $dbuser,
					'dbpass' => $dbpass
					);
				echo json_encode(array('response'=>'success'));
			}else{
				echo json_encode(array('response'=>'failed'));
			}
			mysql_close();
		}
	catch(Exception $e){
		echo json_encode(array('response'=>'failed'));
	}
}else{
	header('location:./');
}
?>