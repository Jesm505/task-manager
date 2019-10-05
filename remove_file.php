<?php 

require 'config.php';
require 'database.php';

$attachment = search_attach($tasks_con, $_GET['id']);
remove_attach($tasks_con, $attachment['id']);
unlink('attachments/' . $attachment['file']);

header('Location: task.php?id=' . $attachment['id']);

?>