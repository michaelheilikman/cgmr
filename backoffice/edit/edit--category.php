<?php
include '../../class/bdd_connect.php';

$cat_id   = $_POST['cat_id'];
$cat_name = $_POST['cat_name'];

try {
    $sql  = "UPDATE category SET cat_name = :cat_name WHERE cat_id = $cat_id" ;
    $query = $PDO->prepare($sql);
    $query->bindParam(':cat_name',$cat_name);
    $query->execute();
} catch (PDOException $e) {
    echo 'PDOException : '.  $e->getMessage();
}
?>