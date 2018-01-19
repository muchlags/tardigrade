<?php 
session_start();
$handle = file_get_contents("log.dta");
$_sysCheck = 0;
if(strlen($handle)==0){
$_sysCheck = 1;
}else{
	if(!isset($_SESSION['install'])){
		header('location:../');
	}elseif($_SESSION['install']=='success'){
		unset($_SESSION['install']);
		die($handle.'  --  System database installed Successfully.');
	}elseif($_SESSION['install']=='failed'){
		unset($_SESSION['install']);
		die('System installation failed.');
	}
}



if($_sysCheck==1){
?>
<html>
	<head>
		<title>System Installation</title>
		<script type='text/javascript' src='jquery-1.8.3.min.js'></script>
		<script>
		$(document).ready(function(){
			$('#checkValidity').live('click',function(){
				if($(this).val()=='Check'){
					var requirements = 0;
					if($('#dbhost').val()==""){
						$('#dbhost').closest('td').find('span').html('<b style=\'color:red;\'> * Required</b>');
						requirements += 1;
					}else{
						$('#dbhost').closest('td').find('span').html('');
					}
					if($('#dbuser').val()==""){
						$('#dbuser').closest('td').find('span').html('<b style=\'color:red;\'> * Required</b>');
						requirements += 1;
					}else{
						$('#dbuser').closest('td').find('span').html('');
					}

					if(requirements==0){
						$dbh = $('#dbhost').val();
						$dbu = $('#dbuser').val();
						$dbp = $('#dbpass').val();
						$.post('checkdb.php',{'dbhost':$dbh,'dbuser':$dbu,'dbpass':$dbp},function(d){
							if(d.response=='success'){
								$('#checkValidity').closest('td').find('span').html('<b style=\'color:green;\'>Connection available.</b>');
								$('#checkValidity').val('Next');
							}else{
								$('#checkValidity').closest('td').find('span').html('<b style=\'color:red;\'>Connection failed.</b>');
								
							}

						},'json');
						
					}
				}else if($(this).val()=='Next'){
					window.location = 'acp.php';
				}
			});
			$('.inputer').live('keyup',function(){
				if($('#checkValidity').val()=='Check'){
					$('#checkValidity').closest('td').find('span').html('');

				}else{
					$('#checkValidity').closest('td').find('span').html('');
					$('#checkValidity').val('Check');
				}
			});

		});
		</script>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<th colspan='2'>
						Database Configuration
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Host
					</td>
					<td>
						<input type='text' value='' id='dbhost' name='dbhost' class='inputer'><span></span>
					</td>
				</tr>
				<tr>
					<td>
						Username
					</td>
					<td>
						<input type='text' value='' id='dbuser' name='dbuser' class='inputer'><span></span>
					</td>
				</tr>
				<tr>
					<td>
						Password
					</td>
					<td>
						<input type='text' value='' id='dbpass' name='dbpass' class='inputer'>
					</td>
				</tr>
				<tr>
					<td colspan='2' align='right'>
						<span></span>
						<input type='button' id='checkValidity' value='Check' name='checkValidity'> <!-- value = [Check , Create Connection] -->
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
<?php }?>