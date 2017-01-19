<?php
require_once("appconfig.php");

require_once(APP_PATH."/service/add_user.php");

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
signup($email,$username,$password);

?>
