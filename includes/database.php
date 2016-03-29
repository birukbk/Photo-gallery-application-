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

    public function mysqlPrep($string){
      $escapedString = mysqli_real_escape_string($this->connection,$string);
      return $escapedString;
    }

}
$database = new MySQLDatabase();

?>