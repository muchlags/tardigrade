<br><br><br><br><br><br><br> 
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"> 
   <tbody><tr> 
      <td align="center" style="border:none;"> 
      <img style="height:150px; " src="<?php  echo $this->load_image('stop.jpg');?>" border="0">
      <h1 style="margin:0;padding:0;font-family: trebuchet ms;"> <b style="color:red"> RESTRICTED AREA! </b> <br>Authorized Personnel Only.
      <br><small style="color: #888;" align="center">Login to continue</small> 
      </h1> 
      </td> 
      </tr> 
    </tbody>
</table>
<center >
						
		<div id="login_form"  style='top:450px;'>
			
					<form method="post">
						<div id='login_errors' class='abs log_error'><center>Invalid account!</center></div>
						<div id="username_and_button" class="input_with_button">
							<img src="<?php echo $this->load_image("LogIn/LogInSprites1.png"); ?>" height="22px" width="22px" style="padding: 10px 0px 0px 10px;" border="0">
									
							<label for="username">Username</label>
							<input autocomplete="off" type="text" name="Username" id="Username" class="text_field" placeholder="Enter username" style="width: 232px;"><?php //280 sa una?>

						</div>
					
						<br>
					
						<div id="password_and_button" class="input_with_button">
							<img src="<?php echo $this->load_image("LogIn/LogInSprites2.png"); ?>" height="22px" width="22px" style="padding: 10px 0px 0px 10px;" border="0">
							<label for="password">Password</label>
							<input disabled autocomplete="off" type="password" name="Password" id="Password" class="text_field" placeholder="Enter password" style="width: 232px;">
							
						</div>
						<br>
					
						<h2 id="password_LogIn" class="LogIn hidden" style=""><input class="butts" type="button"  id="TheSubmit" value="Log-in"/><input class="butts" type="button" disabled  id="TheReset" value="Clear"/></h2>
					</form>
					<div id='pop_load'style='background: url("<?php echo addslashes($this->Load_Image("ajax-loader.gif")); ?>") no-repeat center 95px;opacity:0.7;position:absolute;top:-50px;left:-50px;height:250px;width:402px;border-radius:20px;z-index:100;'></div>
			
					<br/>



			
		</div>
</center>