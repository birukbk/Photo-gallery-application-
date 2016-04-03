   <!--      
        <?php
        
        if (isset($_GET['page'])) {
    
            $page = $_GET['page'];
        
        } else {
            
            $page = 1;
        
        }
        echo dirname(__FILE__)."/views/gallery.php";
        echo "<br/>";
        echo   $page;
        
        // Display content, based on the value passed 
        switch ($page) {
            
            // Display artist page 
            case 1 : include("views/gallery.php");
                break;
            
            // Display song page 
            case 2 : include("views/upload.php");
                break;
        }
            
        ?>
 -->
