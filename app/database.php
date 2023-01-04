<?php

namespace app;

use \PDO;

class database
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost'){
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
}

    /**
     * Connect to the database, and if already done put it in $pdo, in order to prevent multiple connections
     * @return PDO
     */
    private function getPDO(){
        if($this->pdo === null){
            $pdo = new PDO ('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }

    /**
     * Send a query to the database, put it into a class, and then put it in $data
     * @param $statement
     * @param $class_name
     * @return array|false
     */

    public function query($statement, $class_name = null){
        $query = $this->getPDO()->query($statement);

        if($class_name == null){
            $data = null;
        }else{
            $data = $query->fetchAll(PDO::FETCH_CLASS, $class_name);
        }
        return $data;
    }

    /** Prepare a query to the database, in order to avoid SQL injection exploit, execute it, and fetch the data in two
     * methods : single result and all results, thanks to $fetch_type parameter
     * @param $statement
     * @param $attributes
     * @param $class_name
     * @param $fetch_type
     * @return array|false|mixed
     */
    public function prepare($statement, $attributes, $class_name, $fetch_type = false){
        $query = $this->getPDO()->prepare($statement);
        $query->execute($attributes);
        $query->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if($fetch_type){
            $data = $query->fetch();
        } else {
            $data = $query->fetchALL();
        }
                return $data;
    }

    /** Insert values in the database
     * @param $table
     * @param $data
     * @return void
     */
    public function insert($table, $data)
    {
        $query_columns = $this->getPDO()->prepare("DESCRIBE " . $table . ";");
        $query_columns->execute();
        $columns = $query_columns->fetchALL(PDO::FETCH_COLUMN);
        array_shift($columns);
        $columns = implode(", ", $columns);
        $values = implode("', '", $data);
        $insert = "INSERT INTO " . $table . " (" . $columns . ")" . " VALUES ('" . $values . "')";
        $action = app::getDb()->query($insert);

    }
}