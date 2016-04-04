<?php 
// include(dirname(dirname(__FILE__))."/includes/head.html");
include(dirname(dirname(__FILE__))."/includes/initialize.php");

        if (empty($_GET['id'])) {
          redirectTo('gallery.php');
        }
       
      
 $photo=photograph::find_by_id($_GET['id']);
      //       $output ='';
	    	// $output.='<p>';
	    	// $output.='Title:';
	    	// $output.=$photo->title;
	    	// $output.='<br/>';
	    	// $output.='<a href="gallery.php">';
	    	// $output.='<img src="'.htmlentities($photo->image_path()).'">';
	    	// $output.='<br/>';
	    	// $output.='Description:';
	    	// $output.=$photo->description;
	    	// $output.='<br/>';
	    	// $output.='</p>';
	    	      $output ='';
            $output.='<div class="frameWrap">';
	    	$output.='<p>';
	    	$output.='Title:';
	    	$output.=$photo->title;
	    	// $output.='<div id="frame">';
	    	$output.='<br/>';
	    	$output.='<a href="gallery.php">';
	    	$output.='<img src="'.htmlentities($photo->image_path()).'">';
	    	$output.='<br/>';
	    	$output.='Description:';
	    	$output.=$photo->description;
	    	$output.='<br/>';
	    	$output.='</p>';
	    	$output.='</div>';
	    	$output.='</p>';
	    	$output.='</div>';


$content="";
$tpl_head=file_get_contents('../includes/head.html');
$tpl = file_get_contents('../templates/template.html');
$page_footer=file_get_contents('../includes/footer.html');


$heading = "THE BIG PICTURE";
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
	



