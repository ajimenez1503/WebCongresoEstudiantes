<?php
//simple handler for a mysql database
class db_handler{
var $servername;
var $username;
var $pass;
var $dbname;
var $connection;

    public function db_handler($servername,$username,$password,$dbname){
        this->$servername=$servername;
        this->$username=$username;
        this->$pass=$password;
        this->$dbname=$dbname;
    }
    public function connect(){
        $connection=new mysqli($servername,$username,$password,$dbname);
        check_connection();
    }
    public function close(){
        $connection->close();
    }
    public function query($sqlquery){
        $res=$conn->query($sqlquery);
        return $res;
    }
    private function check_connection(){
        if ($connection->connect_error) {
        die("Connection failed: " . $connention->connect_error);
    }
    }

}
?>
