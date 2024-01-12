<?php
require __DIR__ .'/../../class/bdd_connect.php';

$list_order = $_POST['list_order'];

$list = explode(',' , $list_order);
$i = 1 ;
foreach($list as $idList) {
	try {
	    $sql  = "UPDATE page_tools SET item_order = :item_order WHERE tool_id = :tool_id" ;
		$query = $PDO->prepare($sql);
		$query->bindParam(':item_order', $i, PDO::PARAM_INT);
		$query->bindParam(':tool_id', $idList, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		echo 'PDOException : '.  $e->getMessage();
	}
	$i++ ;
}
?>