<?php
include(dirname(dirname(__FILE__))."/includes/initialize.php");
$id=$_GET['id'];
$photo=photograph::find_by_id($id);
if ($photo) {
  list($width, $height, $type, $attr) = getimagesize('../'.$photo->image_path());
  $result=json_encode(array("Title"=>$photo->title, "Description"=>$photo->description, "Filename"=>$photo->filename, "width"=>$width,"hight"=>$height));
echo $result;
}else if ($photo===false) {
   echo "The requested id doesn't exist!";
   die;
}
?>


