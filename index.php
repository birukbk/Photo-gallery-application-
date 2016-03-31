<?php 
require_once("includes/initialize.php");
include("includes/head.html");


if (isset($database)) {
	echo "ture";
}else
{
	echo "false";
}
echo "<br/>";
echo $database->escape_value("It's  working?");


//include("includes/footer.html");
 ?>
 