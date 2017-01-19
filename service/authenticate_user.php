<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");
require_once(APP_PATH."/data/dbconfig.php");
	
function login($email,$password)
{
$conn=get_db_connection();
$sql = "SELECT username,email,password FROM userdata";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
   
    while($row = mysqli_fetch_assoc($result)) {
        
		if(password_verify($password, $row['password']) && (strcmp($email,$row['email']))==0)
		{
		$_SESSION['user_session']=$row['username'];
		return true;
		}
    }
} 
else {
  return false;   
}

mysqli_close($conn);




}

?>