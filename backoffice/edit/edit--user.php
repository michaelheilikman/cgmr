<?php
if (isset($_POST['user--edit'])) {

extract($_POST);
$from_site = $website;
$prenom = addslashes($_POST['prenom']);
$nom = addslashes($_POST['nom']);
$fonction = addslashes($_POST['fonction']);
$role = $_POST['role_projet'];
$role_projet = implode('; ', $role);
$mail = $_POST['mail'];
$type = $_POST['type'];
$entreprise = addslashes($_POST['entreprise']);
$entreprise_id = addslashes($_POST['entreprise_id']);
$gouvernance = addslashes($_POST['gouvernance']);
$adresse = addslashes($_POST['adresse']);
$cp = $_POST['cp'];
$ville = addslashes($_POST['ville']);
$telFix = $_POST['telFix'];
$telMob = $_POST['telMob'];

if($type ==='admin'){
	$role_id = 1;
}elseif($type ==='supAd'){
	$role_id = 4;
}else{
	$role_id = 2;
}

$sql = "UPDATE users SET entreprise = '$entreprise',entreprise_id = '$entreprise_id',gouvernance = '$gouvernance', prenom = '$prenom', nom = '$nom', mail = '$mail',type = '$type', role_id = '$role_id', role_projet = '$role_projet', fonction = '$fonction', from_site = '$from_site', adresse = '$adresse', cp = '$cp', ville = '$ville', telFix = '$telFix', telMob = '$telMob' WHERE id = $id ";
$query = $PDO->prepare($sql);
$query->execute();

}
?>

<div class="modal fade" id="modifier" tabindex="-1" role="dialog" aria-labelledby="new-user" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fiche-user"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
			<input type="hidden" name="id" value="" id="getConfigID">
			<div class="row">
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Prénom</label>
					<input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom" id="getUser-prenom">
				</div>
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Nom</label>
					<input type="text" class="form-control" name="nom" placeholder="Entrez le nom" id="getUser-nom">
				</div>
			
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Mail</label>
					<input type="text" class="form-control" name="mail" placeholder="Entrez le prénom" id="getUser-mail">
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Fonction</label>
					<input type="text" class="form-control" name="fonction" placeholder="Entrez la fonction" id="getUser-fonction">
				</div>

				<div class="form-group col-sm-12" style="padding: 0 10px;">
					<label>Rôle dans le projet <?php echo $website ?></label><br>
					<?php
						$sql = "SELECT * FROM actions WHERE from_site = '{$website}' ORDER BY action ASC";
				        $query = $PDO->prepare($sql);
				        $query->execute();
				        while($data = $query->fetch(PDO::FETCH_OBJ)){
					?>
					<div class="form-check form-check-inline">
						<input class="form-check-input getUser-role" name="role_projet[]" type="checkbox" id="<?php echo str_replace(' ','',suppr_accents($data->action)) ?>Edit" value="<?php echo $data->id ?>">
						<label class="form-check-label" for="<?php echo str_replace(' ','',suppr_accents($data->action)) ?>Edit"><?php echo $data->action ?></label>
					</div>
					<?php } ?>
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Entreprise</label>
					<select name="entreprise" class="form-control" id="entrepriseEdit">
						<option value="" id="getUser-work"></option>
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
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;margin-top: 8px">
					<div class="form-check form-check-inline mt-md-4">
					<?php if($Auth->user('role') =='superAdmin'): ?>
						<input type="radio" name="type" id="supAd" value="" class="form-check-input getUser-type">
						<label class="form-check-label mr-2" for="supAd"> administrateur</label>
					<?php endif; ?>
						<input type="radio" name="type" id="admin" value="" class="form-check-input getUser-type">
						<label class="form-check-label mr-2" for="admin"> contributeur</label>
						<input type="radio" name="type" id="autre" value="" class="form-check-input getUser-type">
						<label class="form-check-label mr-2" for="autre"> utilisateur</label>
					</div>
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Gouvernance</label>
					<input class="form-control editGouv" type="text" name="gouvernance" placeholder="Gouvernance" id="getUser-gouv" >
				</div>
				<div class="col-sm-6">
					<input class="editEntId" type="hidden" name="entreprise_id" id="getUser-entId">
				</div>


				<div class="form-group col-sm-5" style="padding: 0 10px;">
					<label>Adresse</label>
					<input type="text" class="form-control editAdr" name="adresse" placeholder="Entrez l'adresse" id="getUser-adr">
				</div>
				<div class="form-group col-sm-3" style="padding: 0 10px;">
					<label>Code Postal</label>
					<input type="text" class="form-control editCp" name="cp" placeholder="Entrez le code postal" id="getUser-cp">
				</div>
				<div class="form-group col-sm-4" style="padding: 0 10px;">
					<label>Ville</label>
					<input type="text" class="form-control editVille" name="ville" placeholder="Entrez le nom de la ville" id="getUser-ville">
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Téléphone Bureau</label>
					<input type="text" class="form-control" name="telFix" placeholder="Entrez le numéro de téléphone" id="getUser-fix">
				</div>
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Téléphone Mobile</label>
					<input type="text" class="form-control" name="telMob" placeholder="Entrez le numéro de téléphone" id="getUser-mob">
				</div>
			</div> <!-- / row -->

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
        <button class="btn btn-primary" type="submit" name="user--edit">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="userFiche" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="getFiche-user">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0">
        <ion-icon name="business" class="d-inline-block mr-2" style="font-size:22px;position: relative;top:2px;"></ion-icon><h6 id="getFiche-work" class="d-inline-block font-weight-bold" style="font-size:1.5em"></h6>

        <p id="getFiche-adresse"></p>
        <p><ion-icon name="ios-mail" class="mr-2 text-dark" style="font-size:22px;position: relative;top:6px;"></ion-icon><a href="" id="getFiche-mail" class="text-dark"></a></p>

        <ion-icon name="ios-call" class="d-inline-block mr-2 text-dark telBureau" style="font-size:22px;position: relative;top:6px;"></ion-icon><p id="getFiche-fix" class="d-inline-block"></p>
        <ion-icon name="ios-phone-portrait" class="d-inline-block ml-3 mr-0 text-dark telMobile" style="font-size:22px;position: relative;top:6px;"></ion-icon><p id="getFiche-mob" class="d-inline-block"></p>
      </div>
    </div>
  </div>
</div>