<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");


?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
<script src="script.js"></script>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<?php require_once("header.php");?>
<body>
<div class="sign_container">
<h1 align="center">SIGN UP</h1>
<table align="center">
<form method="POST" action="signup_handler.php" id="myForm">
	
		
		 
		 <tr>
		
		<td align="center">Email<div id='email'></div>
		<input type="text" name="email" id="email1" onblur="validate('email', this.value)"/>
	    </td>
		
		</tr>
         <tr>
		  
	    <td align="center">Username<div id='username'></div>
		<input type="text" name="username" id="username1" onblur="validate('username', this.value)"/>
	    </td>
		
		</tr>
	
		
		<tr>
		
		<td align="center">Password<div id='password'></div>
		<input type="password" name="password" id="password1" onblur="validate('password', this.value)"/>
	    </td>
		 <td>
         
         </td>
		 

		
		 </tr>
		<!--<tr>
		<td>Confirm Password<br>
		<input type="password" name="cpassword" id="cpassword1" onblur="validate('cpassword', this.value)"/>
	    </td>
		 <td>
         &nbsp;&nbsp;<div id='cpassword'></div>
         </td>
		</tr>-->
		<tr>

		<td><input onclick="checkForm()" type='button' value='Register'></td>
		</form>
		</tr>
		<tr>
		 <td>   <a href="index.php">Login</a></td>
		</tr>
</table>

</div>
</body>
</html>