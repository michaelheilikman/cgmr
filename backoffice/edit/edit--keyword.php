<?php
include '../../class/bdd_connect.php';

$key_id   = $_POST['key_id'];
$key_name = $_POST['key_name'];

try {
    $sql  = "UPDATE keywords SET key_name = :key_name WHERE key_id = $key_id" ;
    $query = $PDO->prepare($sql);
    $query->bindParam(':key_name',$key_name);
    $query->execute();
} catch (PDOException $e) {
    echo 'PDOException : '.  $e->getMessage();
}
?>