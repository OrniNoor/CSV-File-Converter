<?php
function get_db_connection()
{
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "file_formatter_db";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}
return $conn;

}
?>
