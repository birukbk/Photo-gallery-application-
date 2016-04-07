<?php
include(dirname(dirname(__FILE__))."/includes/initialize.php");
if (!is_numeric($_GET['id'])) {
   $output='';
   $output.="<h3>Sorry the requested id doesn't exist in our database!<br/>";
   $output.="Try using the id found on the large version of the image. see example below</h3>";
   $output.='<br/>';
   $output.='<img src="../images/infoPIC.png">';
   echo $output;
   die;
}

$photo=photograph::find_by_id($_GET['id']);
if ($photo) {
  list($width, $height, $type, $attr) = getimagesize('../'.$photo->image_path());
  $result=json_encode(array("Title"=>$photo->title, "Description"=>$photo->description, "Filename"=>$photo->filename, "width"=>$width,"hight"=>$height));
echo $result;
 }
 else{
 	echo "<h3>Sorry the requested id doesn't exist in our database!<br/>";
 }

?>


