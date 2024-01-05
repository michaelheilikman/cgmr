<?php
include '../../class/bdd_connect.php';

$id   = $_POST['page_id'];
$url = $_POST['page_url'];

try {
    $sql  = "UPDATE pages SET page_url = :url WHERE page_id = $id" ;
    $query = $PDO->prepare($sql);
    $query->bindParam(':url',$url);
    $query->execute();
} catch (PDOException $e) {
    echo 'PDOException : '.  $e->getMessage();
}
?>