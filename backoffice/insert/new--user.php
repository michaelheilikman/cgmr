<?php
if(isset($_POST['user--submit'])){

extract($_POST);

$from_site = $website;
$prenom = addslashes($_POST['prenom']);
$nom = addslashes($_POST['nom']);
$fonction = addslashes($_POST['fonction']);
$role = $_POST['role_projet'];
$role_projet = implode('; ', $role);
$role_projet = addslashes($role_projet);
$mail = $_POST['mail'];
$password = md5($password);
$type = $_POST['type'];
$entreprise = addslashes($_POST['entreprise']);
$entreprise_id = addslashes($_POST['entreprise_id']);
$gouvernance = addslashes($_POST['gouvernance']);
$adresse = addslashes($_POST['adresse']);
$cp = $_POST['cp'];
$ville = addslashes($_POST['ville']);
$telFix = $_POST['telFix'];
$telMob = $_POST['telMob'];
$active    = 1;
if($type =='admin'){
	$role_id = 1;
}elseif($type =='supAd'){
	$role_id = 4;
}else{
	$role_id = 2;
}


$sql="INSERT INTO users (from_site,prenom,nom,fonction,role_projet,mail,password,passwordCheck,type,entreprise,entreprise_id,gouvernance,adresse,cp,ville,telFix,telMob,active,role_id) VALUES('$from_site','$prenom','$nom','$fonction','$role_projet','$mail','$password','$password','$type','$entreprise','$entreprise_id','$gouvernance','$adresse','$cp','$ville','$telFix','$telMob','$active','$role_id')";
$query = $PDO->prepare($sql);
$query->execute();

}
?>

<div class="modal fade" id="new-user" tabindex="-1" role="dialog" aria-labelledby="new-user" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-user">Ajouter un nouvel utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
			
			<div class="row">
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Prénom</label>
					<input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom">
				</div>
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Nom</label>
					<input type="text" class="form-control" name="nom" placeholder="Entrez le nom">
				</div>
			
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Mail</label>
					<input type="text" class="form-control" name="mail" placeholder="Entrez une adresse mail">
				</div>
				
				<div class="form-group col-sm-6" style="padding: 0 10px;">
                        <label>Mot de passe</label>
                        <div class="input-group show_hide_password">
						<input type="password" class="form-control" name="password" placeholder="Entrez un mot de passe">
                            <div class="input-group-append">
							<span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
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
						<input class="form-check-input" name="role_projet[]" type="checkbox" id="<?php echo str_replace(' ','_',suppr_accents($data->action)) ?>" value="<?php echo $data->id ?>">
						<label class="form-check-label" for="<?php echo str_replace(' ','_',suppr_accents($data->action)) ?>"><?php echo $data->action ?></label>
					</div>
					<?php } ?>
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Fonction</label>
					<input type="text" class="form-control" name="fonction" placeholder="Entrez la fonction">
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;margin-top: 8px">
					<div class="form-check form-check-inline mt-md-4">
					<?php if($Auth->user('role') =='superAdmin'): ?>
						<input type="radio" name="type" id="supAd" value="supAd" class="form-check-input"><label class="form-check-label mr-2" for="supAd"> administrateur</label>
					<?php endif; ?>
						<input type="radio" name="type" id="admin" value="admin" class="form-check-input"><label class="form-check-label mr-2" for="admin"> contributeur</label>
						<input type="radio" name="type" id="autre" value="autre" class="form-check-input"><label class="form-check-label mr-2" for="autre"> utilisateur</label>
					</div>
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Entreprise</label>
					<select name="entreprise" class="form-control" id="entrepriseNew">
						<option>Choisissez une entreprise</option>
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
				
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Gouvernance</label>
					<input class="form-control" type="text" name="gouvernance" placeholder="Gouvernance" id="newGouv">
				</div>
				<input type="hidden" name="entreprise_id" id="newEntId">


				<div class="form-group col-sm-5" style="padding: 0 10px;">
					<label>Adresse</label>
					<input type="text" class="form-control" name="adresse" placeholder="Entrez l'adresse" id="newAdr">
				</div>
				<div class="form-group col-sm-3" style="padding: 0 10px;">
					<label>Code Postal</label>
					<input type="text" class="form-control" name="cp" placeholder="Entrez le nom" id="newCp">
				</div>
				<div class="form-group col-sm-4" style="padding: 0 10px;">
					<label>Ville</label>
					<input type="text" class="form-control" name="ville" placeholder="Entrez le nom de la ville" id="newVille">
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Téléphone Bureau</label>
					<input type="text" class="form-control" name="telFix" placeholder="Entrez le numéro de téléphone">
				</div>
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Téléphone Mobile</label>
					<input type="text" class="form-control" name="telMob" placeholder="Entrez le numéro de téléphone">
				</div>
			</div> <!-- / row -->

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
        <button class="btn btn-primary" type="submit" name="user--submit">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>