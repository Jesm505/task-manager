<?php 

require 'config.php';
require 'database.php';
require 'helpers.php';

$theres_error = false;
$validation_errors = [];

if (theres_post()) {
	# uploud attachments
	$task_id = $_POST['task_id'];

	if (!array_key_exists('attachment', $_FILES)) {
		$theres_error = true;
		$validation_errors['attachment'] = 'select a file';
	} else {
		if (validate_attach($_FILES['attachment'])) {
			$name = $_FILES['attachment']['name'];
			$attachment = [
				'task_id' => $task_id,
				'name' => substr($name, 0, -4),
				'file' => $name,
			];
		} else {
			$theres_error = true;
			$validation_errors['attachment'] = 'Incorrect File Format';
		}
	}

	if (!$theres_error) {
		insert_attach($tasks_con, $attachment);
	}
}

$task = search_task($tasks_con, $_GET['id']);
$file = search_attachs($tasks_con, $_GET['id']);

require 'task_template.php';

?>