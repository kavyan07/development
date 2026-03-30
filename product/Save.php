<?php
require_once "Product.php";

$product = new Product();

foreach ($_POST as $key => $value) {
    if ($value !== '') {
        $product->value($key, $value);
    }
}


if (empty($_POST['product_id'])) {
    unset($product->data['product_id']);
}

$result = $product->save();

if ($result) {
    header("Location: list.php");
} else {
    echo "Error while saving";
}