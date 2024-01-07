<?php
include 'includes/session-Auth.php';
require 'includes/recaptcha.php';
$captcha = new Recaptcha('6LfZfjopAAAAAMsxhxzWOL3AZMM1xFqilyN-VYZk', '6LfZfjopAAAAAE4RndCTCX75AWLBBKI5-K8us5W1');
$page = 'Accueil';
?>

<?php include 'includes/doctype.php' ?>
<?php include 'form.php' ?> 
<?php include 'includes/nav.php' ?>
<?php include 'includes/hero.php' ?>

<!-- <div class="container">
 <?= substr(hash('sha256','michaelheilikman.com'),0,15) ?>
 </div> -->
  
<div id="apropos" class="container my-5">
	<div class="row">
		
		<div class="col-lg-6 order-lg-2 my-auto px-4 p-md-5">
			<div class="lc-block">
				<div editable="rich">
					<h2 class="mb-4">Plus de 25 ans d'excellence dans le BTP.</h2>
					<p>Depuis plus de deux décennies, notre entreprise a été à la pointe de la construction et de la rénovation. Spécialisées dans le carrelage, le marbre, le granite, et bien plus encore, nous avons constamment évolué pour répondre aux besoins changeants de nos clients.</p>
					<p>Notre savoir-faire de finition A et notre engagement envers la qualité nous ont permis de transformer des espaces ordinaires en environnements extraordinaires. Chaque projet que nous entreprenons est le reflet de notre passion pour le métier, et c'est cette passion qui nous a valu la confiance de nos clients pendant plus de deux décennies.</p>
					<p>Laissez-nous mettre notre expertise à votre service pour réaliser vos rêves d'aménagement. Avec nous, l'excellence est une tradition, et votre satisfaction est notre priorité.</p>
				</div>
			</div>
		</div>
        <div lc-helper="background" class="col-lg-6 order-lg-1" style="min-height: 45vh; background-size: cover; background-position: center; background-image: url('<?= $path ?>img/poutres_chantier_apropos.png');"></div>
	</div>
</div> 


<!-- clients  -->
  
  
<div class="container py-4 py-md-6">
	<div class="row py-4 align-items-center">
		<div class="col-lg-4 mt-lg-2">
			<div class="lc-block mb-3">
				<div editable="rich">
					<h3>Nos partenaires
					</h3>
				</div>
			</div>
			<div class="lc-block">
				<div editable="rich">
					<p>Ils nous font confiance depuis plus de 25 ans.
					</p>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="row row-cols-2 row-cols-md-3 g-5 align-items-center">
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/vinci-construction.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/gtm-batiment.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/matmut.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/idf.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/cite_internationale.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/cryopal.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/finitiona.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/agb.png" width="128" height="auto" alt="" loading="lazy">
				</div>
				<div class="col lc-block">
					<img class="img-fluid" src="<?= $path ?>img/partenaires/batiouest.png" width="128" height="auto" alt="" loading="lazy">
				</div>
			</div>
			<!--/.row -->
		</div>
	</div>
</div>

<!-- Nos réalisations -->
  


<section class="bg-light pt-5 pb-3">
	<div class="container pt-3">
		<div class="lc-block text-center">
			<div editable="rich">
				<h2 class="mb-3 display-6 fw-bold" id="realisations">Nos réalisations</h2>
			</div>
		</div>
		<div class="lc-block text-center mb-5">
			<div editable="rich">
				<p class="mb-3">Les chantiers que l’on nous a confié et réalisé récemment</p>
			</div>
		</div>
	</div>
	<?php include 'includes/carousel-cards.php'; ?>
</section>


<!-- A propos de nous -->
 
