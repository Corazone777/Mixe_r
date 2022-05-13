<?php
namespace Core;
require_once __DIR__ . '/../config/config.php';

use PDO;
use PDOException;

class Database
{
    private $conn;
    private $stmt;
    private $error;

    public function __construct()
    {
        try {
            $this->conn = new PDO(DBC, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->conn->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {

        if(is_int($value))
        {
            $type = PDO::PARAM_INT;
        }
        elseif(is_bool($value))
        {
            $type = PDO::PARAM_BOOL;
        }
        elseif(is_null($value))
        {
            $type = PDO::PARAM_NULL;
        }
        else
        {
            $type = PDO::PARAM_STR;
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchSingle()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
