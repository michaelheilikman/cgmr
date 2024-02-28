<div class="d-md-none d-flex flex-wrap justify-content-between align-items-center align-self-center p-4 bg-white position-fixed sticky-top">
	<div class="col-5">
		<a href="#"><img src="<?= $path ?>img/logo.png" alt="" width="150%"></a>
	</div>

	<div class="position-relative">
	<section id="menuDesktop">
	<div class="">
        <div class="d-flex">
        <button class="navbar-toggler crossnav d-block my-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <span class="fw-bold me-1">Menu</span>
            <span class="navbar-toggler-icon">
                <span></span>
            </span>
        </button>
        </div>
	</div>
	</section>
	</div>

</div>

<section class="d-md-none px-3">
	<div class="coverImg" style="height:90vh;background-image: url('<?= $path ?>img/chantier_hero_banner.jpg');position:relative;">						
		<main class="p-3 d-flex flex-column justify-content-center align-items-center" style="height:90%">
			<div class="">
				<h1 class="siteTitle display-5 text-light">Carrelage. Granite. Marbre. Rénovation</h1>

				<h2 class="slogan my-4 text-light"><span class="" id="js-typedjs-mobile"></span></h2>

			</div>
			<div class="d-flex flex-wrap justify-content-start">
				<a class="btn btn-danger" href="#contactus">Demander un devis</a>
			</div>
		</main>
		<aside class="w-100" style="position:absolute;bottom:0;background-color:rgba(0,0,0,.5);">
			<section class="d-flex flex-wrap px-4 py-3">
				<div class="col-6">
					<p class="mb-0 text-light">Localisation</p>
					<p class="mb-0 text-light">Montrouge, 92120</p>
				</div>
				<div class="col-6 d-flex flex-wrap">
					<p class="mb-0 text-light">Date de création</p>
					<p class="mb-0 text-light">01/12/1998</p>
				</div>
			</section>
		</aside>
		<div class="imgLegend" style="bottom:170px;left:230px;">
			<p class="text-light">Copyright © C.G.M.R 2024</p>
		</div>
	</div>
</section>





<section style="height:90vh" class="d-none d-md-block pt-5">
	<div class="container px-0 pb-3">

		<div class="row g-0">

			<div class="col-md-6 order-md-2 d-flex coverImg" style="background-image: url('<?= $path ?>img/chantier_hero_banner.jpg');">
				<div class="align-self-end ms-4 position-relative">
					<div class="imgLegend">
						<p class="">Copyright © C.G.M.R 2024</p>
					</div>
				</div>
			</div>

			<div class="col-md-6 order-md-1 pe-5" style="padding:0 0 5vh 0">

				<div class="pb-5">
					<div class="d-none d-md-flex justify-content-between align-items-center align-self-center pb-5">
						<div class="col-6">
							<img src="<?= $path ?>img/logo.png" alt="" width="100%">
						</div>

						<div class="position-relative">
								<?php include 'includes/navigation.php' ?>
						</div>

					</div>

					<div class="mt-5">

						<h1 class="siteTitle display-5"><span>C</span>arrelage. <span>G</span>ranite. <span>M</span>arbre. <span>R</span>énovation</h1>

						<h2 class="slogan mt-4"><span class="" id="js-typedjs"></span></h2>

					</div>
				</div>
				<div class="text-dark pb-4">
					<div editable="rich">
						<p>Chez C.G.M.R, nous sommes spécialiste depuis plus de 25 ans dans le Carrelage. Granite. Marbre. Rénovation. Grâce à notre savoir-faire nous avons su fidélisé nos clients qui nous font confiance. Nous sommes basé à Montrouge et opérons dans l’ensemble de Paris et en Ile-de-France.</p>
					</div>
				</div>

				<section class="d-flex flex-wrap justify-content-between align-items-start">
					<div class="d-flex flex-wrap align-items-center col">
						<a class="btn btn-danger" href="#contactus">Demander un devis</a> <i class="bi bi-arrow-left fs-1 ms-4"></i>
					</div>
					<div class="col d-flex flex-wrap justify-content-end">
						<section class="d-flex flex-wrap flex-column px-4 py-3">
							<div class="col-12">
								<p class="mb-0 text-muted fw-semibold">Localisation</p>
								<p class="mb-0 text-muted fw-semibold">Montrouge, 92120</p>
							</div>
							<div class="col-8 mt-3 d-flex flex-wrap">
								<p class="mb-0 text-muted fw-semibold">Date de création</p>
								<p class="mb-0 text-muted fw-semibold">01/12/1998</p>
							</div>
						</section>
					</div>
				</section>


			</div>

		</div> <!-- row -->

	</div> <!-- container-fluid -->

	
</section>


<div class="d-none mt-4 d-lg-flex justify-content-center">
    <a class="mouse-scroll" href="#apropos"> 
    <span class="mouse">
        <span class="mouse-movement"> 
        </span>
    </span>
    <span class="mouse-message fadeIn">défilez vers le bas</span> 
    </a>
</div>


<div class="offcanvas offcanvas-end bg-danger d-md-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
	<div></div>
    <button type="button" class="btn-close closeCrossnav" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column justify-content-center align-items-center gap-4">
    <a class="h1 text-light text-decoration-none closeCanvas" aria-label="Close" href="<?= $path ?>accueil#realisations">Nos réalisation</a>
    <a class="h1 text-light text-decoration-none closeCanvas" aria-label="Close" href="<?= $path ?>accueil#aboutus">A propos</a>
    <a class="h1 text-light text-decoration-none closeCanvas" aria-label="Close" href="<?= $path ?>accueil#contactus">Contact</a>
  </div>
</div>