<?php
if(isset($_POST['inscrit--submit'])){

function clean_text($string){
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

extract($_POST);
@$from_site 	= $website;
@$civilite 		= $_POST['civilite'];
@$prenom 		= clean_text($_POST['prenom']);
@$nom 			= clean_text($_POST['nom']);
@$entreprise 	= clean_text($_POST['entreprise']);
@$adresse 		= clean_text($_POST['adresse']);
@$cp 			= clean_text($_POST['cp']);
@$ville 		= clean_text($_POST['ville']);
@$telFix 		= clean_text($_POST['telFix']);
@$email 		= clean_text($_POST['email']);
@$ordinal 		= clean_text($_POST['ordinal']);
@$tva 			= clean_text($_POST['tva']);
@$adherent 		= $_POST['adherent'];
@$participation = $_POST['participation'];
@$cotisation 	= $_POST['cotisation'];
@$soiree 		= $_POST['soiree'];
@$paiement 		= $_POST['paiement'];

if($cotisation != 'oui'){
	$cotisation = 'non';
}


$sql="INSERT INTO participants (from_site,civilite,prenom,nom,email,ordinal,tva,entreprise,adresse,cp,ville,telFix,adherent,cotisation,participation,soiree,paiement) VALUES ('$from_site','$civilite','$prenom','$nom','$email','$ordinal','$tva','$entreprise','$adresse','$cp','$ville','$telFix','$adherent','$cotisation','$participation','$soiree','$paiement')";
$query = $PDO->prepare($sql);
$query->execute();

}
?>

<div class="modal fade" id="new-inscrit" tabindex="-1" role="dialog" aria-labelledby="new-inscrit" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-inscrit">Ajouter un nouveau participant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="row">
			
			<div class="form-group col-12">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="madame" name="civilite" value="Madame">
					  <label class="form-check-label" for="madame">Madame</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="monsieur" name="civilite" value="Monsieur">
					  <label class="form-check-label" for="monsieur">Monsieur</label>
					</div>
				</div>
				<div class="form-group col-12 col-md-6">
					<label>Prénom</label>
					<input type="text" name="prenom" placeholder="Prénom" class="form-control" value="" />
				</div>
				<div class="form-group col-12 col-md-6">
					<label>Nom</label>
					<input type="text" name="nom" placeholder="Nom" class="form-control" value="" />
				</div>
				<div class="form-group col-12 col-md-12">
					<label>Entreprise</label>
					<input type="text" name="entreprise" placeholder="Entreprise" class="form-control" value="" />
				</div>

				<div class="form-group col-12 col-md-5">
					<label>Adresse</label>
					<input type="text" name="adresse" placeholder="Adresse" class="form-control" value="" />
				</div>
				<div class="form-group col-12 col-md-3">
					<label>CP</label>
					<input type="text" name="cp" placeholder="CP" class="form-control" value="" />
				</div>
				<div class="form-group col-12 col-md-4">
					<label>Ville</label>
					<input type="text" name="ville" placeholder="Ville" class="form-control" value="" />
				</div>
				<div class="form-group col-12 col-md-6">
					<label>Téléphone</label>
					<input type="text" name="telFix" class="form-control" placeholder="Téléphone" value="" />
				</div>
				<div class="form-group col-12 col-md-6">
					<label>Email</label>
					<input type="text" name="email" class="form-control" placeholder="Email" value="" />
				</div>
				<div class="form-group col-12 col-md-6">
					<label>N° Ordinal</label>
					<input type="text" name="ordinal" class="form-control" placeholder="N° Ordinal" value=""/>
				</div>
				<div class="form-group col-12 col-md-6">
					<label>N° TVA ou SIRET</label>
					<input type="text" name="tva" class="form-control" placeholder="N°TVA ou SIRET" value=""/>
				</div>

			
			<fieldset class="form-group border border-secondary mt-4 mt-md-2 px-0 mx-3 w-100">
				<legend class="col-12 col-md-5 ml-2">Inscription au congrès AFMVP</legend>
			<div class="form-group px-3">
				<label>Je suis adhérent de l'Association Française de Médecine Vétérinaire Porcine ?</label><br>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="adherent" name="adherent" value="oui">
				  <label class="form-check-label" for="adherent">oui</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="non_adherent" name="adherent" value="non">
				  <label class="form-check-label" for="non_adherent">non</label>
				</div>
			</div>
			<div class="form-group px-3" id="congresAdherent">
				<label>Je participe au congrès de l'AFMVP 2019 ?</label>&nbsp;&nbsp;&nbsp;
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="oneDay" name="participation" value="1_jour_adherent">
				  <label class="form-check-label" for="oneDay">1 jour - 150 €</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="twoDays" name="participation" value="2_jours_adherent">
				  <label class="form-check-label" for="twoDays">2 jours - 200 €</label>
				</div>

				<div class="form-check">
				  <input class="form-check-input" type="radio" id="cotisation" name="cotisation" value="oui">
				  <label class="form-check-label" for="cotisation">et je paie ma cotisation à l'AFMVP de 60 €</label>
				</div>
			</div>
			<div class="form-group px-3" id="congresNonAdherent">
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="twoDaysNA" name="participation" value="2_jours_non_adherent">
				  <label class="form-check-label" for="twoDaysNA">&nbsp;&nbsp;&nbsp;Je participe aux 2 jours du congrès de l'AFMVP - 260 €</label>
				</div>
				
			</div>
			<div class="form-group px-3" id="soiree">
				<label>Je désire participer à la soirée du 12 décembre 2019 pour un montant de 30 € ?</label><br>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="soireeYes" name="soiree" value="oui">
				  <label class="form-check-label" for="soireeYes">Oui</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="soireeNo" name="soiree" value="non">
				  <label class="form-check-label" for="soireeNo">Non</label>
				</div>
			</div>
			</fieldset>

			<div class="form-group col-12 col-md-12">
				<label>Mode de paiement :</label><br>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="paiement" id="cb" value="cb">
				  <label class="form-check-label" for="cb">Carte Bleue</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="paiement" id="cheque" value="cheque">
				  <label class="form-check-label" for="cheque">Chèque</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="paiement" id="bank" value="bank">
				  <label class="form-check-label" for="bank">Virement bancaire</label>
				</div>
			</div>

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="submit" name="inscrit--submit" id="cb-pay" class="btn btn-info ">Inscription CB</button>
		<button type="submit" name="inscrit--submit" id="cheque-pay" class="btn btn-info">Inscription chèque</button>
		<button type="submit" name="inscrit--submit" id="bank-pay" class="btn btn-info ">Inscription virement bancaire</button>
		<button type="button" class="btn btn-primary" data-dismiss="modal">fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>