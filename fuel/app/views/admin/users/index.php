<h2>Listing Users</h2>
<br>
<?php if ($users): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th style="width: 100px;"></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $user): ?>
		<tr>

			<td><?php echo $user->username; ?></td>
			<td><?php echo $user->email; ?></td>
			<td>
				<div class="btn-group">
					<?php echo Html::anchor('admin/users/view/'.$user->id, '<i class="icon-list-alt"></i>', array('class' => 'btn btn-small btn-info', 'title' => 'View')); ?>
					<?php echo Html::anchor('admin/users/edit/'.$user->id, '<i class="icon-edit"></i>', array('class' => 'btn btn-small', 'title' => 'Edit')); ?>
					<?php echo Html::anchor('admin/users/delete/'.$user->id, '<i class="icon-trash"></i>', array('onclick' => "return confirm('Are you sure?')", 'class' => 'btn btn-small btn-danger', 'title' => 'Delete')); ?>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Users.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/users/create', 'Add new User', array('class' => 'btn btn-success')); ?>

</p>