<section class="my-3 py-3 my-md-5 py-md-5">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row col-12 align-items-start justify-content-between"  id="aboutus">

            <!-- Onglets en mode responsive -->
            <div class="d-flex flex-wrap flex-row flex-md-column nav-pills me-3 mb-3 mb-lg-0 col-12 col-md-4 gap-3 gap-md-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <h2 class="mb-md-5 fw-bold col-12">À propos de nous</h2>

                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">L'entreprise</a>
                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Notre équipe</a>
                <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Où opérons-nous ?</a>

				<div class="d-none d-md-block mt-md-5 ">
					<!-- Bouton Flèche Gauche -->
					<button id="prev-tab" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i></button>
						<!-- Bouton Flèche Droite -->
					<button id="next-tab" class="btn btn-danger">Suivant <i class="bi bi-arrow-right"></i></button>
				</div>
            </div>

            <!-- Contenu des onglets -->
            <div class="tab-content col-12 col-md-8" id="v-pills-tabContent">
                <!-- Contenu Onglet 'L'entreprise' -->
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                    <div class="row g-0 overflow-hidden">
                        <div class="col-12 mb-4">
                            <img src="<?= $path ?>img/ebeniste.png" alt="image d'une ébeniste travaillant le bois" width="100%">
                        </div>
                        <div class="col-lg-3">
                            <div class="lc-block">
                                <h3 class="fw-bold">C.G.M.R</h3>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="lc-block">
                                <p>Nous sommes engagés à fournir des solutions de réhabillitation respectueuses de l'environnement, en utilisant des technologies de pointe pour réduire l'impact sur l'environnement tout en maximisant l'efficacité énergétique. Nous sommes fiers de soutenir la transition vers une société plus durable et nous engageons à rendre votre maison ou votre entreprise aux normes et durable dans le temps.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenu Onglet 'Notre équipe' -->
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                    <div class="row g-0 overflow-hidden">
                        <div class="col-12 mb-4">
                            <img src="<?= $path ?>img/cables.png" alt="image de notre équipe" width="100%">
                        </div>
                        <div class="col-lg-3">
                            <div class="lc-block">
                                <h3 class="fw-bold">L'équipe</h3>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="lc-block">
                                <p>Notre équipe d'experts est composée de professionnels qualifiés et expérimentés, qui s'engagent à fournir des préstations de haute qualité pour répondre à tous vos besoins en matière de finition. Nous sommes là pour vous aider à choisir les meilleures solutions pour votre maison ou votre entreprise, et pour vous guider tout au long du processus de réalisation de vos projets.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenu Onglet 'Où opérons nous ?' -->
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                    <div class="row g-0 overflow-hidden">
                        <div class="col-12 mb-4">
                            <img src="<?= $path ?>img/paris.png" alt="image de notre zone d'opération" width="100%">
                        </div>
                        <div class="col-lg-3">
                            <div class="lc-block">
                                <h3 class="fw-bold">Où nous opérons</h3>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="lc-block">
                                <p>Bien que notre siège soit à Montrouge, notre entreprise rayonne sur l'ensemble de la ville de Paris. Notre portée s'étend à travers tous les quartiers de la capitale. Nous sommes là pour répondre à vos besoins en réalisations, carrelage, marbre, granite et rénovation divers. Notre équipe est prête à donner vie à vos idées, où que vous soyez en Ile-de-France.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  
 
<!-- Contact -->

<section class="bg-light py-5">
	<main class="container py-5" id="contactus">
		<div class="d-flex flex-wrap justify-content-center">
			<h4 class="col-10 col-md-4 text-center">Devis • Informations • Contact</h4>
			<h2 class="col-10 fw-bold text-center">Contactez-nous</h2>
			<p class="col-10 col-md-6 text-center">N’hésitez pas à nous contacter pour toute demande d’informations ou pour une demande de devis en remplissant le formulaire ci-contre.</p>
		</div>
		<form action="#contactus" method="POST" id="contactForm">

			<?php
				if(isset($error_msg))
				{
					echo '<div class="form-group col-12 col-md-12">
						<div class="alert alert-danger">'.$error_msg.'</div>
					</div>';
				}

				if(isset($success_msg))
				{
					echo '<div class="form-group col-12 col-md-12">
						<div class="alert alert-success">'.$success_msg.'</div>
					</div>';
				}

			?>
			<div class="row g-4 mt-md-5">
				<div class="col-md-6 mb-md-3">
					<div class="form-floating">
					<input type="text" class="form-control" id="prenom" name="prenom" placeholder="">
					<label for="prenom">Prénom</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="form-floating">
					<input type="text" class="form-control" id="nom" name="nom" placeholder="">
					<label for="nom">Nom</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="form-floating">
					<input type="email" class="form-control" id="email" name="email" placeholder="">
					<label for="email">Adresse email</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="form-floating">
					<input type="text" class="form-control" id="tel" name="tel" placeholder="">
					<label for="tel">Téléphone</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="form-floating">
					<select class="form-select" id="floatingSelectGrid" name="subject">
						<option value="informations">Informations</option>
						<option value="devis">Devis</option>
						<option value="contact">Contact</option>
					</select>
					<label for="floatingSelectGrid">Type de demande</label>
					</div>
				</div>
				<div class="form-floating">
					<textarea class="form-control" class="p-2" id="commentaire" name="message" style="height: 100px" placeholder=""></textarea>
					<label style="left:10px" for="commentaire">Comments</label>
				</div>
				<div class="form-group mb-3col-12 mb-md-3">
					<?php echo $captcha->html(); ?>
				</div>
				<div class="form-group col-12">
                	<button type="submit" class="btn btn-danger btn-block">Envoyer le message</button>
            	</div>
			</div>
		</form>
	</main>
