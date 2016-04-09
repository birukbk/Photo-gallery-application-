<?php 
include(dirname(dirname(__FILE__))."/includes/initialize.php");

        if (empty($_GET['id'])) {
          redirectTo('gallery.php');
        }
       
      
$photo=photograph::find_by_id($_GET['id']);

$photo_title=$photo->title;
$photo_thumb_image_path_600x600=htmlentities($photo->thumb_image_path_600x600());
$photo_description=$photo->description;
$photo_id=$photo->id;


$content="";
$tpl_head=file_get_contents('includes/head.html');
$tpl = file_get_contents('templates/template_large_image.html');



$heading = "Larger version.";

//parse a template and populate it with values
$page_header=parseTemplate($tpl_head,array('{{ page_heading }}' => $heading));
$larger_version_image=parseTemplate($tpl, array( 
                                    '{{ page_heading }}' => $heading,
                                    '{{ photo_thumb_image_path_600x600 }}' => $photo_thumb_image_path_600x600,
                                    '{{ photo_title }}' => $photo_title,
                                    '{{ photo_description }}' => $photo_description,
                                    '{{ photo_id }}' => $photo_id));
									
									

$content.=$page_header;
$content.=$larger_version_image;


?>
	



