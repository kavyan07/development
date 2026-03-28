<?php

class database
{
    protected $conn = null;
    public function connection()
    {
        if ($this->conn === null) {
            $this->conn = mysqli_connect("localhost", "root", "kavyan07", "productmodule");

            if (!$this->conn) {
                die("Connection Failed: " . mysqli_connect_error());
            }
        }
        return $this->conn;
    }
    public function insert($table, $data)
    {
        $columns = implode(",", array_keys($data));
        $values = implode("','", array_values($data));

        $sql = "insert into $table ($columns) values ('$values')";
        $result = mysqli_query($this->connection(), $sql);

        if (!$result) {
            die("Insert Error: " . mysqli_error($this->connection()));
        }

        return mysqli_insert_id($this->connection());
    }
    public function update($table, $data, $condition)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key='$value'";
        }
        $set = implode(",", $set);

        $sql = "update $table set $set where $condition";
        return mysqli_query($this->connection(), $sql);
    }
    public function delete($table, $condition)
    {
        $sql = "delete from $table where $condition";
        return mysqli_query($this->connection(), $sql);
    }
    public function fetchRow($table, $condition)
    {
        $sql = "SELECT * FROM $table WHERE $condition LIMIT 1";
        $result = mysqli_query($this->connection(), $sql);
        return mysqli_fetch_assoc($result);
    }
    public function fetchAll($table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->connection(), $sql);

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

class Row
{
    public $tableName = null;
    public $primaryKey = null;
    protected $db = null;
    public $data = [];

    public function __construct()
    {
        $this->db = new database();
    }

    public function value($key, $value = null)
    {

        if (!isset($key)) {
            throw new Exception("Key should not be null", 1);
        }

        if ($value !== null) {
            $this->data[$key] = $value;
            return $this;
        }

        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;

    }

}

class Product extends Row
{
    public $tableName = "product";
    public $primaryKey = "product_id";

    public function save()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return $this->db->insert($this->tableName, $this->data);
        }

        //update()
        $id = $this->data[$this->primaryKey];
        $data = $this->data;

        unset($data[$this->primaryKey]);

        return $this->db->update($this->tableName, $data, "{$this->primaryKey} = $id");
    }


    public function load($value, $column = null)
    {
        $column = $column ?? $this->primaryKey;

        $row = $this->db->fetchRow($this->tableName, "$column = '$value'");

        if ($row) {
            $this->data = $row;
        }

        return $this;
    }

    public function delete()
    {
        $id = $this->data[$this->primaryKey] ?? null;

        if (!$id) {
            throw new Exception("Primary key not find");
        }

        return $this->db->delete($this->tableName, "{$this->primaryKey} = $id");
    }
}

echo "<pre>";

$product = new Product();


$product->value("name", "Nokia")
    ->value("quantity", 120)
    ->value("price", 1000)
    ->value("description", "Basic phone")
    ->value("status", 1)
    ->value("created_date", date("Y-m-d H:i:s"))
    ->value("updated_date", null);

$id = $product->save();
echo "id: $id<br>";
print_r($product->data);


$product->load(1);
print_r($product->data);


// $product->value("price", 1500);
// $product->save();
// print_r($product->data);

// $product = new Product();
// $product->load(1);
// $product->delete();



?>