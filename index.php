<!--    
        <?php
        
        if (!isset($_GET['page'])) {
    
            $id = "gallery";
        
        } else {
            
            $id=$_GET['page'];
        
        }
        // echo dirname(__FILE__)."/views/gallery.php";
        // echo "<br/>";
        // echo   $id;

        $content="";
        
        // Display content, based on the value passed 
        switch ($id) {
            
            // Display artist page 
            case "gallery" : include("views/gallery.php");
                break;
            
            // Display song page 
            case 2 : include("views/upload.php");
                break;
            default: include("views/404.php");
        }

        echo $content;
            
        ?>

 -->