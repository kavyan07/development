<?php
require_once "Category.php";

$cat = new Category();

foreach ($_POST as $k => $v) {
    $cat->value($k, $v);
}

if (empty($_POST['category_id'])) {
    unset($cat->data['category_id']);
}

$cat->save();

header("Location: category_list.php");