<?php 
require_once("includes/initialize.php");
include("includes/head.html");

$photo=photograph::find_all();


echo "<pre>";
print_r($photo);


if (isset($database)) {
	echo "ture";
}else
{
	echo "false";
}
echo "<br />";


echo "<br/>";
echo $database->escape_value("It's  working?");

echo "<br/>";
echo $sql;

echo "</pre>";
//include("includes/footer.html");
 ?>
 