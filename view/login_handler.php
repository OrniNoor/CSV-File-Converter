<?php
require_once("appconfig.php");
require_once(APP_PATH."/service/authenticate_user.php");

$email = $_POST['email'];
$password = $_POST['password'];
$val=login($email,$password);
if($val==true)
{

  redirect('../view/home.php');
}
else{
echo "<script>
alert('Authentication error!');
window.location.href='../view/index.php';
</script>";
}
?>


