<?php
header('Location: ' . $_SERVER['HTTP_REFERER']);
include '../../class/bdd_connect.php';

$sql = "DELETE FROM pages WHERE page_id = {$_GET['id']}";
$query = $PDO->prepare($sql);
$query->execute();

$sql = "DELETE FROM page_tools WHERE page_id = {$_GET['id']}";
$query = $PDO->prepare($sql);
$query->execute();
?>