<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'docs' ;
$subPage = 'keywords' ;
$Auth->allow('users');
$typeOfDoc = "outil";
$parent_id = 1;
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
                <th class="text-light">Titre</th>
                <th class="text-light">Date</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM keywords WHERE from_site= '$website' ORDER BY key_id DESC";
              $query = $PDO->prepare($sql);
              $query->execute();
              while($data = $query->fetch(PDO::FETCH_OBJ)):
              ?>
              <tr>
                <td style="line-height:20px" class="actuTitle">
                    
                    <p class="text-dark mb-0 pb-0" id="keyName<?= $data->key_id ?>" title="<?php echo $data->key_name ?>"><?php echo $data->key_name ?></p>

                    <div class="form-inline d-none" id="formCategory<?php echo $data->key_id ?>">
                        <input type="text" class="form-control w-75" value="<?php echo $data->key_name ?>">
                        <a href="#" class="changeKeyword btn btn-success ml-2" data-id="<?php echo $data->key_id ?>">Modifier</a>
                    </div>


                    <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                      <small class="mt-0 pt-0">
                        <a href="#" class="modifCategory"><span class="">Modifier</span><span class="d-none">Annuler</span></a> | 
                        <a href="#" class="suppr_key text-danger" id="<?php echo $data->key_id ?>" data-name ="<?= $data->key_name ?>" data-toggle="modal" data-target="#supprimer">corbeille</a></small>
                    <?php } ?>
                </td>
                <td style="line-height:20px">
                    <p><?php echo $data->key_date ?></p>
                </td>
              </tr>
              <?php endwhile ; ?>
            </tbody>
            <tfoot class="bg-secondary">
                <td class="text-light">Titre</td>
                <td class="text-light">Date</td>
            </tfoot>
        </table>

	    </div> <!-- box wrapper -->
      </div> <!-- container-fluid -->
    </div><!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->


<script type="text/javascript" src="<?php echo $path ?>backoffice/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $path ?>backoffice/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $path ?>backoffice/js/bootstrap.js"></script>
<script src="<?php echo $path ?>backoffice/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $path ?>backoffice/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="js/crud.js"></script>

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

<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>


<div class="modal fade" id="new-key" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau mot-clé</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Mot-clé" id="newKeyword">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <?php
            date_default_timezone_set('Europe/Paris');
            $now = date("Y-m-d H:i:s");
        ?>
        <button type="button" class="btn btn-success" id="addNewKeyword" data-website="<?= $website ?>" data-now="<?php echo $now ?>">Sauvegarder</button>
      </div>
    </div>
  </div>
</div>





</body>        
</html>