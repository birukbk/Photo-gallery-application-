<?php 
include(dirname(dirname(__FILE__))."/includes/initialize.php");
/**
 * saves uploaded photo to uploads folder
 * @param  [type] $file [$_FILE]
 * @param  [type] $dir  [path]
 * @return [type]       [message]
 */
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
/**
 * redirects to the given page
 * @param  [type] page to redirct too 
 * 
 */
function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}
 ?>