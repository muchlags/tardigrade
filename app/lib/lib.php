<?php 
class page{

	// function __construct(){

	// 	$this->load_model('dbConn');
		
	// }

	//=========begin of ky0========================

	public function getAffectedRows($theQuery,$theArray,$dbName){
		if($dbName==""){
			$this->db = $this->connectdb();

		}else{
			$this->db = $this->reConnectdb($dbName);

		}

		$this->result = $this->db->prepare($theQuery);
		$this->result->execute($theArray); //Execute the prepared statement.
		return $this->result;
	}



	function IncID($theDB, $TableName, $ColName, $prefix){
		$cutStart = strlen($prefix);
		$theQuery = "SELECT ".$ColName."
					FROM  ".$TableName." 
					ORDER BY ".$ColName." desc 
					LIMIT 1";

		$theArray = array(""=>"");
		$result = $this->getAffectedRows($theQuery,$theArray,$theDB);


		if ($result->rowCount()>0){

			$lastID = $result->fetchAll();
			$lastID = $lastID[0][0];
			$newID = intval(substr($lastID, $cutStart, 4))+1;


			if($newID<10){
				$newID = $prefix."000" . $newID;						
			}elseif($newID<100){
				$newID =  $prefix."00" . $newID;
			}elseif($newID<1000){
				$newID =  $prefix ."0". $newID;
			}elseif($newID<10000){
				$newID =  $prefix ."". $newID;
			}
			
				
		}else{
			$newID = $prefix."0000";	
		}

		return $newID;



		
	}


	//=========end of ky0===========================



	
	private function sample($svars){
		
	}


	//fix
	function set_baseURL($base_url){
		// if ($base_url==''){define('SLASHER',-1);}else{define('SLASHER',0);}
		($base_url=='')?define('SLASHER',-1):define('SLASHER',0);
		define('base_url', BASEPATH.'/'.$base_url);
	}

	

	//bsta pag check ra na if index.php/control/func or dritso /control/func
	function check_uri(){
		echo $_SERVER['REQUEST_URI']." - REQUEST_URI<br/>";
		$url = explode(strtolower(base_url),strtolower(BASEPATH.$_SERVER['REQUEST_URI']));
		$d = explode('/',$url[1]);
		var_dump($url);
		
		$class = 0;
		$i = -2;
		$j=0;
		$k='1';
		#var_dump($d);
		
		if($d[1]=='index.php'){
			$class +=1;
		}
		$class = $class + SLASHER;
		#var_dump($class);
		#echo $class;
		#var_dump($class);
	 	if(isset($d[3+$class]) && strlen($d[3+$class])!=0){
	 		return array("set"=>'3','page'=>'PNF');
	 		
	 	}
		elseif(isset($d[3+$class])  && strlen($d[3+$class]) == 0 ){
			return array("set"=>'2','page'=>$d[$class+1],'func'=>$d[$class+2]);

		}
		elseif(isset($d[3+$class]) && isset($d[2+$class]) && strlen($d[2+$class]) != 0 ){
			return array("set"=>'2','page'=>$d[$class+1],'func'=>$d[$class+2]);
		}
		elseif(!isset($d[3+$class]) && isset($d[2+$class]) && strlen($d[2+$class]) != 0 ){
			return array("set"=>'2','page'=>$d[$class+1],'func'=>$d[$class+2]);
		}
		elseif(isset($d[2+$class]) && strlen($d[2+$class])==0 ) {
			return array("set"=>'1','page'=>$d[1+$class]);
		}
		elseif(!isset($d[2+$class]) && strlen($d[1+$class])!=0 ) {
			return array("set"=>'1','page'=>$d[1+$class]);
		}
		elseif(isset($d[1+$class]) && (strlen($d[1+$class])==0) || strlen($d[1+$class])=="index.php"){
			return array("set"=>'index','page'=>'main');
		}else{
			return array("set"=>'4','page'=>'PNF');
		}






	}
	function set_controller($main){

		$URI = $this->check_uri();
		#var_dump($URI);die();
		
			if($URI['set']=='4' ){
				require_once('./app/controllers/'.$URI['page'].'.php');
				$func = new $URI['page']();
			}elseif($URI['set']=='3' ){
				require_once('./app/controllers/'.$URI['page'].'.php');
				$func = new $URI['page']();
			}elseif($URI['set']=='2'){
				require_once('./app/controllers/'.$URI['page'].'.php');
				$_SESSION['location']=array('nav'=>$URI['page']);

				$func = new $URI['func']();
				#$e = error_get_last();
				#if(isset($_POST['type']) && $_POST['type']='ajax'){
				#$func->$URI['func']();}
				
			}elseif($URI['set']=='1' ){
				require_once('./app/controllers/'.$URI['page'].'.php');
				$_SESSION['location']=array('nav'=>$URI['page']);
				$func = new $URI['page']();
			}else{
				$_SESSION['location']=array('nav'=>$main);
				require_once('./app/controllers/'.$main.'.php');
				
				$func = new $main();
			}
		
		$e = error_get_last();
		


		//include("./app/controllers/".$main.".php");
	}
	function hosts(){
		return base_url;
	}
	
