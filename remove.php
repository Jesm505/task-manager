<?php  

require 'config.php';
require 'database.php';

remove_task($tasks_con, $_GET['id']);
header('Location: tasks.php');
die;

?>