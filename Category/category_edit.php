<?php
require_once "Category.php";

$cat = new Category();

if (isset($_GET['id'])) {
    $cat->load($_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include '../menu.php'; ?>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><?= $cat->value('category_id') ? 'Edit Category' : 'Add Category' ?></h4>
        </div>

        <div class="card-body">

            <form method="POST" action="category_save.php">

                <input type="hidden" name="category_id" value="<?= $cat->value('category_id') ?>">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= $cat->value('name') ?>" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $cat->value('description') ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" <?= $cat->value('status') == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $cat->value('status') == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="category_list.php" class="btn btn-secondary">Cancel</a>
                    <button class="btn btn-success">Save</button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>