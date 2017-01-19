<?php
session_start();
	
function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	  
	  
	  
	  function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		redirect('../view/index.php');
		return true;
	}
	function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}
?>