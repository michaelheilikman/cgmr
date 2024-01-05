<?php
if (isset($_POST['folder--edit']) && $_POST['folder--edit'] == 'modifier le dossier') {

//extract($_POST);

@$name = addslashes($_POST['name']);
@$fileDate = addslashes($_POST['fileDate']);
@$toolTarget = addslashes($_POST['toolTarget']);
@$idZ = $_POST['id'];

$sql = "UPDATE docs SET name = '$name', fileDate = '$fileDate', toolTarget = '$toolTarget' WHERE id = $idZ ";
$query = $PDO->prepare($sql);
$query->execute();

}


?>


<!-- Modal -->
<div class="modal fade modalEdition" id="modifier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modifier le dossier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
	      <div class="modal-body">
	        <input type="hidden" name="id" value="" id="getConfigID">
			
			<div class="form-group col-sm-12" style="padding: 0 10px">
	  			 <label>Nom du dossier</label><br>
	  			 <textarea name="name" id="getFolderName" class="form-control"></textarea>
	        </div>

	        <?php if ($page == "colloque") { ?>
	        	<div class="form-group col-sm-12" style="padding: 0 10px">
		          <label>Date du colloque</label>
		  				<input type="text" name="fileDate" class="datetimepicker form-control" placeholder="Date" id="getFolderDate" value="">
		        </div>
	        <?php } ?>

	        	<div class="form-group col-sm-6" style="padding: 0 10px">
				<label>Type de document</label>
				<select class="form-control" name="toolTarget">
					
					<option value="reunion">Dossier</option>
					<!-- <option value="presse">presse</option>
					<option value="cs">Conseil scientifique</option>
					<option value="these">Thèse</option>
					<option value="biblio">Bibliographie</option> -->
					<!-- <option value="energy">Energie</option>
					<option value="gaz">Gaz</option>
					<option value="effluent">Effluent</option>
					<option value="eau">Eau</option>
					<option value="recycle">Recyclage</option> -->
				</select>
			</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	        <button type="submit" class="btn btn-primary" name="folder--edit" value="modifier le dossier">Sauvegarder</button>
	      </div>
      </form>
    </div>
  </div>
</div>