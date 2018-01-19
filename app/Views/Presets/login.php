<div class='pop_box' style='border:1px solid gray;height:0;width:0;z-index:1999;position:absolute;'></div>

<div class='pop_up'>

	<div id='toggle'style="height: 100%; width: 100%;opacity:0.1;"></div>
	<div id="login_form">
		
		<!-- <div id='login_div_border' class='login_holder'style='background-color:rgba(245,245,245,1);background-color:#626262;background-color:#0088cc;position:absolute;top:-40px;left:-43px;height:220px;width:382px;border-radius:23px;'></div> -->
		<div id='login_div_container' class='login_holder'></div>


		<form id="LIForm" method="post">
			<div id='login_errors' class='abs log_error'>
				<center>Invalid account!</center>
			</div>

			<div id="username_and_button" class="input_with_button">
				<img src="<?php echo $this->load_image("LogIn/LogInSprites1.png"); ?>" height="22px" width="22px" style="padding: 10px 0px 0px 10px;" border="0">	
				<label for="Username">Username</label>
				<input autocomplete="off" type="text" name="Username" id="Username" class="text_field" placeholder="Enter Username" style="width: 232px;">

			</div>
		
			<br/>
		
			<div id="password_and_button" class="input_with_button">
				<img src="<?php echo $this->load_image("LogIn/LogInSprites2.png"); ?>" height="22px" width="22px" style="padding: 10px 0px 0px 10px;" border="0">
				<label for="password">Password</label>
				<input disabled autocomplete="off" type="password" name="Password" id="Password" class="text_field" placeholder="Enter Password" style="width: 232px;">
				
			</div>
			<br/>
		
			<h2 id="password_LogIn" class="LogIn hidden" style=""><input class="butts" type="button"  id="TheSubmit" value="Log-in"/><input class="butts" type="button" disabled  id="TheReset" value="Clear"/></h2>

		</form>
			
		<div id='pop_load'style='background: url("<?php echo addslashes($this->Load_Image("ajax-loader.gif")); ?>") no-repeat center 95px;opacity:0.7;position:absolute;top:-50px;left:-50px;height:250px;width:402px;border-radius:20px;z-index:100;'></div>

		<br/>
		
	</div>
</div>