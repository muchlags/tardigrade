<?php

// This might be useful:
// 	include $_SERVER['DOCUMENT_ROOT']."/lib/sample.lib.php";
// So you can move script anywhere in web-project tree without changes.

function getDocRoot(){
	//returns values like "C:/xampp/htdocs"
	return $_SERVER['DOCUMENT_ROOT'];
}

function getRoot(){
	return getcwd();
}

function getProtocol(){
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	    return'https://';
	} else {
	    return 'http://';
	}
}

define('ROOTDIR',getRoot());

echo "<br/>A ".dirname(__DIR__);
echo "<br/>B ".dirname(__FILE__);
echo "<br/>C ".ROOTDIR;

$actual_link = getProtocol().$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

echo "<br/>D ".$actual_link;
echo "<br/>E ".basename(__FILE__);
echo "<br/>F ".basename(__DIR__);

$uri = getProtocol().$_SERVER['HTTP_HOST'];

define('URI', $uri);
define('BASEPATH', str_replace("\\", "/", URI));

echo "<br/>G ".$_SERVER['DOCUMENT_ROOT'];
echo "<br/>H ".BASEPATH;

//start

