<?php 
require_once("includes/initialize.php");
include("includes/head.html");


if (isset($database)) {
	echo "ture";
}else
{
	echo "false";
}
echo "<br />";
// echo "INSERT INTO photographgallery (filename,type,size,description,title)
// VALUES ('"."'flower'";
$c=",";
$a="'";
$bo="(";
$bc=")";

$sql="INSERT INTO photographgallery (filename,type,size,description,title)"." VALUES ".$bo.$a."wowo".$a.$c.$a."jpg".$a.$c.$a."100".$a.$c.$a."ppppp".$a.$c.$a."pink".$a.$bc;

          
                     // .VALUES (".$filename.",".$type.",".$size.",".$description.",".$title;

echo "<br/>";
echo $database->escape_value("It's  working?");
echo "<br/>";
echo $sql;

// INSERT INTO photographgallery (filename,type,size,description,title)
// VALUES ('flower','jpg','12','beautiful flower','blue flower');
	  


//include("includes/footer.html");
 ?>
 