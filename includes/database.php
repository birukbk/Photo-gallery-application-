<?php
require_once("config.php");

class MySQLDatabase {


    private $connection;

    function __construct($db_host, $username, $password, $db) {
        
        $this->connection = mysqli_connect($db_host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            die('Database connection failed:'. mysqli_connect_error(). "(" . mysqli_connect_errno(). ")");
        }        
    }
    //close connection.
    function close() {
    
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    public function query($sql){
      $result = mysqli_query($this->connection,$sql);
      if (!$result) {
        die("Database query failed!");
        $this->confirmQuery($result);
      }
      return $result;
    }

    private function confirmQuery($result){
      if (!$result) {
        die("Database query failed!");
      }
    }

   
  public function fetch_array($result_set) {
    return mysql_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mysql_num_rows($result_set);
  }
  
  public function insert_id() {
    // get the last id inserted over the current db connection
    return mysql_insert_id($this->connection);
  }
  
  public function affected_rows() {
    return mysql_affected_rows($this->connection);
  }
    public function save() {
    if(isset($this->id)) {
      $this->update();
    } else {
      // Make sure there are no errors
      
      // Can't save if there are pre-existing errors
      if(!empty($this->errors)) { return false; }
      
      // Make sure the caption is not too long for the DB
      if(strlen($this->caption) > 255) {
        $this->errors[] = "The caption can only be 255 characters long.";
        return false;
      }
    
      // Can't save without filename and temp location
      if(empty($this->filename) || empty($this->temp_path)) {
        $this->errors[] = "The file location was not available.";
        return false;
      }
      
      // Determine the target_path
      $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
      
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


}
$database = new MySQLDatabase($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

?>