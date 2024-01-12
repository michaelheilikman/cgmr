<?php
session_start();
require __DIR__ .'/../class/bdd_connect.php';
require __DIR__ .'/../class/class.auth.php';
$Auth->allow('admin');

$page = 'dashboard';

include __DIR__ .'/includes/doctype.php';
?>

 
<a href="page.php">page</a>
 
  
 
 
  

<?php
include __DIR__ .'/includes/footer.php';
include __DIR__ .'/includes/end.php';
?>