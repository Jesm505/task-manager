<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<table>
		<tr>
			<th>Tasks</th>
			<th>Description</th>
			<th>Deadline</th>
			<th>Priority</th>
			<th>Completed</th>
			<th>Options</th>
		</tr>
		<!-- $t pelo jeito não é uma variavel criada só dentro do laço do foreach, tava pegando essa variavel no lugar de $task de tasks.php por causa do msm nome -->
		<?php foreach ($task_list as $t) : ?> 
			<tr>
				<td><a href="task.php?id=<?php echo $t['id'] ?>"><?php echo $t['name']; ?></a></td>
				<td><?php echo $t['description']; ?></td>
				<td><?php echo date_to_form($t['deadline']); ?></td>
				<td><?php echo translate_priority($t['priority']); ?></td>
				<td><?php echo translate_complete($t['complete']); ?></td>
				<td><a href="edit.php?id=<?php echo $t['id'] ?>">Edit</a>
				<a href="remove.php?id=<?php echo $t['id'] ?>">Remove</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>