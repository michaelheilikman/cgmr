<nav id="navbar" class="navbar navbar-expand-lg py-3 navbar-light">
	<div class="container">
		<a class="navbar-brand text-light" href="#">
			<img src="<?= $path ?>img/logo.svg" width="48" height="48" class="align-middle me-1 img-fluid" alt="CGMR">
			C.G.M.R</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar3" aria-controls="myNavbar3" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>


		<div class="collapse navbar-collapse" id="myNavbar3">
			<div class="ms-auto d-flex gap-4">
        <!-- <a class="text-light text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Sign in</a> -->
        <a class="text-light text-decoration-none" href="#realisations" >Nos Réalisations</a>
        <a class="text-light text-decoration-none" href="#aboutus">A propos</a>
        <a class="text-light text-decoration-none" href="#contactus" >Contact</a>
			</div>
		</div>
	</div>
</nav>
 
 
  


<div class="position-fixed top-0 right-0 p-3" style="z-index: 9; right: 0; bottom: 0;">
  <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
    <div class="d-flex">
      <div class="toast-body">
        Votre inscription à la newsletter a bien été prise en compte. Merci ❤
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<?php if(!isset($_COOKIE['verif'])): ?>
<div id="legcookie" class="modal-content rounded-3 shadow bg-lwhite">
  <div class="modal-body p-4 text-center">
    <div style="background-position: center; background-image: url('<?= $path ?>img/cookie-popup.png');"></div>
      <p class="mb-0 small">Nous utilisons des cookies pour améliorer votre expérience sur notre site. En cliquant sur "Accepter", vous consentez à notre utilisation des cookies.</p>
  </div>
  <div class="modal-footer rounded-3 flex-nowrap p-0">
    <button type="button" class="btn fs-6 text-decoration-none col-6 m-0 rounded-0" onclick="refcook();">Refuser</button>
    <button type="button" class="btn btn-secondary fs-6 text-decoration-none col-6 m-0 rounded-bottom-3 rounded-top-0 rounded-start-0" onclick="legcook();">Accepter</button>
  </div>
</div>
<?php endif ?>