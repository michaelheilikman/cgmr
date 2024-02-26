<?php
require __DIR__ .'/../../../class/bdd_connect.php';

// Vérifier si les données nécessaires sont présentes
if (isset($_POST['from_site'], $_POST['tool_type'], $_POST['page_id'])) {
    $fromSite = $_POST['from_site'];
    $toolType = $_POST['tool_type']; // Devrait être 'two-columns'
    $pageId = $_POST['page_id'];

    // Créer une structure initiale pour tool_content. 
    // Ici, je suppose que vous allez stocker un tableau JSON vide pour représenter les colonnes vides.
    $toolContent = json_encode([]);

    // Préparez et exécutez la requête SQL pour insérer le nouveau module
    $sql = "INSERT INTO page_tools (from_site, tool_type, tool_content, page_id) VALUES (:from_site, :tool_type, :tool_content, :page_id)";
    $query = $PDO->prepare($sql);
    $query->bindParam(':from_site', $fromSite);
    $query->bindParam(':tool_type', $toolType);
    $query->bindParam(':tool_content', $toolContent);
    $query->bindParam(':page_id', $pageId, PDO::PARAM_INT);

    try {
        $query->execute();
        $newToolId = $PDO->lastInsertId();

        // Renvoyer une réponse JSON indiquant le succès et l'ID du nouvel outil
        echo json_encode(["success" => true, "newToolId" => $newToolId]);
    } catch (PDOException $e) {
        // Gérer l'erreur et renvoyer une réponse JSON
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    // Données non fournies
    echo json_encode(["success" => false, "error" => "Données requises non fournies"]);
}
?>
