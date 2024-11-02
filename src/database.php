<?php 

class database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "im2_project";

    public function initDatabase(){
        try {
            $con = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4", 
            $this->user, 
            $this->pass);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $th) {
            echo $th;
            return null;
        }
    }
}