	function load_trigger(){
		//trigger
	}
	function load_css($a = array()){
		foreach($a as $gets){
		echo "<link rel='stylesheet' href='".base_url."/resources/css/".$gets.".css' />";
		}	
	}
	function load_script($a = array()){
		foreach($a as $gets){
		echo "<script type='text/javascript' src='".base_url."/resources/js/".$gets.".js'></script>";
		}
	}
	function open_head(){
		echo "<html><head>";
	}
	function close_head(){
		echo "</head><body>";
	}
	function end(){
		echo $this->load_view(array('presets/foot'));
	}
	function title($a){
		
		echo "<title>".$a."</title>";
	}
	
	function load_image($a){
		return stripslashes(base_url."/resources/img/".$a);
	}

	function load_view($a = array()){
		$b = array();
		$i=0;
		foreach($a as $rows){
			if($i==0){$b['views']=$rows;}
			if($i==1){$b['toExtract']=$rows;}
			$i++;
		}
		extract($b);
		if($i==2){
		extract($toExtract);
		}
		include("./app/views/".$views.".php");
	}
	function load_model($a){
		require_once("./app/models/".$a.".php");
		$open = new $a();
		return $open;
	}
	function connectdb(){
		$open = $this->load_model('dbconn');
		return $open->connect();
	}
	function connectmysqldb(){
		$open = $this->load_model('dbconn');
		return $open->connectmysql();
	}
	function reConnectdb($dbName){
		$open = $this->load_model('dbconn');
		return $open->reConnect($dbName);
	}
	function load_library($a){
		include("./app/lib/".$a.".php");
	}
	function nav_link($a){
		return base_url."/".$a;
	}
	function shownav($a){
		#return true;
		if(isset($_SESSION['account'])){
			$access = $_SESSION['account'];
			
			if(array_search($a,$access['allowed'])) {
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	function getEvents(){
		$this->load_model('preloader');
		$preloader = new preloader();
		$liveevents = array();
		$liveevents = $preloader->live_events();
		return $liveevents;
	}
	function showevents($a,$b){
		if(array_search(strtolower($a),$b)){
			return true;
		}else{
			return false;
		}
	}
	function authenticate($a){
		if(isset($_SESSION['account'])){
			$access = $_SESSION['account'];
			
			if(array_search(strtolower($a),$access['allowed'])) {
				return $access['prev'];
			}else{
				$this->open_head();
				echo '<link rel="icon" href="'.$this->hosts().'/Resources/img/favicon.ico" type="image/x-icon">';


				echo "<title>Restricted Page!!!</title>";
				echo '<script type="text/javascript">
				function call_base_url(){
					$urls = "'.$this->hosts().'";
					return $urls;
				}
				</script>';
				$this->load_css(array('stylesheet.1.0','LogIn/LogIn','HeadFootDefaults','main','nav'));
				$this->load_script(array('jquery.1.8.2.min','LogIn'));
				$this->close_head();
				$this->load_view(array("presets/restrict"));
				die();
				//header('location:'.base_url.'/restricted');
			}
			
		}else{
				$this->open_head();
				echo '<link rel="icon" href="'.$this->hosts().'/Resources/img/favicon.ico" type="image/x-icon">';


				echo "<title>Restricted Page!!!</title>";
				echo '<script type="text/javascript">
				function call_base_url(){
					$urls = "'.$this->hosts().'";
					return $urls;
				}
				</script>';
				$this->load_css(array('stylesheet.1.0','LogIn/LogIn','HeadFootDefaults','main','nav'));
				$this->load_script(array('jquery.1.8.2.min','LogIn'));
				$this->close_head();
				$this->load_view(array("presets/restrict"));
				
				die();
			//header('location:'.base_url.'/restricted');
		}
	}

}
