<?php 
include(dirname(dirname(__FILE__))."/includes/head.html");
include(dirname(dirname(__FILE__))."/includes/initialize.php");

$photos=photograph::find_all();
// echo "<br/>";
// echo  dirname(__FILE__);
// echo "<br/>";
// echo dirname(dirname(__FILE__));
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
	





