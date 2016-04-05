<?php
include(dirname(dirname(__FILE__))."/includes/initialize.php");
$id=$_GET['id'];
$photo=photograph::find_by_id($id);

list($width, $height, $type, $attr) = getimagesize('../'.$photo->image_path());
$result=json_encode(array("Title"=>$photo->title, "Description"=>$photo->description, "Filename"=>$photo->filename, "width"=>$width,"hight"=>$height));
echo $result;
?>


