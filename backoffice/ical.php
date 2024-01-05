<?php
	$id = $_POST['id'];
	// Vérifiez si le formulaire a été soumis
	if (isset($_POST['submit'.$id])) {
		// Récupérez les informations du formulaire
		$filename = $_POST['filename'];
		$addStart = $_POST['start'];
		$addEnd = $_POST['end'];
		$addDescription = $_POST['description'];
		
		// Les informations pour générer le fichier ICS
		$timezone = 'Europe/Paris';

		// Créez le contenu du fichier ICS
		$content = "BEGIN:VCALENDAR\n";
		$content .= "VERSION:2.0\n";
		$content .= "PRODID:-//hacksw/handcal//NONSGML v1.0//EN\n";
		$content .= "BEGIN:VEVENT\n";
        $content .= "SUMMARY:".$addDescription."\r\n";
		$content .= "DTSTART:" .$addStart. "\n";
		$content .= "DTEND:" .$addEnd. "\n";
		$content .= "DESCRIPTION:$addDescription\n";
        $content .= "UID:".uniqid()."\r\n";
		$content .= "END:VEVENT\n";
		$content .= "END:VCALENDAR\n";

        // Configurez les en-têtes pour le téléchargement du fichier
		header('Content-Type: text/calendar');
		header('Content-Disposition: attachment; filename="' . $filename . '.ics"');

		// Envoyez le contenu du fichier ICS au navigateur
		echo $content;
		exit;
	}
?>