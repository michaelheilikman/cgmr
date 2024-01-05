<?php
include '../../class/bdd_connect.php';


if(!empty($_POST['website'])){

    $cat_name = $_POST['cat_name'];
    $website = $_POST['website'];

    try{
        $insert = $PDO->prepare("INSERT INTO category (cat_name, from_site) VALUES (:cat_name, :from_site)");
        $insert->bindParam(':cat_name', $cat_name);
        $insert->bindParam(':from_site', $website);
        $insert->execute();
    } catch (PDOException $e) {
        echo 'PDOException : '.  $e->getMessage();
    }


}
?>