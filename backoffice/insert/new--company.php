<?php
include '../../class/bdd_connect.php';


if(!empty($_POST['website'])){

	$nextID 		= $_POST['id'];
    $entreprise 	= $_POST['entreprise'];
    $gouvernance 	= $_POST['gouvernance'];
    $adresse 		= $_POST['adresse'];
    $cp 			= $_POST['cp'];
    $ville 			= $_POST['ville'];
    $numTVA			= $_POST['numTVA'];
    $website 		= $_POST['website'];
	

    try{
        $insert = $PDO->prepare("INSERT INTO entreprises (id, entreprise, gouvernance, adresse, cp, ville, num_TVA, from_site) VALUES (:id, :entreprise, :gouvernance, :adresse, :cp, :ville, :num_TVA, :from_site)");
        $insert->bindParam(':id', $nextID, PDO::PARAM_INT);
        $insert->bindParam(':entreprise', $entreprise);
        $insert->bindParam(':gouvernance', $gouvernance);
        $insert->bindParam(':adresse', $adresse);
        $insert->bindParam(':cp', $cp);
        $insert->bindParam(':ville', $ville);
        $insert->bindParam(':num_TVA', $numTVA);
        $insert->bindParam(':from_site', $website);
        $insert->execute();
    } catch (PDOException $e) {
        echo 'PDOException : '.  $e->getMessage();
    }


}
?>

