<?php
require __DIR__ .'/../../class/bdd_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tool_id'])) {
    $toolId = $_POST['tool_id'];

    // Récupération du nom de l'image pour la supprimer du serveur
    $sql = "SELECT tool_content FROM page_tools WHERE tool_id = :tool_id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':tool_id', $toolId, PDO::PARAM_INT);
    $stmt->execute();
    $tool = $stmt->fetch(PDO::FETCH_OBJ);

    if ($tool) {
        // Suppression du fichier image
        $filePathOriginal = '../upload/original/' . $tool->tool_content;
        $filePathThumb = '../upload/thumb/' . $tool->tool_content;
        $filePathSocial = '../upload/social/' . $tool->tool_content;
        if (file_exists($filePathOriginal)) {
            unlink($filePathOriginal);
            unlink($filePathThumb);
            unlink($filePathSocial);
        }

        // Suppression de l'entrée dans la base de données
        $sql = "DELETE FROM page_tools WHERE tool_id = :tool_id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':tool_id', $toolId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Image supprimée avec succès.";
    } else {
        echo "Image non trouvée.";
    }
} else {
    echo "Requête invalide.";
}
?>
