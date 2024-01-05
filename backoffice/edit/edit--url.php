<?php
include '../../class/bdd_connect.php';

$id   = $_POST['id'];
$url = $_POST['url'];

try {
    $sql  = "UPDATE blog SET url = :url WHERE id = $id" ;
    $query = $PDO->prepare($sql);
    $query->bindParam(':url',$url);
    $query->execute();
} catch (PDOException $e) {
    echo 'PDOException : '.  $e->getMessage();
}
?>