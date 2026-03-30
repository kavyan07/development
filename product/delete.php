<?php
require_once "Product.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $product = new Product();
    $product->load($id);
    $product->delete();
}

header("Location: list.php");