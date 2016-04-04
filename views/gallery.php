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
  //       $output ='';
		// foreach ($photos as $photo) :
	 //    	$output.='<p>';
	 //    	$output.='<br/>';
	 //    	$output.='<a href="'."image_larger_version.php?id=".$photo->id.'">';
	 //    	$output.='<img src="'.htmlentities($photo->image_path2()).'">';
	 //    	$output.='<br/>';
	 //    	$output.=$photo->title;
	 //    	$output.='</p>';
	 //    endforeach;
	 //    
	  $output ='';

		foreach ($photos as $photo) :
			$output.='<div class="thumbframe">';

	    	$output.='<p>';
	    	// $output.='<br/>';
	    	$output.=$photo->title;
	    	$output.='<div class="thumbWrap">';
	    	// $output.='<br/>';
	    	// $output.='<br/>';
	    	$output.='<a href="'."image_larger_version.php?id=".$photo->id.'">';
	    	$output.='<img src="'.htmlentities($photo->image_path2()).'">';
	    	// $output.='<br/>';
	    	// $output.='<a/>';
	    	$output.='</div>';
	    	//$output.='</p>';
	    	$output.='</div>';
	    endforeach;
	    



$content="";
$tpl_head=file_get_contents('../includes/head.html');
$tpl = file_get_contents('../templates/template.html');
$page_footer=file_get_contents('../includes/footer.html');

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

echo $content;
?>
	





