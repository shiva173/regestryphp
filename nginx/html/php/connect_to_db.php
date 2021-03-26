<?php 

$db_hostname = 'db';
$db_database = 'logins';
$db_username = 'root';
$db_password = 'pass';

$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or die("Ошибка " . mysqli_error($db_server));

?>