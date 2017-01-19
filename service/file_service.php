<?php
require_once("appconfig.php");
require_once(APP_PATH."/view/session.php");
require_once(APP_PATH."/data/dbconfig.php");

function get_all_files(){
		$query = "SELECT * FROM file_data";
		$result=mysqli_query(get_db_connection(), $query);
		while($row = mysqli_fetch_assoc($result)){				
			echo '<table border="1px">
			    <tr>
				
				<td>'.$row['file_id'].'</td>
				<td>'.$row['file'].'</td>
				<td><input type="radio" name="f1" value="'.$row['file'].'"/>
				<td>'.$row['size'].' kb </td>
				<td><a href="../service/download.php?name='.$row['file'].'"target="_blank"><img src="dld.png" width="30px" height="30px"></a>
				</td>
				</tr>
				</table>';		
		
	}
	}
	function upload_files($dbfile){
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/fileFormatter/service/uploads/".$dbfile))
	{
	return $_SERVER['DOCUMENT_ROOT']."/fileFormatter/service/uploads/".$dbfile;
	}
	else if(!(file_exists($_SERVER['DOCUMENT_ROOT']."/fileFormatter/service/uploads/".$dbfile))) {
	$query = "SELECT * FROM userdata WHERE username='".$_SESSION['user_session']."'";
	$result=mysqli_query(get_db_connection(), $query);
    $row = mysqli_fetch_assoc($result);	
	   
	   $file = $_SESSION['user_session']."-".rand(1000,100000)."-".$_FILES['file']['name'];
       $file_loc = $_FILES['file']['tmp_name'];
	   
       $file_size = $_FILES['file']['size'];
       $file_type = $_FILES['file']['type'];
       $folder=$_SERVER['DOCUMENT_ROOT']."/fileFormatter/service/uploads/";
 
 
 $new_size = $file_size/1024;  
 $new_file_name = strtolower($file);
 $final_file=str_replace(' ','-',$new_file_name);
 $link=get_db_connection();
 if(move_uploaded_file($file_loc,$folder.$final_file))
 {

$stmt = mysqli_prepare($link, "INSERT INTO file_data(file_id,file,type,size,upload_date,user_id) VALUES (?,?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, 'issisi',$id,$file,$type,$size,$date,$uid);
$id=null;
$file=$final_file;
$type=$file_type;
$size=$new_size;
$date=null;
$uid=$row['user_id'];
mysqli_stmt_execute($stmt);
$file_name=$_SERVER['DOCUMENT_ROOT']."/fileFormatter/service/uploads/".$file;
return $file_name;
 }
 }
 }
 function csvToJson($file,$fs,$check_column,$json_type)
 {
$fp = fopen($file, 'r');
$fprev=fopen($file.".json", 'w+');
fclose($fprev);
if(!isset($fs))
{
$fs=";";
}

if($check_column==='y')
{
$headers = fgetcsv($fp,1024,$fs);
$complete = array();

while ($row = fgetcsv($fp, 1024, $fs)) {
    $complete[] = array_combine($headers, $row);
}
fclose($fp);
if($json_type==='standard')
{
$json=json_encode($complete,JSON_PRETTY_PRINT);
$myfile = fopen($file.".json", "a+") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);
return $file;
}
else if($json_type==='keyed')
{
$json=json_encode(array('data' => $complete),JSON_PRETTY_PRINT);
$myfile = fopen($file.".json", "a+") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);
return $file;
}
else if($json_type==='json_array')
{
$json=json_encode($complete);
$arr=json_decode($json, true);
$myfile = fopen($file.".json", "a+") or die("Unable to open file!");
fwrite($myfile, "{\n");
foreach($arr as $key=>$value)
{

    fwrite($myfile, "Field".$key.":['");
  
        foreach ($value as $k) {

    fwrite($myfile, $k."',");
        
    }
     fwrite($myfile,"]\n");

}
fwrite($myfile, "\n}");
fclose($myfile);
return $file;
}
}//yes ends

else if(empty($check_column))
{
$headers = fgetcsv($fp,1024,$fs);
$col=count($headers);
$field_arr=array();
for($i=0;$i<$col;$i++)
{
$field_arr[$i]="field".$i;
}
$complete = array();

while ($row = fgetcsv($fp, 1024, $fs)) {
    $complete[] = array_combine($field_arr, $row);
}
fclose($fp);
if($json_type==='standard')
{
$json=json_encode($complete,JSON_PRETTY_PRINT);
$myfile = fopen($file.".json", "a+") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);
return $file;
}
else if($json_type==='keyed')
{
$json=json_encode(array('data' => $complete),JSON_PRETTY_PRINT);
$myfile = fopen($file.".json", "a+") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);
return $file;
}
else if($json_type==='json_array')
{
$json=json_encode($complete);
$arr=json_decode($json, true);
$myfile = fopen($file.".json", "a+") or die("Unable to open file!");
fwrite($myfile, "{\n");
foreach($arr as $key=>$value)
{

    fwrite($myfile, "Field".$key.":['");
  
        foreach ($value as $k) {

    fwrite($myfile, $k."',");
        
    }
     fwrite($myfile,"]\n");

}
fwrite($myfile, "\n}");
fclose($myfile);
return $file;
}
}
 }//func ends
  function csvToXml($file,$fs,$check_column,$node,$row) //xml to csv
 {

$csv = fopen($file,"r");
$fprev=fopen($file.".xml", 'w+');
fclose($fprev);
$myfile = fopen($file.".xml", "a+") or die("Unable to open file!");
$c=count($file);
fwrite($myfile, '<?xml version="1.0" encoding="UTF-8"?>'."\n");
fwrite($myfile, "<".$node.">\n");

if($check_column!="y")
{
while($c>=0)
{
foreach(file($file) as $line)
{
    $data = explode($fs, $line);
	fwrite($myfile, "<".$row.">\n");
	for($i=0;$i<count($data);$i++)
	{
	$n=$i+1;
	fwrite($myfile, $node);
    $s= "<field".$n.">".$data[$i]."</field".$n.">\n";
	fwrite($myfile, $s);
    }
	fwrite($myfile, "</".$row.">\n");
}
$c--;
}
 fwrite($myfile, "</".$node.">");
 fclose($myfile);
 return $file;
 }
 else //column set
 {
 $headers = fgetcsv($csv,1024,$fs);
 echo count($file);
 while($c>=0)
{

$p=0;
foreach(file($file) as $line)
{
     if($p==0)
	 {
	 $p++;
	 }
	 else
	 {
    $data = explode($fs, $line);
	fwrite($myfile, "<".$row.">\n");
	
	
	for($i=0;$i<count($data);$i++)
	{
	$s= "<".$headers[$i].">".$data[$i]."</".$headers[$i].">\n";

	fwrite($myfile, $s);
    }
	fwrite($myfile, "</".$row.">\n");
	
	}
}
$c--;
}
 fwrite($myfile, "</".$node.">");
 fclose($myfile);
 return $file;
 }
 }

 
 
 
  function xmlToJson($file)
 {
 $xml_string=file_get_contents($file);
 $xml = simplexml_load_string($xml_string);
 $json = json_encode($xml,JSON_PRETTY_PRINT);
$myfile = fopen($file.".json", "w") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);
return $file;
 }
 
 
?>