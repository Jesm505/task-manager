<?php 
session_start();
require "database.php";
require "helpers.php";

$display_table = true;
$theres_error = false;
$validation_errors = [];

//var_dump($task);

if (theres_post()) {
	$task = [];

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
		insert_task($tasks_con, $task);
		header('Location? tasks.php');
		die;
	}
	var_dump($task);
	//echo '<br>' . $theres_error . '<br>';
}


$task_list = tasks_search($tasks_con);

$task = array(
		'id' => 0,
		'name' => (!empty($_POST['name'])) ? $_POST['name'] : '',
		'description' => (array_key_exists('description', $_POST)) ? $_POST['description'] : '',
		'deadline' => (array_key_exists('deadline', $_POST)) ? date_to_db($_POST['deadline']) : '',
		'priority' => (array_key_exists('priority', $_POST)) ? $_POST['priority'] : '',
		'complete' => (array_key_exists('complete', $_POST)) ? $_POST['complete'] : ''
); 
//var_dump($task);
require "template.php";
?>
