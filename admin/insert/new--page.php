<?php
require __DIR__ .'/../../class/bdd_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['website'])) {
    
    $website = $_POST['website'];
    
    $sql = "INSERT INTO pages (from_site) VALUES (:website)";
    $query = $PDO->prepare($sql);
    $query->bindParam(':website', $website, PDO::PARAM_STR);
    $result = $query->execute();

    if ($result) {
        // Récupérer l'ID de la nouvelle page
        $newPageId = $PDO->lastInsertId();
        // Récupérer les informations de la nouvelle page
        $sql = "SELECT * FROM pages WHERE page_id = :id";
        $query = $PDO->prepare($sql);
        $query->bindParam(':id', $newPageId, PDO::PARAM_INT);
        $query->execute();
        $newPage = $query->fetch();

        // Renvoyer les informations de la nouvelle page en JSON
        echo json_encode(["success" => true, "newPageId" => $newPageId]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout de la page"]);
    }
}
?>