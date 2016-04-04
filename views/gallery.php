<?php 
// include(dirname(dirname(__FILE__))."/includes/head.html");
include(dirname(dirname(__FILE__))."/includes/initialize.php");

$photos=photograph::find_all();
// echo "<pre>";
// print_r($photos);
// echo "</pre>";
// $JSON = json_encode($photos);

// echo "<pre>";
// echo $JSON;
// echo "</pre>";
// echo $JSON;
// 



// ___________________________________________________________________________________        
    
	       $output ='';
	       $output.='<div id="content">';
		   $output.='<div class="content_wrap">';

		foreach ($photos as $photo) :
			$output.='<div class="thumbnail_wrap">';
			$output.='<div class="thumbnail_frame">';
	    	$output.='<p>';
	    	$output.=$photo->title;
	    	$output.='<p>';
	    	$output.='<a href="'."image_larger_version.php?id=".$photo->id.'">';
	    	$output.='<img src="'.htmlentities($photo->thumb_image_path()).'">';
	    	$output.='</div>';
	    	$output.='</div>';  	
	    endforeach;
	        $output.='</div>';
	        $output.='</div>';

	        echo $photo->thumb_image_path();




$content="";
$tpl_head=file_get_contents('includes/head.html');
$tpl = file_get_contents('templates/template.html');
$page_footer=file_get_contents('includes/footer.html');

$title = 'Photo gallery';
$heading = 'Photo gallery application';
$gallery_content= $output;

//parse a template and populate it with values
$page_header=parseTemplate($tpl_head,array('{{ page_heading }}' => $heading));
$gallery_PageContent=parseTemplate($tpl, array( 
                                    '{{ page_title }}' => $title ,
                                    '{{ page_heading }}' => $heading,
                                    '{{ content }}' => $gallery_content));

$content.=$page_header;
$content.=$gallery_PageContent;
$content.=$page_footer;

// echo $content;
?>
	





