<?php
session_start();
require __DIR__ .'/../class/bdd_connect.php';
require __DIR__ .'/../class/class.auth.php';
$Auth->allow('admin');

$page = 'page';

include __DIR__ .'/includes/doctype.php';
?>

 
<a class="btn btn-success add-new-page" data-website="<?= $website ?>">ajouter une nouvelle page</a>
 
  
 <?php
    $sql="SELECT * FROM pages ORDER BY page_id";
    $query = $PDO->prepare($sql);
    $query->execute();
    $pages = $query->fetchAll();

 ?>

<div id="pagesList">
    <?php foreach($pages as $page): ?>
        <div><?= $page->page_id ?></div>
    <?php endforeach; ?>
</div>

 
  

<?php
include __DIR__ .'/includes/footer.php';
include __DIR__ .'/includes/end.php';
?>