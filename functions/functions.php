<?php 
include(dirname(dirname(__FILE__))."/includes/initialize.php");

function processUpload($file, $dir) {
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
echo  $message;
 }

/**
 * parse template function.
 * @param type $tpl 
 * @param placeholders string,
 * @return parsed content, string
 */
function parseTemplate($tpl, $placeholders) {
    $pass = $tpl;
    $content = '';
    foreach ($placeholders as $key => $val) {
        $pass = str_replace($key, $val, $pass);
    }
    // Remove any missed/misspelled tags
    $pass = preg_replace('/{{.*}}/','', $pass, 1);
    $content .= $pass;
    return $content;
}
 ?>