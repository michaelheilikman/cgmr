<?php
include 'includes/session-Auth.php';
require 'includes/recaptcha.php';
$page = 'Accueil';
?>

<?php include 'includes/doctype.php' ?>
<?php include 'includes/nav.php' ?>
<?php include 'includes/hero.php' ?>

<!-- <div class="container">
 <?= substr(hash('sha256','michaelheilikman.com'),0,15) ?>
 </div> -->
  
<div id="apropos" class="container my-5">
	<div class="d-flex flex-wrap align-self-stretch">
		
		<div class="col-lg-6 order-lg-2 px-5">
			<div>
				<h2 class="mb-4">Plus de 25 ans d'excellence dans le BTP.</h2>
				<p>Depuis plus de deux décennies, notre entreprise a été à la pointe de la construction et de la rénovation. Spécialisées dans le carrelage, le marbre, le granite, et bien plus encore, nous avons constamment évolué pour répondre aux besoins changeants de nos clients.</p>
				<p>Notre savoir-faire de finition A et notre engagement envers la qualité nous ont permis de transformer des espaces ordinaires en environnements extraordinaires. Chaque projet que nous entreprenons est le reflet de notre passion pour le métier, et c'est cette passion qui nous a valu la confiance de nos clients pendant plus de deux décennies.</p>
				<p>Laissez-nous mettre notre expertise à votre service pour réaliser vos rêves d'aménagement. Avec nous, l'excellence est une tradition, et votre satisfaction est notre priorité.</p>
			</div>
		</div>
        <div class="col-lg-6 order-lg-1" style="background-size: cover; background-position: center; background-image: url('<?= $path ?>img/poutres_chantier_apropos.png');"></div>
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
			<div class="row row-cols-3 row-cols-md-4 g-3 align-items-center">
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
			</div>
			<div class="row row-cols-3 row-cols-md-5 g-3 mt-3 mt-md-0 align-items-center">
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

            <div class="d-flex flex-wrap flex-row flex-md-column align-self-stretch justify-content-between nav-pills me-3 mb-3 mb-lg-0 col-12 col-md-4 gap-3 gap-md-0" id="v-pills-tab" role="tablist" >
                
				<div class="">
					<h2 class="mb-md-5 fw-bold col-12">À propos de nous</h2>
				
					<div class="d-flex flex-wrap flex-md-column justify-content-between">
                		<a class="nav-link pe-2 pe-md-0 active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">L'entreprise</a>
                		<a class="nav-link pe-2 pe-md-0" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Notre équipe</a>
                		<a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Où opérons-nous ?</a>
					</div>
				</div>

				<div class="d-none d-md-flex">
					<!-- Bouton Flèche Gauche -->
					<button id="prev-tab" class="btn btn-outline-dark py-0 border-2"><i class="bi bi-arrow-left fs-2"></i></button>
						<!-- Bouton Flèche Droite -->
					<button id="next-tab" class="btn btn-danger d-flex align-content-center align-items-center ms-3 py-1"><span class="fs-5 pe-3">Suivant</span> <i class="bi bi-arrow-right fs-2"></i></button>
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
		<form action="#contactus" method="POST" id="contactForm" class="d-flex flex-wrap justify-content-center">

			<?php if(!empty($statusMsg)){ ?>
				<p class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></p>
			<?php } ?>

			<div class="row g-5 mt-md-3 col-12 col-md-9">
				<div class="col-md-6 mb-md-3">
					<div class="group">      
						<input type="text" id="prenom" name="prenom" value="<?= !empty($postData['prenom'])?$postData['prenom']:''; ?>" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label class="label">Prénom</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="group">      
						<input type="text" id="nom" name="nom" value="<?= !empty($postData['nom'])?$postData['nom']:''; ?>" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label class="label">Nom</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="group">      
						<input type="email" id="email" name="email" value="<?= !empty($postData['email'])?$postData['email']:''; ?>" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label class="label">Adresse email</label>
					</div>
				</div>
				<div class="col-md-6 mb-md-3">
					<div class="group">      
						<input type="text" id="tel" name="tel" value="<?= !empty($postData['tel'])?$postData['tel']:''; ?>" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label class="label">Téléphone</label>
					</div>
				</div>
				<div class="col-12 mb-md-3">
					<div class="group">    
						<label class="labelSelect">Type de demande</label>  
						<select name="subject">
							<option value="informations">Informations</option>
							<option value="devis">Devis</option>
							<option value="contact">Contact</option>
						</select>
						<span class="highlight"></span>
						<span class="bar"></span>
					</div>
				</div>
				<div class="">
					<textarea class="comments" class="ps-2" id="commentaire" name="message" style="height: 150px" placeholder="Détails de votre demande"><?= !empty($postData['message'])?$postData['message']:''; ?></textarea>
				</div>

				<input type="hidden" name="submit_frm" value="1">
				
				<div class="col-12 mt-4">
                	<button class="btn btn-danger btn-block g-recaptcha" data-sitekey="<?= $siteKey  ?>" data-callback='onSubmit' data-action='submit'>Envoyer le message</button>
            	</div>
			</div>
		</form>
	</main>
