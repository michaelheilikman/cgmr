<?php
include '../../class/bdd_connect.php';

if(!empty($_POST['texte'])){

$author	= $_POST['author'];
$texte = nl2br(addslashes($_POST['texte']));
$doc_id	= $_POST['doc_id'];
$texte = stripslashes($texte);

try{
	$insert = $PDO->prepare("INSERT INTO chatbox (author, texte, doc_id) VALUES (:author, :texte, :doc_id)");
	$insert->bindParam(':author', $author);
	$insert->bindParam(':texte', $texte);
	$insert->bindParam(':doc_id', $doc_id, PDO::PARAM_INT);
	$insert->execute();
} catch (PDOException $e) {
	echo 'PDOException : '.  $e->getMessage();
}
}

?>