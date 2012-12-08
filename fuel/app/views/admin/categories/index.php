<h2>Listing Categories</h2>
<br>
<?php if ($categories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Description</th>
			<th style="width: 100px;"></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($categories as $category): ?>
		<tr>
			<td><?php echo str_repeat('&nbsp;', $category->level * 3).$category->title; ?></td>
			<td><?php echo $category->description; ?></td>
			<td>
				<div class="btn-group">
					<?php echo Html::anchor('admin/categories/view/'.$category->id, '<i class="icon-list-alt"></i>', array('class' => 'btn btn-small btn-info', 'title' => 'View')); ?>
					<?php echo Html::anchor('admin/categories/edit/'.$category->id, '<i class="icon-edit"></i>', array('class' => 'btn btn-small', 'title' => 'Edit')); ?>
					<?php echo Html::anchor('admin/categories/delete/'.$category->id, '<i class="icon-trash"></i>', array('onclick' => "return confirm('Are you sure?')", 'class' => 'btn btn-small btn-danger', 'title' => 'Delete')); ?>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Categories.</p>

<?php endif; ?>
<p>
	<?php echo Html::anchor('admin/categories/create', 'Add new Category', array('class' => 'btn btn-success')); ?>
</p>
