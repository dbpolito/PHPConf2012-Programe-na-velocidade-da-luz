<h2>Listing Posts</h2>
<br>
<?php if ($posts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User</th>
			<th>Category</th>
			<th>Title</th>
			<th>Slug</th>
			<th style="width: 100px;"></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($posts as $post): ?>
		<tr>
			<td><?php echo $post->user->username; ?></td>
			<td><?php echo $post->category->title; ?></td>
			<td><?php echo $post->title; ?></td>
			<td><?php echo $post->slug; ?></td>
			<td>
				<div class="btn-group">
					<?php echo Html::anchor('admin/posts/view/'.$post->id, '<i class="icon-list-alt"></i>', array('class' => 'btn btn-small btn-info', 'title' => 'View')); ?>
					<?php echo Html::anchor('admin/posts/edit/'.$post->id, '<i class="icon-edit"></i>', array('class' => 'btn btn-small', 'title' => 'Edit')); ?>
					<?php echo Html::anchor('admin/posts/delete/'.$post->id, '<i class="icon-trash"></i>', array('onclick' => "return confirm('Are you sure?')", 'class' => 'btn btn-small btn-danger', 'title' => 'Delete')); ?>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Posts.</p>

<?php endif; ?>
<p>
	<?php echo Html::anchor('admin/posts/create', 'Add new Post', array('class' => 'btn btn-success')); ?>
</p>
