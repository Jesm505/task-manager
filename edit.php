<?php  

	session_start();

	require 'database.php';
	require 'helpers.php';

	$display_table = false;
	$theres_error = false; //depois mudar isso aqui senho
	$validation_errors = [];

	if (theres_post()) {
		$task = [];
		$task['id'] = $_POST['id'];
		if (array_key_exists('name', $_POST) && strlen($_POST['name']) > 0) {
			$task['name'] = $_POST['name'];
		} else {
			$theres_error = true;
			$validation_errors['name'] = 'the task name is required'; 
		}

		if (array_key_exists('description', $_POST)) {
			$task['description'] = $_POST['description'];
		} else {
			$task['description'] = '';
		}

		if (array_key_exists('deadline', $_POST) && strlen($_POST['deadline']) > 0) {
			if (validate_date($_POST['deadline'])) {
				$task['deadline'] = date_to_db($_POST['deadline']);
			} else {
				$theres_error = true;
				$validation_errors['deadline'] = 'wrong date format';
			}
		} else {
			$task['deadline'] = '';
		}

		$task['priority'] = $_POST['priority'];

		if (array_key_exists('complete', $_POST)) {
			$task['complete'] = $_POST['complete'];
		} else {
			$task['complete'] = 'false';
		}

		if (!$theres_error) {
			edit_task($tasks_con, $task);
			header('Location: tasks.php');
			die;
		}
	}

	$task = search_task($tasks_con, $_GET['id']);

	var_dump($task);
	echo "<br>";
	var_dump($_POST);
	
	$task['name'] = (array_key_exists('name', $_POST)) ? $_POST['name'] : $task['name'];
	$task['description'] = (array_key_exists('description', $_POST)) ? $_POST['description'] : $task['description'];
	$task['deadline'] = (array_key_exists('deadline', $_POST)) ? date_to_db($_POST['deadline']) : $task['deadline'];
	$task['priority'] = (array_key_exists('priority', $_POST)) ? $_POST['priority'] : $task['priority'];
	$task['complete'] = (array_key_exists('complete', $_POST)) ? $_POST['complete'] : $task['complete'];

	echo "<br>";
	var_dump($task);

	require 'template.php';

?>