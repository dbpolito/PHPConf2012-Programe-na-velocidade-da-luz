<h2>Viewing #<?php echo $category->id; ?></h2>

<p>
	<strong>Parent:</strong>
	<?php echo $category->parent ? $category->parent->title : 'Root'; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $category->title; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $category->description; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $category->status; ?></p>

<?php echo Html::anchor('admin/categories/edit/'.$category->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/categories', 'Back'); ?>