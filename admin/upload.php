<?php
if($_FILES["file"]["name"]!=-1)
{
	$test=explode(".", $_FILES["file"]["name"]);
	$extension=end($test);
	$name=rand(100,999).'.'.$extension;
	$location='../uploaded_images/'.$name;
	move_uploaded_file($_FILES["file"]["tmp_name"],$location);
	$array=array($name,$location);
	echo json_encode($array);
}
?>