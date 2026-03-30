<?php
require_once "CustomerGroup.php";

$group = new CustomerGroup();

if (isset($_GET['id'])) {
    $group->load($_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Group Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include '../menu.php'; ?>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><?= $group->value('customer_group_id') ? 'Edit Group' : 'Add Group' ?></h4>
        </div>

        <div class="card-body">

            <form method="POST" action="group_save.php">

                <input type="hidden" name="customer_group_id" value="<?= $group->value('customer_group_id') ?>">

                <div class="mb-3">
                    <label>Group Name</label>
                    <input type="text" name="group_name" class="form-control"
                           value="<?= $group->value('group_name') ?>" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $group->value('description') ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" <?= $group->value('status') == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $group->value('status') == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="group_list.php" class="btn btn-secondary">Cancel</a>
                    <button class="btn btn-success">Save</button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>