</section>


<section class="container">
<div class="row row-cols-1 row-cols-lg-3 justify-content-center py-4">
	<div class="col col-lg-4">
		<div class="lc-block">
			<div class="lc-block card border-0 bg-transparent">
				<div class="card-body">
					<div class="d-flex flex-wrap px-1 px-lg-3 justify-content-center">
						<div class="col-12 d-flex justify-content-center ps-2 py-3">
							<svg width="64" height="53" viewBox="0 0 64 53" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.0624084 50.5625V46.0417C0.0624084 44.3889 0.451297 43.0156 1.22907 41.9219C2.00685 40.8281 3.1006 39.941 4.51032 39.2604C7.13532 37.9965 9.94261 36.9514 12.9322 36.125C15.9218 35.2986 19.3124 34.8854 23.1041 34.8854C26.8957 34.8854 30.2864 35.2986 33.2759 36.125C36.2655 36.9514 39.0728 37.9965 41.6978 39.2604C43.1075 39.941 44.2013 40.8281 44.9791 41.9219C45.7568 43.0156 46.1457 44.3889 46.1457 46.0417V50.5625C46.1457 51.1944 45.9391 51.717 45.5259 52.1302C45.1127 52.5434 44.5902 52.75 43.9582 52.75H2.24991C1.61796 52.75 1.09539 52.5434 0.6822 52.1302C0.269006 51.717 0.0624084 51.1944 0.0624084 50.5625ZM4.43741 48.375H41.7707V46.0417C41.7707 45.3125 41.5641 44.717 41.1509 44.2552C40.7377 43.7934 40.2395 43.441 39.6561 43.1979C37.5659 42.2743 35.2325 41.3872 32.6561 40.5365C30.0798 39.6858 26.8957 39.2604 23.1041 39.2604C19.3124 39.2604 16.1284 39.6858 13.552 40.5365C10.9756 41.3872 8.64227 42.2743 6.55199 43.1979C5.96866 43.441 5.47039 43.7934 5.0572 44.2552C4.644 44.717 4.43741 45.3125 4.43741 46.0417V48.375ZM23.1041 30.5104C19.8957 30.5104 17.2707 29.4653 15.2291 27.375C13.1874 25.2847 12.1666 22.684 12.1666 19.5729H11.4374C11.0485 19.5729 10.7082 19.4271 10.4166 19.1354C10.1249 18.8438 9.97907 18.5035 9.97907 18.1146C9.97907 17.7257 10.1249 17.3854 10.4166 17.0938C10.7082 16.8021 11.0485 16.6562 11.4374 16.6562H12.1666C12.1666 14.7118 12.6527 12.9618 13.6249 11.4062C14.5971 9.85069 15.861 8.58681 17.4166 7.61458V10.4583C17.4166 10.75 17.5259 11.0052 17.7447 11.224C17.9634 11.4427 18.2187 11.5521 18.5103 11.5521C18.8506 11.5521 19.118 11.4427 19.3124 11.224C19.5068 11.0052 19.6041 10.75 19.6041 10.4583V6.66667C19.993 6.56944 20.5277 6.48438 21.2082 6.41146C21.8888 6.33854 22.545 6.30208 23.177 6.30208C23.8089 6.30208 24.4652 6.33854 25.1457 6.41146C25.8263 6.48438 26.361 6.56944 26.7499 6.66667V10.4583C26.7499 10.75 26.8471 11.0052 27.0416 11.224C27.236 11.4427 27.5034 11.5521 27.8436 11.5521C28.1353 11.5521 28.3905 11.4427 28.6093 11.224C28.828 11.0052 28.9374 10.75 28.9374 10.4583V7.61458C30.493 8.58681 31.7325 9.85069 32.6561 11.4062C33.5798 12.9618 34.0416 14.7118 34.0416 16.6562H34.7707C35.1596 16.6562 35.4999 16.8021 35.7916 17.0938C36.0832 17.3854 36.2291 17.7257 36.2291 18.1146C36.2291 18.5035 36.0832 18.8438 35.7916 19.1354C35.4999 19.4271 35.1596 19.5729 34.7707 19.5729H34.0416C34.0416 22.684 33.0207 25.2847 30.9791 27.375C28.9374 29.4653 26.3124 30.5104 23.1041 30.5104ZM23.1041 26.1354C25.1457 26.1354 26.7499 25.5278 27.9166 24.3125C29.0832 23.0972 29.6666 21.5174 29.6666 19.5729H16.5416C16.5416 21.5174 17.1249 23.0972 18.2916 24.3125C19.4582 25.5278 21.0624 26.1354 23.1041 26.1354ZM45.052 33.7917L44.9791 33.0625C44.6388 32.8681 44.2863 32.6493 43.9218 32.4063C43.5572 32.1632 43.2291 31.9201 42.9374 31.6771L42.1353 32.1146C41.795 32.309 41.4669 32.3576 41.1509 32.2604C40.835 32.1632 40.5554 31.9688 40.3124 31.6771L40.2395 31.5313C39.9964 31.191 39.9113 30.8385 39.9843 30.474C40.0572 30.1094 40.2395 29.8056 40.5311 29.5625L41.3332 28.9792C41.236 28.7847 41.1874 28.6024 41.1874 28.4323V27.3385C41.1874 27.1684 41.236 26.9861 41.3332 26.7917L40.5311 26.2083C40.2395 25.9653 40.0572 25.6736 39.9843 25.3333C39.9113 24.9931 39.9964 24.6528 40.2395 24.3125L40.3124 24.0938C40.5554 23.8021 40.835 23.6076 41.1509 23.5104C41.4669 23.4132 41.795 23.4618 42.1353 23.6563L42.9374 24.0938L43.9582 23.3646C44.2985 23.1215 44.6388 22.9028 44.9791 22.7083L45.052 21.9063C45.1006 21.5174 45.2586 21.2014 45.5259 20.9583C45.7933 20.7153 46.1214 20.5938 46.5103 20.5938H46.6561C47.045 20.5938 47.3731 20.7274 47.6405 20.9948C47.9079 21.2622 48.0659 21.5903 48.1145 21.9792L48.1874 22.7083C48.5277 22.9028 48.8679 23.1215 49.2082 23.3646L50.2291 24.0938L51.0311 23.6563C51.3714 23.4618 51.6995 23.4132 52.0155 23.5104C52.3315 23.6076 52.611 23.8021 52.8541 24.0938L52.927 24.2396C53.17 24.5799 53.2551 24.9323 53.1822 25.2969C53.1093 25.6615 52.927 25.9653 52.6353 26.2083L51.8332 26.7917C51.9304 26.9861 51.9791 27.1684 51.9791 27.3385V28.4323C51.9791 28.6024 51.9304 28.7847 51.8332 28.9792L52.6353 29.5625C52.927 29.8056 53.1093 30.0972 53.1822 30.4375C53.2551 30.7778 53.17 31.1181 52.927 31.4583L52.8541 31.6771C52.611 31.9688 52.3315 32.1632 52.0155 32.2604C51.6995 32.3576 51.3714 32.309 51.0311 32.1146L50.2291 31.6771C49.9374 31.9201 49.6093 32.1632 49.2447 32.4063C48.8801 32.6493 48.5277 32.8681 48.1874 33.0625L48.1145 33.8646C48.0659 34.2535 47.9079 34.5694 47.6405 34.8125C47.3731 35.0556 47.045 35.1771 46.6561 35.1771H46.5103C46.1214 35.1771 45.7933 35.0434 45.5259 34.776C45.2586 34.5087 45.1006 34.1806 45.052 33.7917ZM46.5832 30.6563C47.361 30.6563 48.0172 30.3889 48.552 29.8542C49.0867 29.3194 49.354 28.6632 49.354 27.8854C49.354 27.1076 49.0867 26.4514 48.552 25.9167C48.0172 25.3819 47.361 25.1146 46.5832 25.1146C45.8054 25.1146 45.1492 25.3819 44.6145 25.9167C44.0798 26.4514 43.8124 27.1076 43.8124 27.8854C43.8124 28.6632 44.0798 29.3194 44.6145 29.8542C45.1492 30.3889 45.8054 30.6563 46.5832 30.6563ZM52.7082 18.3333L52.3436 16.8021C51.8575 16.6076 51.3593 16.3403 50.8488 16C50.3384 15.6597 49.9131 15.2951 49.5728 14.9063L47.5311 15.6354C47.1909 15.7326 46.8627 15.7326 46.5468 15.6354C46.2308 15.5382 45.9756 15.3438 45.7811 15.0521L45.4895 14.6146C45.295 14.2743 45.2343 13.934 45.3072 13.5938C45.3801 13.2535 45.5624 12.9618 45.8541 12.7188L47.4582 11.4792C47.361 11.2361 47.2759 10.9688 47.203 10.6771C47.1301 10.3854 47.0936 10.0938 47.0936 9.80208C47.0936 9.51042 47.1301 9.21875 47.203 8.92708C47.2759 8.63542 47.361 8.36806 47.4582 8.125L45.8541 6.88542C45.5624 6.64236 45.3801 6.33854 45.3072 5.97396C45.2343 5.60938 45.295 5.28125 45.4895 4.98958L45.7811 4.625C45.9756 4.33333 46.2308 4.12674 46.5468 4.00521C46.8627 3.88368 47.1909 3.87153 47.5311 3.96875L49.5728 4.69792C49.9131 4.30903 50.3384 3.93229 50.8488 3.56771C51.3593 3.20313 51.8575 2.94792 52.3436 2.80208L52.7082 1.27083C52.8054 0.979167 52.9756 0.736111 53.2186 0.541667C53.4617 0.347222 53.729 0.25 54.0207 0.25H54.7499C55.0415 0.25 55.3089 0.347222 55.552 0.541667C55.795 0.736111 55.9652 0.979167 56.0624 1.27083L56.427 2.80208C56.9131 2.94792 57.4113 3.20313 57.9218 3.56771C58.4322 3.93229 58.8575 4.30903 59.1978 4.69792L61.2395 3.96875C61.5797 3.87153 61.9079 3.87153 62.2238 3.96875C62.5398 4.06597 62.795 4.26042 62.9895 4.55208L63.2811 4.98958C63.4756 5.32986 63.5363 5.67014 63.4634 6.01042C63.3905 6.35069 63.2082 6.64236 62.9165 6.88542L61.3124 8.125C61.4096 8.36806 61.4947 8.63542 61.5676 8.92708C61.6405 9.21875 61.677 9.51042 61.677 9.80208C61.677 10.0938 61.6405 10.3854 61.5676 10.6771C61.4947 10.9688 61.4096 11.2361 61.3124 11.4792L62.9165 12.7188C63.2082 12.9618 63.3905 13.2656 63.4634 13.6302C63.5363 13.9948 63.4756 14.3229 63.2811 14.6146L62.9895 14.9792C62.795 15.2708 62.5398 15.4774 62.2238 15.599C61.9079 15.7205 61.5797 15.7326 61.2395 15.6354L59.1978 14.9063C58.8575 15.2951 58.4322 15.6597 57.9218 16C57.4113 16.3403 56.9131 16.6076 56.427 16.8021L56.0624 18.3333C55.9652 18.625 55.795 18.8681 55.552 19.0625C55.3089 19.2569 55.0415 19.3542 54.7499 19.3542H54.0207C53.729 19.3542 53.4617 19.2569 53.2186 19.0625C52.9756 18.8681 52.8054 18.625 52.7082 18.3333ZM54.3853 14.0312C55.6006 14.0312 56.6093 13.6302 57.4113 12.8281C58.2134 12.026 58.6145 11.0174 58.6145 9.80208C58.6145 8.58681 58.2134 7.57812 57.4113 6.77604C56.6093 5.97396 55.6006 5.57292 54.3853 5.57292C53.17 5.57292 52.1613 5.97396 51.3593 6.77604C50.5572 7.57812 50.1561 8.58681 50.1561 9.80208C50.1561 11.0174 50.5572 12.026 51.3593 12.8281C52.1613 13.6302 53.17 14.0312 54.3853 14.0312Z" fill="#0D0405"/>
							</svg>
						</div>
						<div class="col-12 justify-content-center">
							<div>

								<h3 class="h5 text-center">Expertise</h3>
								<p class="text-muted text-center">Plus de 25 ans de savoir-faire.</p>


							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col col-lg-4">
		<div class="lc-block">
			<div class="lc-block card border-0 bg-transparent">
				<div class="card-body">
					<div class="d-flex flex-wrap px-1 px-lg-3 justify-content-center">
						<div class="col-12 d-flex justify-content-center ps-2 py-3">
							<svg width="61" height="53" viewBox="0 0 61 47" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.9375 46.8334C12.7708 46.8334 11.75 46.3959 10.875 45.5209C9.99996 44.6459 9.56246 43.6251 9.56246 42.4584V12.8542L0.812461 1.91675C0.520794 1.52786 0.470068 1.13897 0.660284 0.750081C0.850499 0.361192 1.19289 0.166748 1.68746 0.166748H55.7916C56.9583 0.166748 57.9791 0.604248 58.8541 1.47925C59.7291 2.35425 60.1666 3.37508 60.1666 4.54175V42.4584C60.1666 43.6251 59.7291 44.6459 58.8541 45.5209C57.9791 46.3959 56.9583 46.8334 55.7916 46.8334H13.9375ZM13.9375 4.54175V42.4584H55.7916V4.54175H13.9375ZM33.1875 31.3022H46.0208C46.6406 31.3022 47.1601 31.0913 47.5794 30.6696C47.9987 30.2479 48.2083 29.7253 48.2083 29.1019C48.2083 28.4785 47.9987 27.9601 47.5794 27.5469C47.1601 27.1338 46.6406 26.9272 46.0208 26.9272H27.8645C26.9075 26.9272 26.2429 27.3768 25.8707 28.2761C25.4985 29.1754 25.6527 29.9653 26.3333 30.6459L33.1145 37.3542C33.552 37.7917 34.0625 38.0105 34.6458 38.0105C35.2291 38.0105 35.7395 37.7917 36.177 37.3542C36.6145 36.9167 36.8333 36.3942 36.8333 35.7865C36.8333 35.1789 36.6145 34.6563 36.177 34.2188L33.1875 31.3022ZM37.5625 15.698H24.7291C24.1093 15.698 23.5898 15.9088 23.1705 16.3305C22.7513 16.7523 22.5416 17.2749 22.5416 17.8983C22.5416 18.5217 22.7513 19.04 23.1705 19.4532C23.5898 19.8664 24.1093 20.073 24.7291 20.073H42.8854C43.8424 20.073 44.507 19.6233 44.8792 18.724C45.2514 17.8247 45.0972 17.0348 44.4166 16.3542L37.6354 9.64591C37.1979 9.25702 36.6875 9.06258 36.1041 9.06258C35.5208 9.06258 35.0104 9.2631 34.5729 9.66414C34.1354 10.0652 33.9166 10.5756 33.9166 11.1954C33.9166 11.8152 34.1354 12.3438 34.5729 12.7813L37.5625 15.698Z" fill="#0D0405"/>
							</svg>
						</div>
						<div class="col-12 justify-content-center">
							<div>

								<h3 class="h5 text-center">Conseil</h3>
								<p class="text-muted text-center">Transformez vos idées en projet avec notre accompagnement.</p>


							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col col-lg-4">
		<div class="lc-block">
			<div class="lc-block card border-0 bg-transparent">
				<div class="card-body">
					<div class="d-flex flex-wrap px-1 px-lg-3 justify-content-center">
						<div class="col-12 d-flex justify-content-center ps-2 py-3">
							<svg width="70" height="53" viewBox="0 0 70 35" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.1875 35C1.56771 35 1.04818 34.7904 0.628906 34.3711C0.209635 33.9518 0 33.4323 0 32.8125V31.1354C0 29.2606 1.00868 27.7346 3.02604 26.5574C5.0434 25.3803 7.6897 24.7917 10.9649 24.7917C11.5563 24.7917 12.1249 24.8038 12.6708 24.8281C13.2167 24.8524 13.7569 24.9047 14.2917 24.985C13.9028 25.8283 13.6111 26.6831 13.4167 27.5492C13.2222 28.4153 13.125 29.319 13.125 30.2604V35H2.1875ZM19.6875 35C19.0677 35 18.5482 34.7904 18.1289 34.3711C17.7096 33.9518 17.5 33.4323 17.5 32.8125V30.2604C17.5 28.7049 17.9253 27.283 18.776 25.9948C19.6267 24.7066 20.8299 23.5764 22.3854 22.6042C23.941 21.6319 25.8004 20.9028 27.9635 20.4167C30.1267 19.9306 32.4722 19.6875 35 19.6875C37.5764 19.6875 39.9462 19.9306 42.1094 20.4167C44.2726 20.9028 46.1319 21.6319 47.6875 22.6042C49.2431 23.5764 50.434 24.7066 51.2604 25.9948C52.0868 27.283 52.5 28.7049 52.5 30.2604V32.8125C52.5 33.4323 52.2904 33.9518 51.8711 34.3711C51.4518 34.7904 50.9323 35 50.3125 35H19.6875ZM56.875 35V30.2604C56.875 29.295 56.7899 28.3852 56.6198 27.5311C56.4497 26.677 56.1701 25.8302 55.7812 24.9905C56.316 24.9066 56.8549 24.8524 57.3979 24.8281C57.941 24.8038 58.4958 24.7917 59.0625 24.7917C62.3438 24.7917 64.987 25.3694 66.9922 26.5248C68.9974 27.6801 70 29.217 70 31.1354V32.8125C70 33.4323 69.7904 33.9518 69.3711 34.3711C68.9518 34.7904 68.4323 35 67.8125 35H56.875ZM21.875 30.625H48.125V30.1875C48.125 28.3889 46.8976 26.9184 44.4427 25.776C41.9879 24.6337 38.8403 24.0625 35 24.0625C31.1597 24.0625 28.0122 24.6337 25.5573 25.776C23.1024 26.9184 21.875 28.4132 21.875 30.2604V30.625ZM10.9059 22.6042C9.51725 22.6042 8.32465 22.1044 7.32813 21.1049C6.3316 20.1053 5.83333 18.9036 5.83333 17.5C5.83333 16.0903 6.3331 14.8872 7.33265 13.8906C8.33224 12.8941 9.53385 12.3958 10.9375 12.3958C12.3472 12.3958 13.5503 12.8941 14.5469 13.8906C15.5434 14.8872 16.0417 16.1008 16.0417 17.5316C16.0417 18.9202 15.5434 20.1128 14.5469 21.1094C13.5503 22.1059 12.3367 22.6042 10.9059 22.6042ZM59.0309 22.6042C57.6423 22.6042 56.4497 22.1044 55.4531 21.1049C54.4566 20.1053 53.9583 18.9036 53.9583 17.5C53.9583 16.0903 54.4581 14.8872 55.4577 13.8906C56.4572 12.8941 57.6589 12.3958 59.0625 12.3958C60.4722 12.3958 61.6754 12.8941 62.6719 13.8906C63.6684 14.8872 64.1667 16.1008 64.1667 17.5316C64.1667 18.9202 63.6684 20.1128 62.6719 21.1094C61.6754 22.1059 60.4617 22.6042 59.0309 22.6042ZM35 17.5C32.5694 17.5 30.5035 16.6493 28.8021 14.9479C27.1007 13.2465 26.25 11.1806 26.25 8.75C26.25 6.27083 27.1007 4.19271 28.8021 2.51562C30.5035 0.838542 32.5694 0 35 0C37.4792 0 39.5573 0.838542 41.2344 2.51562C42.9115 4.19271 43.75 6.27083 43.75 8.75C43.75 11.1806 42.9115 13.2465 41.2344 14.9479C39.5573 16.6493 37.4792 17.5 35 17.5ZM35.0256 13.125C36.2724 13.125 37.309 12.7033 38.1354 11.8598C38.9618 11.0164 39.375 9.97123 39.375 8.72441C39.375 7.47758 38.9582 6.44097 38.1246 5.61458C37.2909 4.78819 36.2579 4.375 35.0256 4.375C33.7933 4.375 32.7517 4.79182 31.901 5.62545C31.0503 6.45908 30.625 7.49207 30.625 8.72441C30.625 9.95675 31.0467 10.9983 31.8902 11.849C32.7336 12.6997 33.7788 13.125 35.0256 13.125Z" fill="#0D0405"/>
							</svg>
						</div>
						<div class="col-12 justify-content-center">
							<div>

								<h3 class="h5 text-center">Entreprises et Particuliers</h3>
								<p class="text-muted text-center">Un service sur mesure pour les entreprises et particuliers.</p>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
 
 
  



<?php
include 'includes/footer.php';
include 'includes/end.php';
?>