<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'contact' ;
$subPage = 'all';
$Auth->allow('users');
$typeOfDoc = "user";
?>



<?php include 'includes/head.php'; ?>

<?php
  $sql = "SELECT * FROM users WHERE from_site='$website' AND id={$_GET['id']}";
  $query = $PDO->prepare($sql);
  $query->execute();
  $data = $query->fetch(PDO::FETCH_OBJ);
  $id = $_GET['id'];

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


    $sql = "UPDATE users SET prenom='$prenom', nom='$nom', fonction='$fonction', role_projet='$role_projet', mail='$mail', type='$type', entreprise='$entreprise', entreprise_id='$entreprise_id', gouvernance='$gouvernance', adresse='$adresse', cp='$cp', ville='$ville', telFix='$telFix', telMob='$telMob', role_id='$role_id' WHERE id = $id";
    $query = $PDO->prepare($sql);
    $query->execute();

    header('location:userEdit.php?id='.$id);

    }
?>


 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

    

		<div class="container-fluid">
            <div class="box wrapper">
            
            <form action="" method="POST">
			
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
                            <input type="radio" name="type" id="<?= $type->slug ?>" value="<?= $type->slug ?>" class="form-check-input" <?php if($type->id == $data->role_id){echo 'checked';} ?>><label class="form-check-label mr-2" for="<?= $type->slug ?>"> <?= $type->name ?></label>
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
                            <input type="radio" name="type" id="<?= $type->slug ?>" value="<?= $type->slug ?>" class="form-check-input" <?php if($type->id == $data->role_id){echo 'checked';} ?>><label class="form-check-label mr-2" for="<?= $type->slug ?>"> <?= $type->name ?></label>
                        <?php endwhile; ?>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label>Prénom</label>
					<input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom" value="<?= $data->prenom ?>">
				</div>
				<div class="form-group col-sm-6">
					<label>Nom</label>
					<input type="text" class="form-control" name="nom" placeholder="Entrez le nom" value="<?= $data->nom ?>">
				</div>
			
				<div class="form-group col-sm-6">
					<label>Mail</label>
					<input type="text" class="form-control" name="mail" placeholder="Entrez une adresse mail" value="<?= $data->mail ?>">
				</div>
				
			

				<div class="form-group col-sm-12">
					<label>Rôle dans le projet <?php echo $website ?></label><br>
					<?php

                        $roles = $data->role_projet;
                        $role = explode('; ',$roles);
                        $countRoles = count($role);
                                                
						$sql = "SELECT * FROM actions WHERE from_site = '{$website}' ORDER BY action ASC";
				        $query = $PDO->prepare($sql);
				        $query->execute();
				        $actions = $query->fetchAll(PDO::FETCH_OBJ);
                        
                        foreach ($actions as $action):

                        
					?>
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="role_projet[]" type="checkbox" id="<?php echo str_replace(' ','_',suppr_accents($action->action)) ?>" value="<?php echo $action->id ?>"
                        <?php 
                        for ($i=0; $i < $countRoles ; $i++):
                            if($role[$i] == $action->id):
                                echo 'checked';
                            endif;
                        endfor;
                        ?>>
						<label class="form-check-label" for="<?php echo str_replace(' ','_',suppr_accents($action->action)) ?>"><?php echo $action->action ?></label>
					</div>
					<?php endforeach ?>
				</div>

				<div class="form-group col-sm-6">
					<label>Fonction</label>
					<input type="text" class="form-control" name="fonction" placeholder="Entrez la fonction" value="<?= $data->fonction ?>">
				</div>

                <div class="form-group col-sm-6"></div>

				<div class="form-group col-sm-12" id="companyOutput">
					<label><span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>Choisissez une entreprise</label>
                        <section class="d-flex">
                            <div class="pl-0 col-6">
                                <select name="entreprise" class="form-control" id="entrepriseNew">
                                        <!-- <option data-idEntreprise="<?= $data->entreprise_id ?>" data-gouv="<?= $data->gouvernance ?>" data-adresseEnt="<?= $data->adresse ?>" data-cpEnt="<?= $data->cp ?>" data-villeEnt="<?= $data->ville ?>"><?= $data->entreprise ?></option> -->
                                        <?php
                                        $sql = "SELECT * FROM entreprises WHERE from_site = '{$website}' ORDER BY entreprise ASC";
                                        $query = $PDO->prepare($sql);
                                        $query->execute();
                                        while($inc = $query->fetch(PDO::FETCH_OBJ)){
                                        ?>
                                        <option value="<?php echo $inc->entreprise ?>"
                                            data-idEntreprise ="<?= $inc->id ?>"
                                            data-gouv ="<?= $inc->gouvernance ?>"
                                            data-adresseEnt ="<?= $inc->adresse ?>"
                                            data-cpEnt ="<?= $inc->cp ?>"
                                            data-villeEnt ="<?= $inc->ville ?>" <?php if($data->entreprise_id == $inc->id){echo 'selected';} ?>
                                        ><?php echo $inc->entreprise ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="pl-3">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#new-company" id="addNewEntrepriseBtn">Ajouter une entreprise</a>
                            </div>
                        </section>

                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
                <input type="hidden" name="entreprise_id" id="newEntId" value="<?= $data->entreprise_id ?>">
                <input type="hidden" name="adresse" id="newAdr" value="<?= $data->adresse ?>">
                <input type="hidden" name="cp" id="newCp" value="<?= $data->cp ?>">
                <input type="hidden" name="ville" id="newVille" value="<?= $data->ville ?>">
                <input type="hidden" name="gouvernance" id="newGouv" value="<?= $data->gouvernance ?>">

				<div class="form-group col-sm-6">
					<label>Téléphone Bureau</label>
					<input type="text" class="form-control" name="telFix" placeholder="Entrez le numéro de téléphone" value="<?= $data->telFix ?>">
				</div>
				<div class="form-group col-sm-6">
					<label>Téléphone Mobile</label>
					<input type="text" class="form-control" name="telMob" placeholder="Entrez le numéro de téléphone" value="<?= $data->telMob ?>">
				</div>
                   
                <div class="form-group col-sm-6">
                    <button class="btn btn-primary btn-std text-light" type="submit" name="user--submit">Ajouter</button>
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


<script src="<?php echo $path ?>js/jquery.js"></script>
<script src="<?php echo $path ?>js/jquery-ui.js"></script>
<script src="<?php echo $path ?>js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="<?php echo $path ?>js/main.js"></script>
<script src="<?php echo $path ?>backoffice/js/crud.js"></script>

</body>        
</html>