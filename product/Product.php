<?php
require_once "Row.php";

class Product extends Row
{
    public $tableName = "product";
    public $primaryKey = "product_id";
}