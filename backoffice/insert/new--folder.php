<?php
if(isset($_POST['folder--submit'])){

extract($_POST);

@$from_site = $website;
@$name = addslashes($_POST["name"]);
@$folderType = addslashes($_POST["folderType"]);
@$created_by = $Auth->user('prenom').' '.$Auth->user('nom');

if($page != "colloque") {
	@$toolTarget = $folderType;
}else{
	@$toolTarget = addslashes($_POST["toolTarget"]);
}
@$fileDate = $_POST["fileDate"];


$sql="INSERT INTO docs(name,folderType,toolTarget,from_site,fileDate,created_by,parent_id) VALUES('$name','$folderType','$toolTarget','$from_site','$fileDate','$created_by','$parent_id')";
	$query = $PDO->prepare($sql);
	$query->execute();
}

?>
<!-- Modal -->
<div class="modal fade" id="new-folder" tabindex="-1" role="dialog" aria-labelledby="new-folder" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-folder">Ajouter un nouveau dossier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="row">
			<input type="hidden" name="parent_id" value="<?php echo $parent_id ?>">
			<div class="form-group col-sm-6" style="padding: 0 10px">
				<label>Nom du dossier</label>
				<input type="text" name="name" placeholder="Entrez le nom du dossier" class="form-control">
			</div>
			
			<?php if($page == 'colloque'){ ?>
				<div class="form-group col-sm-6" style="padding: 0 10px">
		          <label>Date du colloque</label>
		  				<input type="text" name="fileDate" class="datetimepicker form-control" placeholder="Date">
		        </div>
	    	<?php } ?>

			<div class="form-group col-sm-6" style="padding: 0 10px">
				<label>&nbsp;</label>
				<select class="form-control" name="folderType">
					
					<!-- <option value="antibio">Surveillance des usages d’antibiotique et de la résistance</option>
					<option value="formation">Outils de formation - promotion des bonnes pratiques</option>
					<option value="sanitaire">Pratiques de prévention sanitaire</option>
					<option value="medicale">Pratiques de prévention médicale</option>
					<option value="surveillance">Détection et surveillance des maladies</option>
					<option value="alternative">Alternatives aux antibiotiques</option> -->
					<option value="reunion">Nouveau Dossier</option>
					
				</select>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary d-col-12 t-col-12 m-col-12 mt-10" type="submit" name="folder--submit">Sauvegarder</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
		</form>
      </div>
    </div>
  </div>
</div>