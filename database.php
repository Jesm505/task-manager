<?php
try{    
    	$tasks_con = new PDO('sqlite:' . DB_PATH);
    	$tasks_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
     	echo 'Connection failed: ' . $e->getMessage();
     	die;
}

function tasks_search($con)
{
	$query = 'SELECT * FROM tasks;';
	$stmt = $con->prepare($query);
	$stmt->execute();

	$tasks = [];

	while ($task = $stmt->fetch()) {
		$tasks[] = $task;
	}

	return $tasks;
}

function insert_task($con, $arr) {
	$name = $arr['name'];
	$description = $arr['description'];
	$deadline = $arr['deadline'];
	$priority = $arr['priority'];
	$complete = $arr['complete'];

	try {
		//:name, :description, :deadline, :priority, :complete
		//?, ?, ?, ?, ?
		$query = 'INSERT INTO tasks(name, description, deadline, priority, complete) VALUES (:name, :description, :deadline, :priority, :complete);';
		$stmt = $con->prepare($query);
		$success = $stmt->execute(array(':name' => $name, ':description' => $description, ':deadline' => $deadline, ':priority' => $priority, ':complete' => $complete));

		/*if ($success) {
			echo "<a href='tasks.php'>success</a>";
		} else {
			echo "<a href='tasks.php'>TÁ EXECUTANDO NÃO MANOLO</a><br>";
			print_r($con->errorInfo());
		}*/
		header('Location: tasks.php');
		die;

	} catch (PDOException $e) {
		echo "ERROR: " . $e->getMessage();
	}

	//array(':name' => $name, ':description' => $description, ':deadline' => $deadline, ':priority' => $priority, ':complete' => $complete)
	//$arr -> erro no execute
	//array($name, $description, $deadline, $priority, $complete)

	/*$stmt->bindParam(':name', $name);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':deadline', $deadline);
	$stmt->bindParam(':priority', $priority);
	$stmt->bindParam(':complete', $complete);*/

}

function search_task($con, $id) { 
	$query = 'SELECT * FROM tasks WHERE id = :id;';
	$stmt = $con->prepare($query);
	$stmt->execute(array('id' => $id));

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	return $row;

	/*$tasks = [];

	while ($task = $stmt->fetch()) {
		$tasks[] = $task;
	}

	return $tasks;*/
}

function edit_task($con, $arr) {
	$query = 'UPDATE tasks SET name = :name, description = :description, deadline = :deadline, priority = :priority, complete = :complete WHERE id = :id;';
	$stmt = $con->prepare($query);
	$stmt->execute(array(':name' => $arr['name'], ':description' => $arr['description'], ':deadline' => $arr['deadline'], ':priority' => $arr['priority'], ':complete' => $arr['complete'], ':id' => $arr['id']));
}

function remove_task($con, $id) {
	$query = 'DELETE FROM tasks WHERE id = :id;';
	$stmt = $con->prepare($query);
	$stmt->execute(array(':id' => $id));
}

function insert_attach($con, $file) {
	$query = 'INSERT INTO attachments(task_id, name, file) VALUES (:task_id, :name, :file);';
	$stmt = $con->prepare($query);
	$stmt->execute(array(':task_id' => $file['task_id'], ':name' => $file['name'], 'file' => $file['file']));
}

function search_attachs($con, $id) {
	$query = 'SELECT * FROM attachments WHERE task_id = :id;';
	$stmt = $con->prepare($query);
	$stmt->execute(array(':id' => $id));

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $rows;
}

function search_attach($con, $id) {
	$query = 'SELECT * FROM attachments WHERE id = :id;';
	$stmt = $con->prepare($query);
	$stmt->execute(array(':id' => $id));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function remove_attach($con, $id) {
	$query = 'DELETE FROM attachments WHERE id = :id;';
	$stmt = $con->prepare($query);
	$stmt->execute(array(':id' => $id));
}

?>