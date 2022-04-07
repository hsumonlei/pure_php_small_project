<?php
//username
define('MYSQL_USER','root');
//password
define('MYSQL_PASSWORD','12345');
//
define('MYSQL_HOST','localdb');

define('MYSQL_DATABASE','igcse');

$pdoOptions =  array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
);

//connection code
$pdo = new PDO(
    'mysql:dbhost='.MYSQL_HOST.';dbname='.MYSQL_DATABASE,
    MYSQL_USER,MYSQL_PASSWORD ,
    $pdoOptions
);


?>