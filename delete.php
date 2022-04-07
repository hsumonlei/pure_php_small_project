<?php

require 'config.php';

print("<pre>");
print_r($_GET['id']);

$pdostatement = $pdo->prepare("DELETE FROM papers WHERE id =".$_GET['id']);

$pdostatement->execute();

header("Location: index.php");

?>