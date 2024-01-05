<?php
header('Location: ' . $_SERVER['HTTP_REFERER']);
include '../../class/bdd_connect.php';

$sql = "DELETE FROM entreprises WHERE id = {$_GET['id']}";
$query = $PDO->prepare($sql);
$query->execute();
?>