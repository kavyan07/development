<?php
require_once "CustomerGroup.php";

$group = new CustomerGroup();
$data = $group->getAll();

if (!$data) {
    $data = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Group List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include '../menu.php'; ?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Customer Group List</h2>
        <a href="group_edit.php" class="btn btn-primary">+ Add Group</a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= $row['customer_group_id'] ?></td>
                            <td><?= $row['group_name'] ?></td>
                            <td><?= $row['description'] ?></td>

                            <td>
                                <?= $row['status'] ? 
                                    '<span class="badge bg-success">Active</span>' : 
                                    '<span class="badge bg-danger">Inactive</span>' ?>
                            </td>

                            <td>
                                <a href="group_edit.php?id=<?= $row['customer_group_id'] ?>" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <a href="group_delete.php?id=<?= $row['customer_group_id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this group?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No Data Found</td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>