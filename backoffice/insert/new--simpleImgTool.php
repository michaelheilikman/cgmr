<?php
include '../../class/bdd_connect.php';

if(!empty($_POST['website'])){

    $page_id = $_POST['page_id'];
    $website = $_POST['website'];
    $tool_type = $_POST['type'];


    try{
        $insert = $PDO->prepare("INSERT INTO page_tools (page_id, from_site, tool_type) VALUES (:page_id, :from_site, :tool_type)");
        $insert->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $insert->bindParam(':from_site', $website);
        $insert->bindParam(':tool_type', $tool_type);
        $insert->execute();
    } catch (PDOException $e) {
        echo 'PDOException : '.  $e->getMessage();
    }


}
?>