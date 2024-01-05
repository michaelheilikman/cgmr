<?php
include 'includes/session-Auth.php';
$page = "erreur-404";
$title = "Oops! It looks like the page you're looking for doesn't exist. Please check the URL and try again";
$pageURL = $page;
include "includes/doctype.php" ?>


<?php include "includes/nav.php" ?>

<main class="error404">

    <!-- <div class="d-flex justify-content-center align-items-center">
        <div class="text-center">
            <img src="img/404/404.png" alt="erreur 404" width="250">
        </div>
    </div> -->
    <div class="container d-flex h-100">
        <div class="d-flex justify-content-center align-self-center w-100">
            <div class="text-center">
                <img src="<?php echo $path ?>img/404/404.png" alt="erreur 404" width="300">
                <h1 class="mt-5 font-weight-bold text-info display-4">OUPS !!</h1>
                <p class="lead">Il semblerait que votre chemin soit cassé !</p>
                <a class="btn btn-primary btn-std rounded-pill" href="<?php echo $path ?>accueil">Revenir à l'accueil</a>
            </div>
        </div>
    </div>

</main>

<?php include "includes/footer.php" ?>