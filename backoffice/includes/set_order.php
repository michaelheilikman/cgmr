<?php
include '../../class/bdd_connect.php';

$list_order = $_POST['list_order'];

$list = explode(',' , $list_order);
$i = 1 ;
foreach($list as $idList) {
	try {
	    $sql  = "UPDATE docs SET item_order = :item_order WHERE id = :id" ;
		$query = $PDO->prepare($sql);
		$query->bindParam(':item_order', $i, PDO::PARAM_INT);
		$query->bindParam(':id', $idList, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		echo 'PDOException : '.  $e->getMessage();
	}
	$i++ ;
}
?>