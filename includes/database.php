<?php
require_once("includes/config.php");
require_once("includes/initialize.php");

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
        die("Database query ffailed!");
      }
    }

    public function escape_value($string){
      $escaped_string= mysqli_real_escape_string($this->connection, $string);
      return $escaped_string;
    }

   
  public function fetch_array($result_set) {
    return mysql_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mysql_num_rows($result_set);
  }

  // get the last id inserted over the current db connection
  public function insert_id() {
  return mysqli_insert_id($this->connection);

  }
  
  public function affected_rows() {
    return mysql_affected_rows($this->connection);
  }


}
$database = new MySQLDatabase($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
$db =& $database;

?>