<?php 
include(dirname(dirname(__FILE__))."/includes/head.html");
include(dirname(dirname(__FILE__))."/includes/initialize.php");


echo dirname(__FILE__);

// if (isset($_POST['singlefileupload'])) {
//     processUpload($_FILES['file_upload'], dirname(__FILE__));
// }


?>
<div id="UploadForm">
   <h1>Upload image:</h1>
             <?php if(!empty($message)){echo "<p>{$message}</p>";} ?>
             <form  action="upload.php" enctype="multipart/form-data"  method="POST">
                <div>
                 <label for="fileinput">Upload image:</label>
                 <input name="file_upload" type="file" id="fileinput" />
                 
                 <p>Title:<input type="text" name="title" size="37"> </p> 
          
                 <p>Description:</p><textarea name="description" rows="5" cols="40"></textarea></br> 
            
                 <input type="submit" name="submit" value="Upload"/>
                </div>
            </form>
             </div>
<!-- ************************************ -->





