<?php
header('Location: ' . $_SERVER['HTTP_REFERER']);
include '../../class/bdd_connect.php';

$sql = "DELETE FROM users WHERE id = {$_GET['id']}";
$query = $PDO->prepare($sql);
$query->execute();
?>