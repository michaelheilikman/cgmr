<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'contact' ;
$subPage = 'entreprise';
$Auth->allow('users');
$typeOfDoc = "contact";
?>

<?php include 'includes/head.php'; ?>



<?php include "remove/del--file.php" ?>

 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

		<div class="container-fluid">
		<div class="box wrapper mt-5">
		
        <table id="pages" class="table table-striped table-light w-100">
            <thead class="bg-dark">
                <th class="text-light">Entreprises</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM entreprises WHERE from_site= '$website'";
              $query = $PDO->prepare($sql);
              $query->execute();
              while($data = $query->fetch(PDO::FETCH_OBJ)):
              ?>
              <tr>
                <td style="line-height:20px" class="actuTitle">
                    <p class="text-dark mb-0 pb-0" title="<?php echo $data->entreprise ?>"><?php echo $data->entreprise ?></p>
                    <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                      <small class="mt-0 pt-0"><a href="entrepriseSingle.php?id=<?php echo $data->id ?>">Modifier</a> | <a href="#" class="suppr_company text-danger" id="<?php echo $data->id ?>" data-name ="<?= $data->entreprise ?>" data-toggle="modal" data-target="#supprimer">corbeille</a></small>
                    <?php } ?>
                </td>
              </tr>
              <?php endwhile ; ?>
            </tbody>
            <tfoot class="bg-secondary">
                <td class="text-light">Entreprises</td>
            </tfoot>
        </table>

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
                    if(isset($data->id)):
                        $nextID = $data->id + 1;
                    else:
                        $nextID = 0 + 1;
                    endif;
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


<script src="<?php echo $path ?>backoffice/js/jquery.js"></script>
<script src="<?php echo $path ?>backoffice/js/jquery-ui.js"></script>
<script src="<?php echo $path ?>backoffice/js/bootstrap.js"></script>
<script src="<?php echo $path ?>backoffice/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $path ?>backoffice/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $path ?>js/main.js"></script>
<script src="<?php echo $path ?>backoffice/js/crud.js"></script>

<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<script>
$(document).ready(function() {
    $('#pages').DataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Tout"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
} );
</script>







</body>        
</html>