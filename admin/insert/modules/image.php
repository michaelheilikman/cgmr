<?php
require __DIR__ .'/../../../class/bdd_connect.php';

// Assurez-vous que le fichier a été envoyé via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $fromSite = $_POST['from_site']; // Récupération de from_site
    $toolType = $_POST['tool_type']; // Récupération de tool_type
    $pageId = $_POST['page_id']; // Récupération de page_id

    // Traitement du fichier image
    require  __DIR__ .'/../../includes/imgClass.php';

    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    // Vérifiez si le fichier est une image et qu'il n'y a pas d'erreur
    if ($imageError === 0) {
        $imageFolder = '../../upload/original/';
        $folderMin = '../../upload/thumb/';
        $folderSoc = '../../upload/social/';
        
        $imageRecup = 'upload/original/' . $imageName;
        
        move_uploaded_file($imageTmpName, $imageFolder.$imageName);

        Img::creerMin($imageFolder.$imageName,$folderMin,$imageName,100,100);
        Img::creerMin($imageFolder.$imageName,$folderSoc,$imageName,800,414);

        // Insérer les informations dans la base de données
        try {
            $sql = "INSERT INTO page_tools (from_site, tool_type, tool_content, page_id) VALUES (:from_site, :tool_type, :tool_content, :page_id)";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':from_site', $fromSite);
            $stmt->bindParam(':tool_type', $toolType);
            $stmt->bindParam(':tool_content', $imageName);
            $stmt->bindParam(':page_id', $pageId);
            $stmt->execute();

            $newToolId = $PDO->lastInsertId(); // Récupérer l'ID de l'enregistrement inséré

            // Après avoir enregistré l'image dans la base de données
            echo json_encode(["success" => true, "tool_id" => $newToolId, "imageName" => $imageName]);

        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement dans la base de données: " . $e->getMessage();
        }
    } else {
        echo "Il y a eu une erreur lors de l'envoi de l'image.";
    }
} else {
    echo "Aucun fichier n'a été envoyé.";
}
?>
