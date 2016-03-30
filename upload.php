<?php
/**
 * artist Page
 */

/*Include the application configuration settings
Include the database class definition*/
require_once 'includes/initialize.php';

 



$output = '';

    
    // check if there were any results
  
        
        //html output with table
		
		$output .='';
	 
	//get the values from database
		// 
			
		// Close table tag	
	 
	
    



// Close the connection



$content='';
$tpl_head=file_get_contents('includes/head.html');
$tpl = file_get_contents('templates/uploadForm.html');
$page_footer=file_get_contents('includes/footer.html');

$title = '';
$heading = 'Upload image';
$artist_page_content= $output;

//parse a template and populate it with values
$page_header=parseTemplate($tpl_head,array('{{ page_heading }}' => $heading));
$artistPageContent=parseTemplate($tpl, array( 
                                    '{{ page_title }}' => $title ,
                                    '{{ page_heading }}' => $heading,
                                    '{{ content }}' => $artist_page_content));

//constracting the artist page
$content.=$page_header;
$content.=$artistPageContent;
$content.=$page_footer;

echo $content;

?>