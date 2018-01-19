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
		die('System installed Successfully.');
	}elseif($_SESSION['install']=='failed'){
		die('System installation failed.');
	}
}



if($_sysCheck==1){
?>
<html>
	<head>
		<title>System Installation - Admin Control Panel</title>
		<script type='text/javascript' src='jquery-1.8.3.min.js'></script>
		<script>
			$(document).ready(function(){
				$('.acppassess').live('keyup',function(){
					
					
					if($('#acppass').val()!=$('#acprepass').val()){
						$('#acprepass').closest('td').find('span').html('<b style="color:red;"> * Password Mismatched</b>');
					}else{
						$('#acprepass').closest('td').find('span').html('<b style="color:green;"> Password Matched</b>');
					}
					if($('#acppass').val()=='' && $('#acprepass').val()==''){
						$('#nextbut').val('Next');
						$('#acprepass').closest('td').find('span').html('');
					}else{
						$('#nextbut').val('Change Password');
					}
					$('#nextbut').closest('td').find('span').html('');
				});
				$('#nextbut').live('click',function(){
					if($('#nextbut').val()=='Change Password'){
					
						if($('#acppass').val()==$('#acprepass').val()){
							$('#nextbut').closest('td').find('span').html('<b style="color:green;">Password Changed</b>');
							$('#dtacppass').val($('#acppass').val());
							$('#acppass').val('');
							$('#acprepass').val('')
							$('#nextbut').val('Next');
							$('#viewPass').closest('td').html('<em id="viewPass">--encrypted--</em>')
							$('#acprepass').closest('td').find('span').html('');
						}else{
							$('#nextbut').closest('td').find('span').html('<b style="color:red;">Password Mismatched</b>');
						}
						
					}else if($('#nextbut').val()=='Next'){
						$startinstall = confirm('Install system to server \''+$('#dbhost').val()+'\'');
						if($startinstall){
							$dbh = $('#dbhost').val();
							$dbu = $('#dbuser').val();
							$dbp = $('#dbpass').val();
							$acu = $('#dtacpuser').val();
							$acp = $('#dtacppass').val();
							$('#nextbut').blur();
							$('#nextbut').closest('td').append('<b style="color:orange;">Creating database, Please wait. This may take few minutes. . .</b>');
							$.post('installproper.php',{'dbhost':$dbh,'dbuser':$dbu,'dbpass':$dbp,'acpuser':$acu,'acppass':$acp},function(d){
								if(d.response=='success'){
									window.location = "./";
								}else{
									alert('failed');
								}
							},'json');
						}
					}
				});
			});
		</script>
	</head>
	<body>
		<input type='hidden' id='dbhost' value="<?php echo $_SESSION['dbcred']['dbhost'];?>">
		<input type='hidden' id='dbuser' value="<?php echo $_SESSION['dbcred']['dbuser'];?>">
		<input type='hidden' id='dbpass' value="<?php echo $_SESSION['dbcred']['dbpass'];?>">
		<input type='hidden' id='dtacpuser' value="administrator">
		<input type='hidden' id='dtacppass' value="administrator">
		
		<table>
			<thead>
				<tr>
					<th colspan='2'>
						System Installation - Admin Control Panel
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Default Username :
					</td>
					<td>
						<b>administrator</b>
					</td>
				</tr>
				<tr>
					<td>
						Default Password :
					</td>
					<td>
						<b id='viewPass'>administrator</b>
					</td>
				</tr>
				<tr>
					<td>
						Create new password :
					</td>
					<td>
						<input type='password' value='' id='acppass' class='acppassess'> (optional)
					</td>
				</tr>
				<tr>
					<td>
						Retype password :
					</td>
					<td>
						<input type='password' value='' id='acprepass' class='acppassess'><span></span>
					</td>
				</tr>
				<tr>
					<td align='right' colspan='2'>
						<span></span>
						<input type='button' value='Next' id='nextbut'>
					</td>
				</tr>
				
			</tbody>
		</table>
	</body>
</html>
<?php }?>