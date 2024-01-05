<?php
include '../../class/bdd_connect.php';


if(!empty($_POST['website'])){

    $key_name = $_POST['key_name'];
    $website = $_POST['website'];
    $key_date = $_POST['key_date'];

    try{
        $insert = $PDO->prepare("INSERT INTO keywords (key_name, from_site, key_date) VALUES (:key_name, :from_site, :key_date)");
        $insert->bindParam(':key_name', $key_name);
        $insert->bindParam(':from_site', $website);
        $insert->bindParam(':key_date', $key_date);
        $insert->execute();
    } catch (PDOException $e) {
        echo 'PDOException : '.  $e->getMessage();
    }


}
?>