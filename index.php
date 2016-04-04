  
        <?php
        
        if (!isset($_GET['page'])) {
    
            $id = "gallery";
        
        } else {
            
            $id=$_GET['page'];
        
        }
   
        $content="";
        
        // Display content, based on the value passed 
        switch ($id) {
            
            // Display home page
            case "gallery" : include("views/gallery.php");
                break;
            
            // Display upload form
            case 2 : include("views/upload.php");
                break;

            default: include("views/404.php");
        }

        echo $content;
            
        ?>

