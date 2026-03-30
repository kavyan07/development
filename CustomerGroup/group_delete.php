<?php
require_once "../CustomerGroup.php";

$group = new CustomerGroup();

if (isset($_GET['id'])) {
    $group->load($_GET['id']);
    $group->delete();
}

header("Location: group_list.php");