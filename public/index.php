<?php 
require_once("../includes/database.php");

if (isset($database)) {
	echo "ture";
}else
{
	echo "false";
}
echo "<br/>";
echo $database->escapeValue("It's  working?");

 ?>