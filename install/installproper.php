<?php 
session_start();
error_reporting(0);
$handle = file_get_contents("log.dta");
$_sysCheck = 0;
if(strlen($handle)==0){
$_sysCheck = 1;
}else{
	if(!isset($_SESSION['install'])){
		header('location:../');
	}elseif($_SESSION['install']=='success'){
		die('System installed Successfully.');
	}elseif($_SESSION['install']=='failed'){
		die('System installation failed.');
	}
}



if($_sysCheck==1){
	if(isset($_POST['dbhost'])){
		extract($_POST);
		$dbType = 'mysql';
		$theUsers = $dbuser;
		$thePassword = $dbpass;
		$theHost = $dbhost;
		try{
		$database = new PDO($dbType.':host='.$theHost.';',$theUsers,$thePassword);
		}catch(Exception $e){
		// echo $e->getLine().'<br>';
		// echo $e->getFile().'<br>';
		// echo $e->getMessage().'<br>';
		echo 'Unreachable Database.<br>';
		echo 'No connection established.';
		die();
		}
		$req = $database->prepare("
			CREATE DATABASE IF NOT EXISTS tnhs_settings DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
			USE tnhs_settings;

			CREATE TABLE IF NOT EXISTS `mis_config` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `key` text NOT NULL,
			  `val` text NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

			INSERT INTO `mis_config` (`id`, `key`, `val`) VALUES
			(1, 'current_year', '".date('Y')."'); 

			CREATE TABLE IF NOT EXISTS `mis_homerooms` (
			  `HomeroomID` varchar(40) NOT NULL,
			  `SectionID` varchar(40) NOT NULL,
			  `YearLevelID` varchar(40) NOT NULL,
			  `StarSection` varchar(40) NOT NULL,
			  `AccountID` varchar(40) NOT NULL,
			  PRIMARY KEY (`HomeroomID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;


			CREATE TABLE IF NOT EXISTS `mis_sections` (
			  `SectionID` varchar(40) NOT NULL,
			  `SectionName` varchar(40) NOT NULL,
			  PRIMARY KEY (`SectionID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			CREATE TABLE IF NOT EXISTS `mis_yearlevels` (
			  `YearLevelID` varchar(40) NOT NULL,
			  `YearLevel` varchar(40) NOT NULL,
			  PRIMARY KEY (`YearLevelID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;




			CREATE DATABASE IF NOT EXISTS tnhs_archive".date('Y')." DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
			USE tnhs_archive".date('Y').";
			CREATE TABLE IF NOT EXISTS `election_categories_party` (
			  `PartyID` varchar(40) NOT NULL,
			  `PartyName` varchar(40) NOT NULL,
			  PRIMARY KEY (`PartyID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;


			CREATE TABLE IF NOT EXISTS `election_categories_position` (
			  `PositionID` varchar(40) NOT NULL,
			  `PositionName` varchar(40) NOT NULL,
			  `NomineeCount` int(40) NOT NULL,
			  `ElectableCount` int(40) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			CREATE TABLE IF NOT EXISTS `election_nominated_students` (
			  `AccountID` varchar(40) NOT NULL,
			  `PositionName` varchar(40) NOT NULL,
			  `PartyName` varchar(40) NOT NULL,
			  `VoteCount` int(11) NOT NULL,
			  PRIMARY KEY (`AccountID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			CREATE TABLE IF NOT EXISTS `enrollment_enrollees` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `ETC` text NOT NULL,
			  `_name` text NOT NULL,
			  `gender` text NOT NULL,
			  `type` text NOT NULL,
			  `_education` text NOT NULL,
			  `_info` text NOT NULL,
			  `_parents` text NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

			CREATE TABLE IF NOT EXISTS `mis_accounts` (
			  `AccountID` varchar(40) NOT NULL,
			  `AccountUsername` varchar(40) NOT NULL,
			  `AccountPassword` varchar(40) NOT NULL,
			  `Privilege` varchar(40) NOT NULL,
			  `Status` varchar(40) NOT NULL,
			  UNIQUE KEY `AccountUsername` (`AccountUsername`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			CREATE TABLE IF NOT EXISTS `mis_campus_variables` (
			  `id` int(50) NOT NULL AUTO_INCREMENT,
			  `data` text NOT NULL,
			  `value` text NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

			INSERT INTO `mis_campus_variables` (`id`, `data`, `value`) VALUES
			(1, 'yearBegin', '2013'),
			(2, 'yearEnd', '2014'),
			(3, 'sectionMax', '5');

			CREATE TABLE IF NOT EXISTS `mis_content_info` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` text NOT NULL,
			  `content` text NOT NULL,
			  `page` text NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


			INSERT INTO `mis_content_info` (`id`, `title`, `content`, `page`) VALUES
			(1, 'Welcome Page', 'this is the welcome screen text fetched from database. feel free to navigate anywhere.', 'home');

			CREATE TABLE IF NOT EXISTS `mis_grades` (
			  `ID` int(11) NOT NULL AUTO_INCREMENT,
			  `AccountID` varchar(40) NOT NULL,
			  `AverageGrade` varchar(40) NOT NULL,
			  `SchoolYearBegin` varchar(40) NOT NULL,
			  `SchoolYearEnd` varchar(40) NOT NULL,
			  `YearLevel` varchar(40) NOT NULL,
			  `SectionID` varchar(40) NOT NULL,
			  PRIMARY KEY (`ID`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

			CREATE TABLE IF NOT EXISTS `mis_school_info` (
			  `SchoolID` varchar(40) NOT NULL,
			  `SchoolName` text NOT NULL,
			  `Region` text NOT NULL,
			  `Division` text NOT NULL,
			  `History` text NOT NULL,
			  `YearFounded` text NOT NULL,
			  PRIMARY KEY (`SchoolID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

			CREATE TABLE IF NOT EXISTS `mis_privileges` (
			  `Privilege` varchar(40) NOT NULL,
			  `PrivilegeLevel` int(40) NOT NULL,
			  `PrivilegeDescription` varchar(40) NOT NULL,
			  `AllowedActions` varchar(80) NOT NULL,
			  `AccessLevels` text NOT NULL,
			  PRIMARY KEY (`Privilege`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

			
			CREATE TABLE IF NOT EXISTS `mis_student_profile` (
			  `accountID` varchar(40) NOT NULL,
			  `_name` text NOT NULL,
			  `gender` text NOT NULL,
			  `type` text NOT NULL,
			  `_education` text NOT NULL,
			  `_info` text NOT NULL,
			  `_parents` text NOT NULL,
			  `_siblings` text NOT NULL,
			  `_enrolled` text NOT NULL,
			  `year` text NOT NULL,
			  `AverageGrade` text NOT NULL,
			  `HomeroomID` text NOT NULL,
			  `Voted` text NOT NULL,
			  PRIMARY KEY (`accountID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

			CREATE TABLE IF NOT EXISTS `mis_sys_settings` (
			  `triggerName` varchar(50) NOT NULL,
			  `value` text NOT NULL,
			  PRIMARY KEY (`triggerName`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


			

			CREATE TABLE IF NOT EXISTS `mis_teacher_profile` (
			  `AccountID` varchar(40) NOT NULL,
			  `FirstName` varchar(40) NOT NULL,
			  `MiddleName` varchar(40) NOT NULL,
			  `LastName` varchar(40) NOT NULL,
			  `DoB` varchar(40) NOT NULL,
			  `Address` varchar(40) NOT NULL,
			  `YearRegistered` varchar(40) NOT NULL,
			  `Gender` varchar(40) NOT NULL,
			  `HomeroomID` varchar(40) NOT NULL,
			  PRIMARY KEY (`AccountID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

INSERT INTO `mis_privileges` (`Privilege`, `PrivilegeLevel`, `PrivilegeDescription`, `AllowedActions`, `AccessLevels`) VALUES
('Admin', 6, 'School ICT Coordinators or Principal', 'read and write pages that requires level 6 privilege', '{\"0\":\"home\",\"1\":\"events\",\"2\":\"profiles\",\"3\":\"reports\",\"4\":\"settings\"}'),
('Facilitator', 2, 'Com Lab Peer Facilitators', 'read and write pages that requires level 2 privilege', '{\"0\":\"home\",\"1\":\"events\",\"2\":\"profiles\",\"3\":\"reports\",\"4\":\"settings\"}'),
('SuperUser', 3, 'Registered Teachers/Faculty', 'read and write pages that requires level 3 privilege', '{\"0\":\"home\",\"1\":\"events\",\"2\":\"profiles\",\"3\":\"reports\"}'),
('Tech', 7, 'WebMasters', 'Full Control', '{\"0\":\"home\",\"1\":\"events\",\"2\":\"profiles\",\"3\":\"reports\",\"4\":\"settings\"}'),
('User', 1, 'Enrolled Students', 'read and write level 1 pages', '{\"0\":\"home\",\"1\":\"events\"}');
INSERT INTO `mis_sys_settings` (`triggerName`, `value`) VALUES
('accounts_active', '{\"0\":\"1\",\"1\":\"Admin\",\"2\":\"Facilitator\",\"3\":\"SuperUser\",\"4\":\"Tech\",\"5\":\"User\"}'),
('liveEvents', '[\"\",\"home\"]');
INSERT INTO `mis_campus_variables` (`id`, `data`, `value`) VALUES
(1, 'yearBegin', '2013'),
(2, 'yearEnd', '2014'),
(3, 'sectionMax', '5');
INSERT INTO `mis_content_info` (`id`, `title`, `content`, `page`) VALUES
(1, 'Welcome Page', 'this is the welcome screen text fetched from database. feel free to navigate anywhere.', 'home');

");
		
		$req->execute();

			$query = 'USE tnhs_archive'.date('Y').';insert into mis_accounts values( ? , ? , ? , ? , ? )';
			$req = $database->prepare($query);
			$rew =$req->execute(array(
				$acpuser,
				$acpuser,
				$acppass,
				'Admin',
				'Default'
				));
			$query = 'USE tnhs_archive'.date('Y').';insert into mis_teacher_profile values( ? , ? , ? , ? , ? , ? , ? , ? , ? )';
			$req = $database->prepare($query);
			$rew =$req->execute(array(
				$acpuser,
				'Default',
				'',
				'',
				'',
				'',
				date('Y'),
				'',
				''
				));

		$REQUESTS = explode("install",$_SERVER['REQUEST_URI']);
		$BSPATH = $REQUESTS[0];
		$REQUESTS = explode("/install",$_SERVER['REQUEST_URI']);
		$ROOTPATH = explode($_SERVER['SERVER_NAME'].'/',$_SERVER['SERVER_NAME'].$REQUESTS[0]);

		$enchost =  unpack('h*',$dbhost);//pack('h*',$v[1]);
		$encuser =  unpack('h*',$dbuser);//pack('h*',$v[1]);
		$encpass =  unpack('h*',$dbpass);//pack('h*',$v[1]);
		$configuration = json_encode(array('dbhost'=>$enchost[1],'dbuser'=>$encuser[1],'dbpass'=>$encpass[1],'rootdir'=>$ROOTPATH[1]));
		$_SESSION['install'] = 'success';
		shell_exec('echo ErrorDocument  404 "'.$BSPATH.'index.php?err=\'1\'">../".htaccess"');
		shell_exec('echo '.$configuration.'>../".confg"');

		echo json_encode(array('response'=>'success'));
		$fp = fopen('log.dta', 'w');
		fwrite($fp, 'Installed '.date('y-m-d h:m:s A'));
		fclose($fp);

	}
}?>