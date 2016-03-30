<?php
/**
 * Welcome WebPage
 */

// Gather output
require_once 'functions/functions.php';
$content='';
$output = 'Gallery area!';


$tpl = file_get_contents('templates/template.html');
$tpl_head=file_get_contents('includes/head.html');
$page_footer=file_get_contents('includes/footer.html');


$heading = 'Image repository- Home';

//parse a template and populate it with values
$page_header=parseTemplate($tpl_head,array('{{ page_heading }}' => $heading));
$welcomPageContent=parseTemplate($tpl, array( 
                                    '{{ page_title }}' => $title ,
                                    '{{ page_heading }}' => $heading,
                                    '{{ content }}' => $output));


//constracting the welcome page
$content.=$page_header;
$content.=$welcomPageContent;
$content.=$page_footer;

echo $content;

?>
