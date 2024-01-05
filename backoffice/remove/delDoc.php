<?php
header('Location: ' . $_SERVER['HTTP_REFERER']);
include '../../class/bdd_connect.php';

$nom=$_GET['file'];
unlink("../uploads/".$nom);

$sql = "DELETE FROM docs WHERE id = {$_GET['id']}";
$query = $PDO->prepare($sql);
$query->execute();
?>