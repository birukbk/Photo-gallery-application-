<?php 
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
			//$this->update();
		} else {
			// Make sure there are no errors
			
			// Can't save if there are pre-existing errors
		  if(!empty($this->errors)) { return false; }
		  
			// Make sure the description is not too long for the DB
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
		
			// Attempt to move the file 
			if(move_uploaded_file($this->temp_path, $target_path)) {
		  	// Success
				// Save a corresponding entry to the database
				if($this->create()) {
					// We are done with temp_path, the file isn't there anymore
					unset($this->temp_path);
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

		 // $attributes = $this->sanitized_attributes();
	  //    $sql = "INSERT INTO ".self::$table_name." (";
	  //    $sql .= join(", ", array_keys($attributes));
	  //    $sql .= ") VALUES ('";
		 // $sql .= join("', '", array_values($attributes));
		 // $sql .= "')";
	    $sql = "INSERT INTO photographgallery 
                  (filename,type,size,description,title)
        VALUES ('$this->filename', '$this->type', '$this->size', '$this->description', '$this->title')"; 

       echo $sql;

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
	
	public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}

	  protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
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

	
}



 ?>