<?php
require_once "Product.php";

$product = new Product();

if (isset($_GET['id'])) {
    $product->load($_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Form</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><?= $product->value('product_id') ? 'Edit Product' : 'Add Product' ?></h4>
        </div>

        <div class="card-body">

            <form method="POST" action="save.php">

                
                <input type="hidden" name="product_id" value="<?= $product->value('product_id') ?>">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= $product->value('name') ?>" required>
                </div>

                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                           value="<?= $product->value('quantity') ?>">
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control"
                           value="<?= $product->value('price') ?>">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $product->value('description') ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" <?= $product->value('status') == 1 ? 'selected' : '' ?>>Enabled</option>
                        <option value="2" <?= $product->value('status') == 2 ? 'selected' : '' ?>>Disabled</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="list.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>