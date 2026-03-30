<?php
require_once "database.php";

$db = new Database();
$db->connect();

$products = $db->fetchAll("SELECT * FROM product");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Grid</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Product List</h2>
        <a href="edit.php" class="btn btn-primary">+ New Product</a>
    </div>

    <table class="table table-bordered table-hover bg-white shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $row): ?>
                <tr>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td>₹<?= $row['price'] ?></td>
                    <td>
                        <?php if ($row['status'] == 1): ?>
                            <span class="badge bg-success">Enabled</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Disabled</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $row['created_date'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['product_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $row['product_id'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this product?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center text-muted">No Products Found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

</body>
</html>