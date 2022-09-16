<?php

namespace StudentManagementSystem\db;

class Database
{
    private $MYSQL_HOST = 'localhost'; //Host name
    private $MYSQL_USER = 'root'; // Username
    private $MYSQL_PASS = ''; // Password
    private $MYSQL_DB = 'student-management-system'; // Database Name
    private $CHARSET = 'UTF8';
    private $COLLATION = 'utf8_general_ci';
    private $pdo =null;
    private $stmt = null;

     private function connectDB(){
         $sql ="mysql:host=".$this->MYSQL_HOST.";dbname=".$this->MYSQL_DB;
//    $sql ="mysql:host=".$this->MYSQL_HOST;
    try {
    $this->pdo = new \PDO($sql,$this->MYSQL_USER,$this->MYSQL_PASS);
    $this->pdo->exec("SET NAMES '".$this->CHARSET."' COLLATE '".$this->COLLATION."'");
    $this->pdo->exec("SET CHARACTER SET '".$this->CHARSET."'");
    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_OBJ);
    } catch (\PDOException $e){
        die("PDO Error".$e->getMessage());
    }
    }

    public function __construct()
{ // Database Connect
   $this->connectDB();
}

    private function getQuery($query,$params=null){
           if (is_null($params)){
                $this->stmt = $this->pdo->query($query);
            } else {
                $this->stmt = $this->pdo->prepare($query);
                $this->stmt->execute($params);
            }
            return $this->stmt;
    }

    public function getRows($query,$params=null){
         try{ // butun setirler ucun
            return $this->getQuery($query,$params)->fetchAll();
         } catch (\PDOException $e){
             die($e->getMessage());
         }
    }

    public function getRow($query,$params=null){
         try{ // tek setir ucun
            return $this->getQuery($query,$params)->fetch();
         } catch (\PDOException $e){
             die($e->getMessage());
         }
    }

    public function getColumn($query,$params=null){
         try{ // tek bir sutun ucun ve tek bir setir
            return $this->getQuery($query,$params)->fetchColumn();
         } catch (\PDOException $e){
             die($e->getMessage());
         }
    }

    public function insert($query,$params=null){
        try {
            $this->getQuery($query,$params);
            return $this->pdo->lastInsertId();
        } catch (\PDOException $e){
            die($e->getMessage());
        }
    }
    public function update($query,$params=null){
        try {
            return $this->getQuery($query,$params)->rowCount();
        } catch (\PDOException $e){
            die($e->getMessage());
        }
    }
    public function delete($query,$params=null){
        return $this->update($query,$params);
    }

    public function __destruct()
{
    $this->pdo = null; // Database disconnect
    // TODO: Implement __destruct() method.
}

}
?>