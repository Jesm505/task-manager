<h1>Task: <?php echo $task['name']; ?></h1>

<p>
	<strong>Completed: </strong> <?php echo translate_complete($task['complete']); ?>
</p>

<p>
	<strong>Description: </strong><?php $task['description']; ?>
</p>

<p>
	<strong>Deadline: </strong><?php date_to_form($task['deadline']); ?>
</p>
<p>
	<strong>Priority: </strong><?php translate_priority($task['priority']); ?>
</p>

<?php if(count($attachs) > 0) : ?>
	<p><strong>Hey!</strong> There's attach files on this task!</p>
<?php endif ?>
<p>Have a good day!</p>