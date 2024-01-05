<?php
if (isset($_POST['company--edit'])) {

extract($_POST);
$from_site = $website;
$entreprise = addslashes($_POST['entreprise']);
$gouvernance = addslashes($_POST['gouvernance']);
$adresse = addslashes($_POST['adresse']);
$cp = $_POST['cp'];
$ville = addslashes($_POST['ville']);
$num_TVA = $_POST['num_TVA'];

$sql = "UPDATE entreprises SET entreprise = '$entreprise', gouvernance = '$gouvernance',  adresse = '$adresse', cp = '$cp', ville = '$ville', num_TVA = '$num_TVA' WHERE id = $id ";
$query = $PDO->prepare($sql);
$query->execute();

$query = "UPDATE users SET entreprise = '$entreprise', gouvernance = '$gouvernance',  adresse = '$adresse', cp = '$cp', ville = '$ville' WHERE entreprise_id = $id ";
$query = $PDO->prepare($query);
$query->execute();

}
?>

<div class="modal fade" id="modif-comp" tabindex="-1" role="dialog" aria-labelledby="new-user" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fiche-entreprise"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
			<input type="hidden" name="id" value="" id="getConfigIdEnt">
			<div class="row">
				
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Entreprise</label>
					<input  type="text" class="form-control" name="entreprise" placeholder="Entrez le nom de l'entreprise" id="getEntreprise">
				</div>

				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Gouvernance</label>
					<select class="form-control" name="gouvernance">
						<option value="" id="getGouv"></option>
						<option value="partenaire">Partenaires</option>
						<option value="scientifique">Scientifiques</option>
						<option value="accompagnant">Accompagnants</option>
						<option value="volontaire">Volontaires</option>
					</select>
				</div>

				<div class="form-group col-sm-5" style="padding: 0 10px;">
					<label>Adresse</label>
					<input type="text" class="form-control" name="adresse" placeholder="Entrez l'adresse" id="getAdr">
				</div>
				<div class="form-group col-sm-3" style="padding: 0 10px;">
					<label>Code Postal</label>
					<input type="text" class="form-control" name="cp" placeholder="Entrez le code postal" id="getCp">
				</div>
				<div class="form-group col-sm-4" style="padding: 0 10px;">
					<label>Ville</label>
					<input type="text" class="form-control" name="ville" placeholder="Entrez le nom de la ville" id="getVille">
				</div>
				
				<div class="form-group col-sm-6" style="padding: 0 10px;">
					<label>Numéro de TVA</label>
					<input type="text" class="form-control" name="num_TVA" placeholder="Entrez le numéro de TVA" id="getTVA">
				</div>
			</div> <!-- / row -->

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
        <button class="btn btn-primary" type="submit" name="company--edit">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="entFiche" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="getFiche-entreprise">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ion-icon name="business" class="d-inline-block mr-2" style="font-size:22px;position: relative;top:2px;"></ion-icon><h6 id="get-entreprise" class="d-inline-block font-weight-bold" style="font-size:1.5em"></h6>

        <p id="getFiche-adresseEnt"></p>
        <p>Numéro de TVA : <span id="getFiche-TVA"></span></p>
      </div>
    </div>
  </div>
</div>