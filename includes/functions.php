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

 ?>