<?php 
require_once("includes/config.php");
require_once("includes/initialize.php");
class Photograph{
	protected static $table_name="photographgallery";
	protected static $db_fields=array('id', 'filename', 'type', 'size', 'description','title');
	public $id;
	public $filename;
	public $type;
	public $size;
	public $description;
	public $title;
	
	private $temp_path;
    protected $upload_dir="uploads";
    protected $upload_dir2="thumbnails";

    public $errors=array();

    protected $upload_errors = array(
		// http://www.php.net/manual/en/features.file-upload.errors.php
	  UPLOAD_ERR_OK 				=> "No errors.",
	  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);

	// Pass in $_FILE(['uploaded_file']) as an argument
  public function attach_file($file) {
		// error checking on the form parameters
		if(!$file || empty($file) || !is_array($file)) {
		  
		  $this->errors[] = "No file was uploaded.";
		  return false;
		} elseif($file['error'] != 0) {
		  $this->errors[] = $this->upload_errors[$file['error']];
		  return false;
		} else {
		  $this->temp_path  = $file['tmp_name'];
		  $this->filename   = basename($file['name']);
		  $this->type       = $file['type'];
		  $this->size       = $file['size'];
		  $this->description=$_POST["description"];
		  $this->title       = $_POST["title"];
			return true;

		}
	}
		public function save() {
		if(isset($this->id)) {
			$this->update();
		} else {
			// Make sure there are no errors
			
			// Can't save if there are pre-existing errors
		  if(!empty($this->errors)) { return false; }
		  
			// check if the description is too long.
		  if(strlen($this->description) > 255) {
				$this->errors[] = "The description can only be 255 characters long.";
				return false;
			}
			if(strlen($this->title) > 255) {
				$this->errors[] = "The title can only be 255 characters long.";
				return false;
			}
		
		  // Can't save without filename and temp location
		  if(empty($this->filename) || empty($this->temp_path)) {
		    $this->errors[] = "The file location was not available.";
		    return false;
		  }
			
			// Determine the target_path
		  $target_path = $this->upload_dir .DS. $this->filename;
		  
		  // Make sure a file doesn't already exist in the target location
		  if(file_exists($target_path)) {
		    $this->errors[] = "The file {$this->filename} already exists.";
		    return false;
		  }
		  //check if the file is jpeg type
		  if ($this->type!="image/jpeg") {
		  	$this->errors[] = "The file {$this->filename} is not an image!";
				return false;
		  	
		  }
		
			// Attempt to move the file 
			if(move_uploaded_file($this->temp_path, $target_path)) {
					
		  	
				// Save a corresponding entry to the database
				if($this->create()) {
					$dir=opendir('uploads/');
					while (false!=($name=readdir($dir))) {
					if ($name!='.'&& $name!='..') {
					$thumb=$this->img_resize('uploads/'.$name,'thumbnails/'.$name,150,150,90);
					//echo '<img src="thumbnails/'.$name.'"width="'.$thumb[2].'"height="'.$thumb[3].'"/>';
						
						}
				}
					// We are done with temp_path, the file isn't there anymore
					unset($this->temp_path);
					// print_r($thumb);
					return true;
				}
			} else {
				// File was not moved.
		    $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
		    return false;
			}
		}
	}

		public function create() {

		global $database;
		$sanitized_filename=$this->sanitize($this->filename);
		$sanitized_type=$this->sanitize($this->type);
		$sanitized_size=$this->sanitize($this->size);
		$sanitized_description=$this->sanitize($this->description);
		$sanitized_title=$this->sanitize($this->title);
	    $sql = "INSERT INTO photographgallery 
                  (filename,type,size,description,title)
        VALUES ('$sanitized_filename', '$sanitized_type', '$sanitized_size', '$sanitized_description', '$sanitized_title')"; 

       //echo $sql;
       //echo escape_value($this->title);
       //$cleanedTitle=sanitize($this->title);


	  if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function image_path() {
	return $this->upload_dir.DS.$this->filename;
	}
	public function image_path2() {
	return $this->upload_dir2.DS.$this->filename;
	}
	 	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	



	// public static function find_all() {
	// 	global $database;

	// 	$sql=("SELECT * FROM ".self::$table_name);
	// 	$result =$database->query($sql);
	// 	return $result;
 //  }
  // -------------------------------------------------------------------------------
	public static function find_all() {
    global $database;
    $sql="SELECT * FROM ".self::$table_name;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
  	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}




	
	private function has_attribute($attribute) {
	  //check if the value exists
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	public function sanitize($value) {
	  global $database;
      $clean_value=$this->escape_value($value);
	  return $clean_value;
	}

	//resize image.
	//reperpused function from hands on example
	public function img_resize($in_img_file, $out_img_file, $req_width, $req_height, $quality) {

    // Get image file details
    list($width, $height, $type, $attr) = getimagesize($in_img_file);

    // Open file according to file type
    if (isset($type)) {
        switch ($type) {
            case IMAGETYPE_JPEG:
                $src = @imagecreatefromjpeg($in_img_file);
                break;
            case IMAGETYPE_PNG:
                $src = @imagecreatefrompng($in_img_file);
                break;
            case IMAGETYPE_GIF:
                $src = @imagecreatefromgif($in_img_file);
                break;
            default:
                $error = "Image is not a gif, png or jpeg.";
                return array(false, $error);
        }
        
        // Check if image is smaller (in both directions) than required image
        if ($width < $req_width and $height < $req_height) {
            // Use original image dimensions
            $new_width = $width;
            $new_height = $height;
        } else {
            // Test orientation of image and set new dimensions appropriately
      // (makes sure largest dimension never exceeds the target thumb size)
            if ($width > $height) {
                // landscape
                $sf = $req_width / $width;
            } else {
                // portrait                 
    $sf = $req_height / $height;
            }
            $new_width = round($width * $sf);
            $new_height = round($height * $sf);
        }

        // Create the new canvas ready for resampled image to be inserted into it
        $new = imagecreatetruecolor($new_width, $new_height);

        // Resample input image into newly created image
        imagecopyresampled($new, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Create output jpeg
        imagejpeg($new, $out_img_file, $quality);
        // Destroy any intermediate image files
        imagedestroy($src);
        imagedestroy($new);

        // Return an array of values, including the new width and height
        return array(true, "Resize successful", $new_width, $new_height);
    } else {
  // Return only the bool and an error message
        $error = "Problem opening image.";
        return array(false, $error);
    }
}
}	  	




 ?>