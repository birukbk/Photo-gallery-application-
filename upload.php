<?php 
require_once("includes/config.php");
require_once("includes/initialize.php");

echo "<pre>";
//print_r($_FILES[ç]);

echo "title:" .$_POST["title"];
echo "<br/>";
echo "Description:" .$_POST["description"];

echo "<pre>";



 ?>


<?php

$message="";
if(isset($_POST['submit'])) {
	$photo = new Photograph();
	$photo->description = $_POST['description'];
	$photo->title = $_POST['title'];
	$photo->attach_file($_FILES['userfile']);
	if ($photo->save()) {
		$message = "File uploaded successfully.";
	}else
	{
		$message = join("<br />",$photo->errors);
	}

	//echo $this->description;

}



// if(isset($_POST['submit'])) {
// 	// process the form data
// 	$tmp_file = $_FILES['userfile']['tmp_name'];
// 	$target_file = basename($_FILES['userfile']['name']);
// 	$upload_dir = "uploads";
  
// 	// You will probably want to first use file_exists() to make sure
// 	// there isn't already a file by the same name.
	
// 	// move_uploaded_file will return false if $tmp_file is not a valid upload file 
// 	// or if it cannot be moved for any other reason
// 	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
// 		$message = "File uploaded successfully.";
// 	} else {
// 		$error = $_FILES['userfile']['error'];
// 		$message = $upload_errors[$error];
// 	}
	
// }	

?>

 <div id="UploadForm">
             <?php if(!empty($message)){echo "<p>{$message}</p>";} ?>
             <form  action="upload.php" enctype="multipart/form-data"  method="POST">
                <div>
                 <input name="userfile" type="file" id="fileinput" />
                 
                 <p>Title:<input type="text" name="title" size="37"> </p> 
          
                 <p>Description:</p><textarea name="description" rows="5" cols="40"></textarea></br> 
            
                 <input type="submit" name="submit" value="Upload"/>
                </div>
            </form>
             </div>
