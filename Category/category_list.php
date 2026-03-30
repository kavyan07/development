<?php
require_once "Category.php";

$category = new Category();
$data = $category->getAll();
?>

<!-- <?php include 'menu.php'; ?> -->

<h2>Category List</h2>
<a href="category_edit.php">Add Category</a>

<table border="1">
<tr><th>ID</th><th>Name</th><th>Action</th></tr>

<?php foreach ($data as $row): ?>
<tr>
<td><?= $row['category_id'] ?></td>
<td><?= $row['name'] ?></td>
<td>
<a href="category_edit.php?id=<?= $row['category_id'] ?>">Edit</a>
<a href="category_delete.php?id=<?= $row['category_id'] ?>">Delete</a>
</td>
</tr>
<?php endforeach; ?>

</table>