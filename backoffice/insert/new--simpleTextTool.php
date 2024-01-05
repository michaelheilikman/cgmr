<?php
include '../../class/bdd_connect.php';


if(!empty($_POST['website'])){

    $page_id = $_POST['page_id'];
    $website = $_POST['website'];
    $tool_type = $_POST['type'];
    $tool_content = 'Insérer votre texte...';


    try{
        $insert = $PDO->prepare("INSERT INTO page_tools (page_id, from_site, tool_type, tool_content) VALUES (:page_id, :from_site, :tool_type,:tool_content)");
        $insert->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $insert->bindParam(':from_site', $website);
        $insert->bindParam(':tool_type', $tool_type);
        $insert->bindParam(':tool_content', $tool_content);
        $insert->execute();
    } catch (PDOException $e) {
        echo 'PDOException : '.  $e->getMessage();
    }


}
?>