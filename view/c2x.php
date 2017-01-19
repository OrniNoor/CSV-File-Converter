<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");
require_once(APP_PATH."/service/file_service.php");
if(!isset($_SESSION['user_session']))
{
redirect('index.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>file formatter</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>


<div class="main_container">
<?php require_once("header.php");
echo "hello ". $_SESSION['user_session'] ."!";
echo'&nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a>';
//echo '<h1>My Files</h1>';
//get_all_files();
?>
<h1>CSV to XML</h1>
<form method="POST" action="c2x.php" enctype="multipart/form-data">
<input type="hidden" name="type" value="c2x">
<table border="1px">
<tr>
<td>
<ul>
<li><a href="home.php">CSV to JSON</a></li>
<li><a href="c2x.php">CSV to XML</a></li>
<li><a href="x2j.php">XML to JSON</a></li>
</ul>
</td>
<td><h1>UPLOAD</h1>
<input type="file" name="file"/><br>
<input type="submit" name="all" value="Convert from existing files"/>
</td>
<td><h1>Input options</h1>
<input type="checkbox" name="check" value="y"/>First row is column names<br>
<b>Field seperator:</b>
<input type="radio" name="r1" value=","/>,
<input type="radio" name="r1" value=";"/>;
<input type="radio" name="r1" value="|"/>|
<input type="radio" name="r1" value=":"/>:
<input type="radio" name="r1" value=""/>space<br>
<h1>Output options</h1>
<p>Top level root name: <input type="text" name="node" value="root"/></p>
<p>Each record name:  <input type="text" name="row" value="row"/></p>

<br>
</td>
<td>
<?php if($_SERVER['REQUEST_METHOD']=='POST')
{
if(isset($_POST['all']))
{
get_all_files();
}
else{
require_once(APP_PATH."/view/file_handler.php");
exit;
}
}?>
</td>
</tr>
<tr>
<td>

</td>
</tr>
<tr align="center">
<td colspan="4"> <input type="submit" name="upload" value="CONVERT"/></td>
</tr>

</table>
 
</form>

</div>
</body>
</html>
