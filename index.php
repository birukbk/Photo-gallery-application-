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
echo $database->escapeValue("It's  working?");


//include("includes/footer.html");
 ?>
 