</section>

<!-- Conseils -->
<!--  
	<div class="row row-cols-1 row-cols-lg-3 justify-content-center py-6">
		<div class="col lc_border_lg w-auto ">
			<div class="lc-block">
				<div class="lc-block card border-0 bg-transparent">
					<div class="card-body">
						<div class="d-flex px-1 px-lg-3 ">
							<div class="lc-block">
								<svg lc-helper="svg-icon" width="2.5em" height="2.5em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">

									<path d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z"></path>
								</svg>
							</div>
							<div class="ps-2 ps-md-3">
								<div class="lc-block">

									<h3 editable="inline" class="rfs-6">FREE SHIPPING &amp; RETURN</h3>
									<p editable="inline" class="text-muted rfs-4">Free Shipping over $300</p>


								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col lc_border_lg w-auto">
			<div class="lc-block card border-0 bg-transparent">
				<div class="card-body">
					<div class="d-flex px-1 px-lg-3 ">
						<div class="lc-block">

							<svg width="2.5em" height="2.5em" xmlns="http://www.w3.org/2000/svg" lc-helper="svg-icon" viewBox="0 0 24 24">
								<title>currency-usd</title>
								<path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"></path>
							</svg>

						</div>
						<div class="ps-2 ps-md-3">
							<div class="lc-block">

								<h3 editable="inline" class="rfs-6">MONEY BACK GUARANTEE</h3>
								<p editable="inline" class="text-muted rfs-4">30 Days Money Back Guarantee</p>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col w-auto">

			<div class="lc-block  card border-0 bg-transparent">
				<div class="card-body">
					<div class="d-flex px-1 px-lg-3 ">
						<div class="lc-block">
							<svg width="2.5em" height="2.5em" lc-helper="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<title>face-agent</title>
								<path d="M18.72,14.76C19.07,13.91 19.26,13 19.26,12C19.26,11.28 19.15,10.59 18.96,9.95C18.31,10.1 17.63,10.18 16.92,10.18C13.86,10.18 11.15,8.67 9.5,6.34C8.61,8.5 6.91,10.26 4.77,11.22C4.73,11.47 4.73,11.74 4.73,12A7.27,7.27 0 0,0 12,19.27C13.05,19.27 14.06,19.04 14.97,18.63C15.54,19.72 15.8,20.26 15.78,20.26C14.14,20.81 12.87,21.08 12,21.08C9.58,21.08 7.27,20.13 5.57,18.42C4.53,17.38 3.76,16.11 3.33,14.73H2V10.18H3.09C3.93,6.04 7.6,2.92 12,2.92C14.4,2.92 16.71,3.87 18.42,5.58C19.69,6.84 20.54,8.45 20.89,10.18H22V14.67H22V14.69L22,14.73H21.94L18.38,18L13.08,17.4V15.73H17.91L18.72,14.76M9.27,11.77C9.57,11.77 9.86,11.89 10.07,12.11C10.28,12.32 10.4,12.61 10.4,12.91C10.4,13.21 10.28,13.5 10.07,13.71C9.86,13.92 9.57,14.04 9.27,14.04C8.64,14.04 8.13,13.54 8.13,12.91C8.13,12.28 8.64,11.77 9.27,11.77M14.72,11.77C15.35,11.77 15.85,12.28 15.85,12.91C15.85,13.54 15.35,14.04 14.72,14.04C14.09,14.04 13.58,13.54 13.58,12.91A1.14,1.14 0 0,1 14.72,11.77Z"></path>
							</svg>
						</div>
						<div class="ps-2 ps-md-3">
							<div class="lc-block">

								<h3 editable="inline" class="rfs-6">+12-800-456-747</h3>
								<p editable="inline" class="text-muted rfs-4">24/7 Available Support</p>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  -->
 
  



<?php
include 'includes/footer.php';
include 'includes/end.php';
?>