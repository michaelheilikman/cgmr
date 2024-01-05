<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'contact' ;
$subPage = 'all';
$Auth->allow('users');
$typeOfDoc = "user";
?>

<?php
    if(isset($_POST['user--submit'])){

    extract($_POST);

    $prenom         = addslashes($_POST['prenom']);
    $nom            = addslashes($_POST['nom']);
    $fonction       = addslashes($_POST['fonction']);
    if(isset($_POST['role_projet'])){
        $role           = $_POST['role_projet'];
        $role_projet    = implode('; ', $role);
        $role_projet    = addslashes($role_projet);
    }
    $mail           = $_POST['mail'];
    $password       = md5($password);
    $type           = $_POST['type'];
    $entreprise     = addslashes($_POST['entreprise']);
    $entreprise_id  = addslashes($_POST['entreprise_id']);
    $gouvernance    = addslashes($_POST['gouvernance']);
    $adresse        = addslashes($_POST['adresse']);
    $cp             = $_POST['cp'];
    $ville          = addslashes($_POST['ville']);
    $telFix         = $_POST['telFix'];
    $telMob         = $_POST['telMob'];
    $active         = 1;
    if($type =='admin'){
        $role_id    = 1;
    }elseif($type =='supAd'){
        $role_id    = 4;
    }else{
        $role_id    = 2;
    }


    $sql="INSERT INTO users (from_site,prenom,nom,fonction,role_projet,mail,password,passwordCheck,type,entreprise,entreprise_id,gouvernance,adresse,cp,ville,telFix,telMob,active,role_id) VALUES('$website','$prenom','$nom','$fonction','$role_projet','$mail','$password','$password','$type','$entreprise','$entreprise_id','$gouvernance','$adresse','$cp','$ville','$telFix','$telMob','$active','$role_id')";
    $query = $PDO->prepare($sql);
    $query->execute();

    header('location:contact.php');

    }
?>

