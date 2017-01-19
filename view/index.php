<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Login Form</title>
</head>
<?php require_once("header.php");?>
<body>
<div class="login">
	    <table align="center">
		<form action="login_handler.php" method="post">
			<tr>
			<td colspan="2"><h1>Login Form</h1></td>
			</tr>
			<tr>
			<td><input type="text" placeholder="Email" required="" id="email"  name="email"/></td>
			</tr>
			<tr>
			<td><input type="password" placeholder="Password" required="" id="password"  name="password"/></td>
			</tr>
		        
			<tr>
			 <td>  <input type="submit" value="Log in" id="login"  /><br>
				<a href="signup.php">Need an account? Register here</a></td>
			</tr>
		</form><!-- form -->
		<div class="button">
			
		</div><!-- button -->
	
	</table>
</div>

</html>