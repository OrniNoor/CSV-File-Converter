<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");
require_once(APP_PATH."/data/dbconfig.php");
function signup($email,$username,$pass)
{
$link=get_db_connection();

$stmt = mysqli_prepare($link, "INSERT INTO userdata VALUES (?,?,?,?)");
mysqli_stmt_bind_param($stmt, 'isss',$id,$uname,$umail,$upass);
$password = password_hash($pass, PASSWORD_DEFAULT); //hashing
$id=null;
$uname=$username;
$umail=$email;
$upass=$password;
mysqli_stmt_execute($stmt);
if($stmt)
{
echo "<script>
alert('Registration successful!');
window.location.href='../view/index.php';
</script>";
}
mysqli_close($link);
}


?>