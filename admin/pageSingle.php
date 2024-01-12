<?php
session_start();
require __DIR__ .'/../class/bdd_connect.php';
require __DIR__ .'/../class/class.auth.php';
$Auth->allow('admin');

$page = 'page';

include __DIR__ .'/includes/doctype.php';

?>


<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pageId = $_GET['id'];
} else {
    die("ID de page invalide.");
}

$sql = "SELECT * FROM pages WHERE page_id = :id";
$query = $PDO->prepare($sql);
$query->bindParam(':id', $pageId, PDO::PARAM_INT);
$query->execute();
$page = $query->fetch(PDO::FETCH_ASSOC);

?>

<h1>Modifier la Page: <?= htmlspecialchars($page['titre']) ?></h1>
<div>
    <button id="addImage" data-website="<?= $website ?>" data-page-id="<?= $pageId ?>">Ajouter une image</button>
    <button id="addBeforeAfter" data-website="<?= $website ?>" data-page-id="<?= $pageId ?>">Ajouter avant / après</button>
</div>

<main id="content" class="sortable">
<?php
include __DIR__ .'/load/load--images.php'; 
?>
</main>

<div class="dropZones"></div>
<div class="dropZonesBeforeAfter d-flex flex-wrap g-5">
    <div class="dropBefore"></div>
    <div class="dropAfter"></div>
</div>






<?php
include __DIR__ .'/includes/footer.php';
include __DIR__ .'/includes/end.php';
?>