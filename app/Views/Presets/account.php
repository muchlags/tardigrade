<div id='user_panel' class='user_panel abs '>
<div id='edit_profile' class='user_name user_head'><?php echo $access['name'];?></div>
<div class='divider'></div>
<div class="user_opts_sel user_head">[[--]]</div>
<div class="opts_holder">
	<table>
		<?php if(strtolower($access['access'])=='admin'){echo '<tr><td id="manage" class="user_opts">Manage</td></tr>';}?>
		<tr><td id='user_logout'class='user_opts'><span id='href' class='hide'><?php echo $this->hosts();?></span>Logout</td></tr>
	</table>
</div>
</div>