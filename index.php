<?php
include('app/lib/init.php');

// folder where this index.php file is located (i.e. http:\\thesite.com\foldername so ROOTDIR == "foldername")
$page->set_baseURL(ROOTDIR); 
$page->set_controller('sample');
echo phpversion();
// echo $_SERVER['DOCUMENT_ROOT'].ROOTDIR;

//init.php must have most of all defined variables
//also error trapping and calling lib files

//baseURL dynamic

//definitions and conventions
//	basepath
//	root
//	rootdir
// getters and setters of framework must have underscores "_"

