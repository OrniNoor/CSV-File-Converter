<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");
require_once(APP_PATH."/service/file_service.php");

$pref_type=$_POST['type'];
if(isset($_POST['r1']))
{
$fs=$_POST['r1'];
}
else
{
$fs=",";
}
if(isset($_POST['check']))
{
$check_column=$_POST['check'];
}
else{
$check_column=null;
}
if(isset($_POST['f1']))
{
$file_type=$_POST['f1'];
echo $file_type;
}
else 
{
$file_type=$_FILES['file']['name'];
echo $file_type;
}
$ext = pathinfo($file_type, PATHINFO_EXTENSION);

if(isset($_POST['r2'])){
$json_type=$_POST['r2'];
}
if(isset($_POST['node'])){
$node=$_POST['node'];
}

if(isset($_POST['row'])){
$row=$_POST['row'];
}

if((strcmp($ext,"csv")==0) && (strcmp($pref_type,"c2j"))==0)
{
 $file=upload_files($file_type);
 
 if(isset($file))
 {
 $con_file=csvToJson($file,$fs,$check_column,$json_type);
 $new_file=$file.".json";
 echo '<h1>DOWNLOAD</h1><a href="../service/download.php?name='.$new_file.'"target="_blank"><img src="dld.png" width="60px" height="60px"></a>';
 
 }
 else
 {
 echo "<script>
alert('File upload error!');
window.location.href='../view/home.php';
</script>";
 }
 }


else if((strcmp($ext,"csv")==0) && (strcmp($pref_type,"c2x"))==0)
{
 $file=upload_files($file_type);
 if(isset($file))
 {
 $con_file=csvToXml($file,$fs,$check_column,$node,$row);
 $new_file=$file.".xml";
 echo '<h1>DOWNLOAD</h1><a href="../service/download.php?name='.$new_file.'"target="_blank"><img src="dld.png" width="60px" height="60px"></a>';
 
 }
 else
 {
 echo "<script>
alert('File upload error!');
window.location.href='../view/home.php';
</script>";
 }
 }
 

else if((strcmp($ext,"xml")==0) && (strcmp($pref_type,"x2j"))==0)
{
 $file=upload_files($file_type);

 if(isset($file))
 {
 $con_file=xmlToJson($file);
 $new_file=$file.".json";
 echo '<h1>DOWNLOAD</h1><a href="../service/download.php?name='.$new_file.'"target="_blank"><img src="dld.png" width="60px" height="60px"></a>';
 
 }
 else
 {
 echo "<script>
alert('File upload error!');
window.location.href='../view/home.php';
</script>";
 }
 }

else
{
echo "<script>
alert('File format error! Choose proper format');
window.location.href='../view/home.php';
</script>";
}

?>