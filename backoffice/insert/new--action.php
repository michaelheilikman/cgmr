<?php
if(isset($_POST['action--submit'])){

extract($_POST);
$from_site = $website;
$action = addslashes($_POST['action']);

$sql="INSERT INTO actions (from_site,action) VALUES('$from_site','$action')";
$query = $PDO->prepare($sql);
$query->execute();

}
?>

<div class="modal fade" id="new-action" tabindex="-1" role="dialog" aria-labelledby="new-action" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-action">Ajouter un nouveau rôle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
			
			<div class="row">
				<div class="form-group col-sm-12" style="padding: 0 10px;">
					<label>Rôle :</label>
					<input  type="text" class="form-control" name="action" placeholder="Entrez un nouveau role">
				</div>
			</div> <!-- / row -->

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button class="btn btn-info" type="submit" name="action--submit">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>