<?php include 'includes/head.php'; ?>

 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

    

		<div class="container-fluid">
            <div class="box wrapper">
            
            <form action="" method="POST" id="signup-form">
			
			<div class="d-flex flex-wrap mx-4 px-4 bg-white rounded-lg">
                <div class="form-group col-sm-12">
					<div class="form-check form-check-inline mt-md-4">
					<?php if($Auth->user('role') =='superAdmin'): ?>
						<?php 
                            $sql = "SELECT * FROM roles WHERE id = 4 ORDER BY id ASC";
                            $query = $PDO->prepare($sql);
                            $query->execute();
                            while($type = $query->fetch(PDO::FETCH_OBJ)):
                        ?>
                            <input type="radio" name="type" id="<?= $type->slug ?>" value="<?= $type->slug ?>" class="form-check-input" required><label class="form-check-label mr-2" for="<?= $type->slug ?>"> <?= $type->name ?></label>
                        <?php endwhile; ?>
					<?php endif; ?>
                        <?php 
                            $sql = "SELECT * FROM roles WHERE id != 4 AND id != 3 ORDER BY id ASC";
                            $query = $PDO->prepare($sql);
                            $query->execute();
                            while($type = $query->fetch(PDO::FETCH_OBJ)):
                                if($type->name == 'contrib'){
                                    $type->name = 'Utilisateur';
                                }elseif($type->name == 'Administrateur') {
                                    $type->name = 'Contributeur';
                                }
                        ?>
                            <input type="radio" name="type" id="<?= $type->slug ?>" value="<?= $type->slug ?>" class="form-check-input" required><label class="form-check-label mr-2" for="<?= $type->slug ?>"> <?= $type->name ?></label>
                        <?php endwhile; ?>
                        <div class="col-12 invalid-feedback">
                            Merci de choisir un rôle utilisateur.
                        </div>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label>Prénom</label>
					<input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom" required>
                    <div class="invalid-feedback">
                        Le prénom ne doit pas rester vide.
                    </div>
				</div>
				<div class="form-group col-sm-6">
					<label>Nom</label>
					<input type="text" class="form-control" name="nom" placeholder="Entrez le nom" required>
                    <div class="invalid-feedback">
                        Le nom ne doit pas rester vide.
                    </div>
				</div>
			
				<div class="form-group col-sm-6">
					<label>Mail</label>
					<input type="text" class="form-control" name="mail" placeholder="Entrez une adresse mail" required>
                    <div class="invalid-feedback">
                    Merci de bien vouloir indiquer votre email.
                    </div>
                    <div class="valid-feedback">
                    Votre adresse mail est votre identifiant.
                    </div>
				</div>
				
				<div class="form-group col-sm-6">
                        <label>Mot de passe</label>
                        <div class="input-group show_hide_password">
						<input type="password" class="form-control" name="password" placeholder="Entrez un mot de passe" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                        </div>
                        <div class="invalid-feedback">
                            Merci de bien vouloir ajouter un mot de passe.
                        </div>
                    </div>
                    </div>

				<div class="form-group col-sm-12">
					<label>Rôle dans le projet <?php echo $website ?></label><br>
					<?php
						$sql = "SELECT * FROM actions WHERE from_site = '{$website}' ORDER BY action ASC";
				        $query = $PDO->prepare($sql);
				        $query->execute();
				        while($data = $query->fetch(PDO::FETCH_OBJ)):
					?>
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="role_projet[]" type="checkbox" id="<?php echo str_replace(' ','_',suppr_accents($data->action)) ?>" value="<?php echo $data->id ?>">
						<label class="form-check-label" for="<?php echo str_replace(' ','_',suppr_accents($data->action)) ?>"><?php echo $data->action ?></label>
					</div>
					<?php endwhile ?>
				</div>

				<div class="form-group col-sm-6">
					<label>Fonction</label>
					<input type="text" class="form-control" name="fonction" placeholder="Entrez la fonction" required>
                    <div class="invalid-feedback">
                        Merci de bien vouloir ajouter une fonction.
                    </div>
				</div>

                <div class="form-group col-sm-6"></div>

				<div class="form-group col-sm-12" id="companyOutput">
					<label><span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>Choisissez une entreprise</label>
                        <section class="d-flex">
                            <div class="pl-0 col-6">
                                <select name="entreprise" class="custom-select" id="entrepriseNew" required>
                                        <option value="">Choisissez votre entreprise...</option>
                                        <?php
                                        $sql = "SELECT * FROM entreprises WHERE from_site = '{$website}' ORDER BY entreprise ASC";
                                        $query = $PDO->prepare($sql);
                                        $query->execute();
                                        while($data = $query->fetch(PDO::FETCH_OBJ)){
                                        ?>
                                        <option value="<?php echo $data->entreprise ?>"
                                            data-idEntreprise ="<?= $data->id ?>"
                                            data-gouv ="<?= $data->gouvernance ?>"
                                            data-adresseEnt ="<?= $data->adresse ?>"
                                            data-cpEnt ="<?= $data->cp ?>"
                                            data-villeEnt ="<?= $data->ville ?>"
                                        ><?php echo $data->entreprise ?></option>
                                        <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Example invalid custom select feedback
                                </div>
                            </div>
                            <div class="pl-3">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#new-company" id="addNewEntrepriseBtn">Ajouter une entreprise</a>
                            </div>
                        </section>

                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
                <input type="hidden" name="entreprise_id" id="newEntId">
                <input type="hidden" name="adresse" id="newAdr">
                <input type="hidden" name="cp" id="newCp">
                <input type="hidden" name="ville" id="newVille">
                <input type="hidden" name="gouvernance" id="newGouv">

				<div class="form-group col-sm-6">
					<label>Téléphone Bureau</label>
					<input type="text" class="form-control" name="telFix" placeholder="Entrez le numéro de téléphone">
				</div>
				<div class="form-group col-sm-6">
					<label>Téléphone Mobile</label>
					<input type="text" class="form-control" name="telMob" placeholder="Entrez le numéro de téléphone">
				</div>
                   
                <div class="form-group col-sm-6">
                    <button class="btn btn-primary btn-std text-light" type="submit" name="user--submit" id="submitButton">Ajouter</button>
                </div>
			</div> <!-- / row -->

        </form>

            </div> <!-- box wrapper -->
	  	</div> <!-- / container-fluid -->

    </div> <!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->

<div class="modal fade" id="new-company" tabindex="-1" role="dialog" aria-labelledby="new-company" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-company">Ajouter une nouvelle entreprise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="row">
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Entreprise</label>
					<input  type="text" class="form-control" name="entreprise" placeholder="Entrez le nom de l'entreprise" id="companyName">
				</div>
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Gouvernance</label>
					<select class="form-control" name="gouvernance" id="selectGov">
						<option value="accompagnant">Accompagnants</option>
						<option value="partenaire">Partenaires</option>
						<option value="scientifique">Scientifiques</option>
						<option value="volontaire">Volontaires</option>
					</select>
				</div>


				<div class="form-group col-sm-5" style="padding: 0 10px;">
					<label>Adresse</label>
					<input type="text" class="form-control" name="adresse" placeholder="Entrez l'adresse" id="adresse">
				</div>
				<div class="form-group col-sm-3" style="padding: 0 10px;">
					<label>Code Postal</label>
					<input type="text" class="form-control" name="cp" placeholder="Entrez le nom" id="cp">
				</div>
				<div class="form-group col-sm-4" style="padding: 0 10px;">
					<label>Ville</label>
					<input type="text" class="form-control" name="ville" placeholder="Entrez le nom de la ville" id="ville">
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Numéro TVA</label>
					<input type="text" class="form-control" name="num_TVA" placeholder="Entrez le numéro de TVA" id="numTVA">
				</div>

                <?php
                    $sql = "SELECT * FROM entreprises ORDER BY id DESC LIMIT 1";
                    $query = $PDO->prepare($sql);
                    $query->execute();
                    $data = $query->fetch(PDO::FETCH_OBJ);
                        $nextID = $data->id + 1;
                    ?>
                    <div class="form-group">
                        <input type="hidden" value="<?= $nextID ?>" id="newCompId">
                    </div>

			</div> <!-- / row -->

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
        <button class="btn btn-primary" id="addNewCompany" data-website="<?= $website ?>" data-dismiss="modal">Ajouter</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="<?php echo $path ?>js/main.js"></script>
<script src="<?php echo $path ?>backoffice/js/crud.js"></script>

<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>        
</html>