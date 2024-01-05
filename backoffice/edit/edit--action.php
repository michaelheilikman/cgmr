<?php
if (isset($_POST['action--edit'])) {

extract($_POST);
$from_site = $website;
$action = addslashes($_POST['action']);
$roleProjet = addslashes($_POST['role']);

$sql = "UPDATE actions SET action = '$action' WHERE id = $id ";
$query = $PDO->prepare($sql);
$query->execute();

$req = "UPDATE users SET role_projet = REPLACE(role_projet,'{$roleProjet}' , '{$action}') WHERE role_projet = role_projet";
$query = $PDO->prepare($req);
$query->execute();

}
?>

<div class="modal fade" id="modif-action" tabindex="-1" role="dialog" aria-labelledby="new-user" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fiche-action"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
			<input type="hidden" name="id" value="" id="getConfigIdAction">
			<div class="row">
				
				<div class="form-group col-12" style="padding: 0 10px;">
					<label>Role</label>
					<input  type="text" class="form-control" name="action" placeholder="Entrez le role" id="getAction">
				</div>
				<input type="hidden" name="role" id="getActionRole">

			</div> <!-- / row -->

      </div> <!-- / modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
        <button class="btn btn-primary" type="submit" name="action--edit">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>