<footer class="bg-dark text-light">
	<div class="container py-5">
		<div class="row justify-content-between align-self-center align-items-center">
			<div class="col-md-3">
				<div class="mb-4">
					<img class="img-fluid" alt="logo" src="<?= $path ?>img/logo-blanc.png" style="max-height:10vh">
				</div>
			</div>
			<div class="col-md-5 border-bottom pb-5 d-flex flex-wrap justify-content-between align-self-center align-items-center gap-3">
				<a href="#" class="text-decoration-none text-light"><span class="text-danger">|</span> Accueil</a>
				<a href="#realisations" class="text-decoration-none text-light"><span class="text-danger">|</span> Nos réalisations</a>
				<a href="#aboutus" class="text-decoration-none text-light"><span class="text-danger">|</span> A propos</a>
				<div>
					<a class="btn btn-danger btn-block btn-md-inline" href="">Contact</a>
				</div>
			</div>
			
			
		</div>
	</div>
	<div class="py-5 container">
		<div class="row">
			<div class="col-6 small">
				<div class="lc-block">
					<div editable="rich">
						<p>Copyright © C.G.M.R <?= date("Y"); ?></p>
					</div>
				</div>
				<!-- /lc-block -->
			</div>
			<div class="col-6 text-end small">
				<div class="text-light">
					<div>
						<p>
							<a class="text-decoration-none text-light" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Connexion</a><!-- - -->
							<!-- <a class="text-decoration-none text-light" href="#">Politique de confidentialité</a> -->
						</p>
					</div>
				</div>
				<!-- /lc-block -->
			</div>
		</div>
	</div>
</footer>
 
 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-antibio">
        <h5 class="modal-title" id="exampleModalLabel">
          <img src="<?php echo $path ?>img/<?php echo $logo ?>?v=<?= $noCacheFile ?>" alt="" height="60">
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="index.php" method="POST" class="">
      <input type="hidden" name="from_site" value="<?php echo $website ?>">
        <div class="modal-body mb-0 pb-0">
            <div class="form-floating mb-3">
              <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="entrez votre adresse mail">
              <label for="exampleInputEmail1" class="text-black">Email :</label>
            </div>
            <div class="input-group mb-3">
              <div class="form-floating show_hide_password">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="entrez votre mot de passe">
                <label for="exampleInputPassword1" class="text-black">Mot de passe :</label>
              </div>
              <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
            </div>

            <div class="form-group mb-3">
              <small id="passwordHelpBlock" class="form-text">
                <a href="recuperation.php" class="text-decoration-none">Mot de passe oublié ? cliquez-ici</a>
              </small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Entrer</button>
        </div>

      </form>    
    </div>
  </div>
</div>