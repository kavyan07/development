<?php
require_once "Category.php";

$category = new Category();
$data = $category->getAll();

if (!$data) {
    $data = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include '../menu.php'; ?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Category List</h2>
        <a href="category_edit.php" class="btn btn-primary">+ Add Category</a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= $row['category_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['description'] ?></td>

                            <td>
                                <?php if ($row['status'] == 1): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="category_edit.php?id=<?= $row['category_id'] ?>" 
                                   class="btn btn-sm btn-warning">Edit</a>

                                <a href="category_delete.php?id=<?= $row['category_id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this category?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No Categories Found
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>