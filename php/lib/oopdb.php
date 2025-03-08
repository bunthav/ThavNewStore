<?php

class Database {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli(HOST, USER, PWD, DB);
        if ($this->conn->connect_errno) {
            die("Error in connecting database: " . $this->conn->connect_error);
        }
    }

    public function close() {
        $this->conn->close();
    }

    public function select($table, $column = "*", $criteria = "", $clause = "") {
        if (empty($table)) {
            return false;
        }
        $sql = "SELECT $column FROM $table";
        if (!empty($criteria)) {
            $sql .= " WHERE $criteria";
        }
        if (!empty($clause)) {
            $sql .= " $clause";
        }
        
        $result = $this->conn->query($sql);
        if (!$result) {
            echo "Error in selecting data: " . $this->conn->error;
            return false;
        }
        return $result;
    }

    public function insert($table, $data = []) {
        if (empty($table) || empty($data)) {
            return false;
        }
        $fields = implode(",", array_keys($data));
        $values = implode("','", array_values($data));
        $sql = "INSERT INTO $table ($fields) VALUES ('$values')";
        
        if (!$this->conn->query($sql)) {
            echo "Error description: " . $this->conn->error;
            return false;
        }
        return true;
    }

    public function update($table, $data = [], $criteria = "") {
        if (empty($table) || empty($data) || empty($criteria)) {
            return false;
        }
        $fv = "";
        foreach ($data as $field => $value) {
            $fv .= "$field='$value',";
        }
        $fv = rtrim($fv, ',');
        $sql = "UPDATE $table SET $fv WHERE $criteria";
        
        if (!$this->conn->query($sql)) {
            echo "Error description: " . $this->conn->error;
            return false;
        }
        return true;
    }

    public function delete($table, $criteria) {
        if (empty($table) || empty($criteria)) {
            return false;
        }
        $sql = "DELETE FROM $table WHERE $criteria";
        
        if (!$this->conn->query($sql)) {
            echo "Error description: " . $this->conn->error;
            return false;
        }
        return true;
    }

    public function count($table = "", $criteria = "") {
        if (empty($table)) {
            return false;
        }
        $sql = "SELECT * FROM $table";
        if (!empty($criteria)) {
            $sql .= " WHERE $criteria";
        }
        
        $result = $this->conn->query($sql);
        if (!$result) {
            echo "Error description: " . $this->conn->error;
            return false;
        }
        return $result->num_rows;
    }
}

?>