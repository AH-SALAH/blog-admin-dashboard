<?php 

$dns 	= 'mysql:host=localhost;dbname=blog';
$user 	= 'root';
$pass 	= '';
$option = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				);

	try{	
		$pdo = new PDO($dns,$user,$pass,$option);
		// set the PDO error mode to exception
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}catch (PDOException $e){
		echo 'Error: ' . $e->getMessage();
	}