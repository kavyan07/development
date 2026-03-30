<?php

class Database
{
    protected $conn = null;

    public function connect()
    {
        if ($this->conn === null) {
            $this->conn = mysqli_connect("localhost", "root", "kavyan07", "productmodule");

            if (!$this->conn) {
                die("Connection Failed: " . mysqli_connect_error());
            }
        }
        return $this;
    }

    public function insert($query)
    {
        mysqli_query($this->conn, $query);

        if (mysqli_error($this->conn)) {
            return false;
        }

        return mysqli_insert_id($this->conn);
    }

    public function update($query)
    {
        return mysqli_query($this->conn, $query) ? true : false;
    }

    public function delete($query)
    {
        return mysqli_query($this->conn, $query) ? true : false;
    }

    public function fetchRow($query)
    {
        $result = mysqli_query($this->conn, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            return false;
        }

        return mysqli_fetch_assoc($result);
    }

    public function fetchAll($query)
    {
        $result = mysqli_query($this->conn, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            return false;
        }

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}