<h2>Viewing #<?php echo $post->id; ?></h2>

<p>
	<strong>User id:</strong>
	<?php echo $post->user_id; ?></p>
<p>
	<strong>Category id:</strong>
	<?php echo $post->category_id; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $post->title; ?></p>
<p>
	<strong>Slug:</strong>
	<?php echo $post->slug; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $post->summary; ?></p>
<p>
	<strong>Body:</strong>
	<?php echo $post->body; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $post->status; ?></p>

<?php echo Html::anchor('admin/posts/edit/'.$post->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/posts', 'Back'); ?>