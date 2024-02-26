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

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto px-0 bg-dark-900">
            <div id="sidebar" class="collapse collapse-horizontal show">
                <div id="sidebar-nav" class="vh-100">
                    <div class="col-12 px-3 pt-3">
                        <h3 class="h6 text-light">LES ESSENTIELS</h3>
                    </div>
                    <section class="row row-cols-1 row-cols-lg-2 g-0 g-md-3 p-3">
                        <div class="col">
                            <a href="#" class="px-3 py-2 border border-light rounded-2 d-flex flex-wrap justify-content-center text-light text-decoration-none" id="addImage" data-website="<?= $website ?>" data-page-id="<?= $pageId ?>">
                                <i class="bi bi-image"></i>
                                <p class="col-12 text-center mb-0">Image</p>
                            </a>
                        </div>

                        <div class="col">
                            <a href="#" class="px-3 py-2 border border-light rounded-2 d-flex flex-wrap justify-content-center text-light text-decoration-none" id="addTwoColumns" data-website="<?= $website ?>" data-page-id="<?= $pageId ?>">
                                <i class="bi bi-image"></i>
                                <p class="col-12 text-center mb-0">2 colonnes</p>
                            </a>
                        </div>


                    </section>
                    
                </div>
            </div>
        </div>
        <main class="col ps-md-2 pt-2">
            <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none"><i class="bi bi-list bi-lg py-2 p-1"></i> Menu</a>
            <h1>Modifier la Page: <?= htmlspecialchars($page['titre']) ?></h1>
           

            <section id="content" class="sortable">
            <?php
            include __DIR__ .'/load/load--content.php'; 
            ?>
            </section>

            <div class="dropZones"></div>
        </main>
    </div>
</div>




<?php
include __DIR__ .'/includes/footer.php';
include __DIR__ .'/includes/end.php';
?>