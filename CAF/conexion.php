<?php
	$host = 'localhost';
	$user = 'root';
	$password = '123';
	$db = 'caf';

	$conection = @mysqli_connect($host, $user, $password, $db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>