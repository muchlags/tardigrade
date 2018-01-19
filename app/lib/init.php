<?php 
session_start();

class globals{
    
    function __construct(){
        # code...
    }

    public function get_protocol(){
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            return 'https://';
        } else {
            return 'http://';
        }

    }

    public function get_RDN(){ //root directory name
        $serverDocRoot = $_SERVER['DOCUMENT_ROOT']; // C:/xampp/htdocs

        //outputs cws of index.php coz this init.php was included from there
        $base_url = str_replace('\\', '/', getcwd()); // C:/xampp/htdocs/tardigrade/capstone
        
        //note: only end of string has '/'
        return str_replace($serverDocRoot."/", "", $base_url); // tardigrade/capstone

    }


}//end of global class



$globals = new globals();


//client side
define("",);
define("",);
define("",);
define("",);
define("",);
define("",);

//server side
define('ROOTDIR', $globals->getRDN());
define("PROTOCOL", $globals->get_protocol());



/**
 *  Get Cake's root directory
 */
define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__)); //file directory not the current working directory
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);

echo ROOT." - root<br/>";


// $d = shell_exec('attrib ".confg"');

// $ins = explode('File not found',$d);
// if(isset($ins[1])){
//     header("location:install");
//     die();
// }//install function


// error_reporting(0); // i off if naay error

// function shutdown(){ //the shutdown function
//     $isError = false;

//     if ($error = error_get_last()){
//         switch($error['type']){
//             case E_ERROR:
//             case E_CORE_ERROR:
//             case E_COMPILE_ERROR:
//             case E_USER_ERROR:
//             $isError = true;
//             break;
//         }
//     }

//     if ($isError){
//         //header("location:".base_url."/sww"); //redirect page
//         die('Something Went Wrong!');//do whatever you need with it
//     }
// }

// register_shutdown_function('shutdown');

function myErrorHandler($errno, $errstr, $errfile, $errline){

    error_reporting(-1); // Report all PHP errors
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
            break;

        case E_USER_NOTICE:
            echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
            break;

    	case  E_CORE_ERROR:
            echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
            break;

        default:
            echo "Page not Found, Fatal error daw!";
            break;
    }

    error_reporting(-1); //if naay error, change to -1
    /* Don't execute PHP default internal error handler */
    return true;
}

// set_error_handler("myErrorHandler");
//register_shutdown_function('myErrorHandler');

//replace this with php file for security
//config reader
// $handle = file_get_contents(".confg");
// $file = json_decode($handle);
// define('DBHOST',pack('h*',$file->dbhost));
// define('DBUSER',pack('h*',$file->dbuser));
// define('DBPASS',pack('h*',$file->dbpass));
// define('ROOTDIR',$file->rootdir);

//replacement:
include_once('app/lib/db.php');



$uri .= $_SERVER['HTTP_HOST']; //localhost or domain name
define('BASEPATH', str_replace("\\", "/", $uri));

require_once('lib.php');
$page = new page();
