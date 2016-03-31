<?php 
function redirectTo($location = NULL){
	if ($location != Null) {

		header("Location: {$location}");
		exit;
	}
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