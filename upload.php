<?php 
require_once("includes/config.php");
require_once("includes/initialize.php");

 ?>


<?php

$message="";
if(isset($_POST['submit'])) {
	$photo = new Photograph();
	$photo->attach_file($_FILES['file_upload']);

	if ($photo->save()) {
		$message = "File uploaded successfully.";
	}else
	{
		$message = join("<br />",$photo->errors);
	}
}	
?>

 <div id="UploadForm">
             <?php if(!empty($message)){echo "<p>{$message}</p>";} ?>
             <form  action="upload.php" enctype="multipart/form-data"  method="POST">
                <div>
                 <input name="file_upload" type="file" id="fileinput" />
                 
                 <p>Title:<input type="text" name="title" size="37"> </p> 
          
                 <p>Description:</p><textarea name="description" rows="5" cols="40"></textarea></br> 
            
                 <input type="submit" name="submit" value="Upload"/>
                </div>
            </form>
             </div>
