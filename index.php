<?php 
require_once("includes/initialize.php");
include("includes/head.html");
$photos=photograph::find_all();
// $var="flowers.jpg";
//  $content="";
//  $content.='<img src="uploads/'.$var.'">';
//  echo $content;
//  
// foreach ($photos as $photo) :
// echo $photo->image_path();
// echo "<br/>";
// endforeach;
 ?>

 
<?php  


$output .='';
		//get the values from database
		foreach ($photos as $photo) :
			
	    	$output.='<p>';
	    	$output.='<br/>';
	    	$output.='<a href="'.$photo->image_path().'">';
	    	$output.='<img src="'.$photo->image_path2().'">';
	    	$output.='<br/>';
	    	$output.=$photo->title;
	    	$output.='</p>';
	 		
	    endforeach;
	 	echo $output;


?>
	





