<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tasks Manager</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h1>Tasks Manager</h1>

	<?php if ($display_table): ?>
		<?php require 'table.php'; ?>
	<?php endif; ?>

	<form method="post">
		<input type="hidden" name="id" value="<?php echo $task['id']; ?>">
		<fieldset>
			<legend>New task</legend>
			<label> 
				Task: 

				<?php if ($theres_error && array_key_exists('name', $validation_errors)): ?>
					<span class='error'>
						<?php echo $validation_errors['name']; ?>
					</span>
				<?php endif ?>

				<input type="text" name="name" value="<?php echo ($display_table && !$theres_error) ? '' : $task['name']; ?>"> 
			</label>
			<label>
				Description (Optional): <textarea name="description"><?php echo ($display_table && !$theres_error) ? '' : $task['description']; ?></textarea>
			</label>
			<label>
				Deadline (Optional): 
				<?php if (array_key_exists('deadline', $validation_errors)) : ?>
					<span class="error">
						<?php echo $validation_errors['deadline']; ?>
					</span>
				<?php endif ?>

				<input type="text" name="deadline"  value="<?php echo ($display_table && !$theres_error) ? '' : date_to_form($task['deadline']); ?>">
			</label>
			<fieldset>
				<legend>Priority</legend>
				<label>
					<input type="radio" name="priority" value="1" 
					<?php echo ($task['priority'] == 1) 
						? 'checked'
						: '';
					?>> Low

					<input type="radio" name="priority" value="3"
					<?php echo ($task['priority'] == 3 | strlen($task['priority']) == 0) 
						? 'checked'
						: '';
					?>> Normal

					<input type="radio" name="priority" value="5"
					<?php echo ($task['priority'] == 5) 
						? 'checked'
						: '';
					?>> High
				</label>
			</fieldset>
			<label>
				Task completed:
				<input type="checkbox" name="complete" value="true"
				<?php echo ($task['complete'] == true) 
						? 'checked'
						: '';
				?>>
			</label>
			<input type="submit" value="<?php echo ($task['id'] > 0) ? 'Update' : 'Register' ?>">
		</fieldset>
	</form>
</body>
</html>