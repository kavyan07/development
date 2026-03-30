<?php
require_once "Category.php";

$cat = new Category();

if (isset($_GET['id'])) {
    $cat->load($_GET['id']);
}
?>

<form method="POST" action="category_save.php">
<input type="hidden" name="category_id" value="<?= $cat->value('category_id') ?>">

<input type="text" name="name" value="<?= $cat->value('name') ?>" placeholder="Name">

<textarea name="description"><?= $cat->value('description') ?></textarea>

<select name="status">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>

<button type="submit">Save</button>
</form>