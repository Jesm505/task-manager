<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Task Manager</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="main block">
		<h1>Task: <?php echo $task['name']; ?></h1>
		<p>
			<a href="tasks.php">Back</a>
		</p>
		<p>
			<strong>Completed:</strong>
			<?php echo translate_complete($task['complete']); ?>
		</p>
		<p>
			<strong>Description:</strong>
			<?php echo $task['description']; ?>
		</p>
		<p>
			<strong>Deadline:</strong>
			<?php echo date_to_form($task['deadline']); ?>
		</p>
		<p>
			<strong>Priority:</strong>
			<?php echo translate_priority($task['priority']); ?>
		</p>

		<h2>Attachments</h2>
		<!-- attachments list -->
		<?php if ($file) : ?>
			<table>
				<tr>
					<th>File</th>
					<th>Options</th>
				</tr>
				<?php foreach($file as $att_file) : ?>
					<tr>
						<td><?php echo $att_file['name']; ?></td>
						<td>
							<a href="attachments/<?php echo $att_file['file'] ?>">Download</a>
							<a href="remove_file.php?id=<?php echo $att_file['id'] ?>">Remove</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		<?php else : ?>
			<p>There's no attachment file for this task.</p>
		<?php endif ?>
		<!-- new attachment form -->
		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>New Attachment</legend>
				<input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
				<label>
					<?php if ($theres_error && array_key_exists('attachment', $validation_errors)) : ?>
						<span class="error">
							<?php echo $validation_errors['attachment']; ?>
						</span>
					<?php endif ?>
					<input type="file" name="attachment">
				</label>
				<input type="submit" name="Register">
			</fieldset>
		</form>
	</div>
</body>
</html>