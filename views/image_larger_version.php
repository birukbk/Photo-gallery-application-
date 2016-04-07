<?php 
include(dirname(dirname(__FILE__))."/includes/initialize.php");

        if (empty($_GET['id'])) {
          redirectTo('gallery.php');
        }
       
      
 $photo=photograph::find_by_id($_GET['id']);
            $output ='';
            $output.='<div id="content">';
		    $output.='<div class="content_wrap">';
	    	$output.='<p>';
	    	$output.='<div class="thumbnail_wrap">';
			$output.='<div class="thumbnail_frame">';
	    	$output.='Title:&nbsp';
	    	$output.=$photo->title;
	    	$output.='<p>';
	    	$output.='<a href="index.php">';
	    	$output.='<img src="'.htmlentities($photo->thumb_image_path_600x600()).'">';
	    	$output.='<br/>';
	    	$output.='</a>';
	    	$output.='Description:&nbsp';
	    	$output.=$photo->description;
	        $output.='<br/>';
	        $output.='image id:&nbsp';
	    	$output.=$photo->id;
	    	$output.='<br/>';
	    	$output.='</p>';
	    	$output.='</div>';
	        $output.='</div>';




$content="";
$tpl = file_get_contents('templates/template.html');
$page_footer=file_get_contents('includes/footer.html');


$heading = "Larger version.";
$gallery_content= $output;

//parse a template and populate it with values
$page_header=parseTemplate($tpl_head,array('{{ page_heading }}' => $heading));
$larger_version_image=parseTemplate($tpl, array( 
                                    '{{ page_title }}' => $title ,
                                    '{{ page_heading }}' => $heading,
                                    '{{ content }}' => $gallery_content));
									
									

$content.=$page_header;
$content.=$larger_version_image;
$content.=$page_footer;

// echo $content;
?>
	



