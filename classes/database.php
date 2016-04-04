<?php
include(dirname(dirname(__FILE__))."/includes/initialize.php");
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
    //to check the query worked as expected.
    private function confirmQuery($result){
      if (!$result) {
        die("Database query ffailed!");
      }
    }  
  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mysqli_num_rows($result_set);
  }

  // get the last id inserted over the current db connection
  public function insert_id() {
  return mysqli_insert_id($this->connection);
  }
  
  public function prepare($sql){
    return mysqli_prepare($this->connection,$sql);

  }
  public function bind_param($sql){
    return mysqli_stmt_bind_param($this->connection,$sql);
  }


}
$database = new MySQLDatabase($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
$db =& $database;

?>