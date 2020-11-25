<?php
 define("HOST", 'localhost');
 define("USER", 'root');
 define("PASSWORD", '');
define("DATABASE", 'link');

$dsn ='mysql:host='.HOST.';dbname='.DATABASE;
$conn = new PDO($dsn, USER, PASSWORD);



?> 