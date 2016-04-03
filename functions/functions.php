<?php 
include(dirname(dirname(__FILE__))."/includes/initialize.php");
function redirectTo($location = NULL){
	if ($location != Null) {

		header("Location: {$location}");
		exit;
	}
}

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


function outputMessage($message=""){
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	}else {
		return "";
	}
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

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = "{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}
 ?>