<?php
require_once "Category.php";

$cat = new Category();

if (isset($_GET['id'])) {
    $cat->load($_GET['id']);
    $cat->delete();
}

header("Location: category_list.php");