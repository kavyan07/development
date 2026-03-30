<?php
require_once "../CustomerGroup.php";

$group = new CustomerGroup();

foreach ($_POST as $k => $v) {
    $group->value($k, $v);
}

if (empty($_POST['customer_group_id'])) {
    unset($group->data['customer_group_id']);
}

$group->save();

header("Location: group_list.php");
?>