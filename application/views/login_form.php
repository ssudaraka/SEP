<h3>Login Form</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('user_auth'); ?>
<label for="username">Username:</label>
<input type="text" size="20" id="username" name="username"/>
<br/>
<label for="password">Password:</label>
<input type="password" size="20" id="passowrd" name="password"/>
<br/>
<input type="submit" value="Login"/>
<?php echo form_close(); ?>