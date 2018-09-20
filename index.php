<?php
include('PDO.class.php');

$req = MYSQL::query('SELECT * FROM news');

while($result = MYSQL::fetchObject($req)){
	echo $result->text;
}

?>