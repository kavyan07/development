<?php
require_once "database.php";

class Row
{
    public $tableName = null;
    public $primaryKey = null;
    protected $db = null;
    public $data = [];

    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }

    public function value($key, $value = null)
    {
        if ($value !== null) {
            $this->data[$key] = $value;
            return $this;
        }

        return $this->data[$key] ?? null;
    }

    public function load($value, $column = null)
    {
        $column = $column ?? $this->primaryKey;

        $query = "SELECT * FROM {$this->tableName} WHERE $column = '$value' LIMIT 1";
        $row = $this->db->fetchRow($query);

        if (!$row) {
            return false;
        }

        $this->data = $row;
        return $this;
    }

    public function insert()
    {
        $this->data['created_date'] = date("Y-m-d H:i:s");

        $columns = implode(",", array_keys($this->data));
        $values = implode("','", array_values($this->data));

        $query = "INSERT INTO {$this->tableName} ($columns) VALUES ('$values')";
        $id = $this->db->insert($query);

        if (!$id) {
            return false;
        }

        $this->data[$this->primaryKey] = $id;
        return $this;
    }

    public function update()
    {
        $id = $this->data[$this->primaryKey] ?? null;

        if (!$id) {
            return false;
        }

        $this->data['updated_date'] = date("Y-m-d H:i:s");

        $data = $this->data;
        unset($data[$this->primaryKey]);

        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key='$value'";
        }

        $set = implode(",", $set);

        $query = "UPDATE {$this->tableName} 
                  SET $set 
                  WHERE {$this->primaryKey} = $id";

        return $this->db->update($query) ? $this : false;
    }

    public function save()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return $this->insert();
        }
        return $this->update();
    }

    public function delete()
    {
        $id = $this->data[$this->primaryKey] ?? null;

        if (!$id) {
            return false;
        }

        $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = $id";
        return $this->db->delete($query);
    }
}