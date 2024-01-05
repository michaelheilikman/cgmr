<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'contact' ;
$subPage = 'all';
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
                <th class="text-light">Nom</th>
                <th class="text-light">Entreprise</th>
                <th class="text-light">Rôle</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM users WHERE from_site= '$website'";
              $query = $PDO->prepare($sql);
              $query->execute();
              while($data = $query->fetch(PDO::FETCH_OBJ)):
              ?>
              <tr>
                <td style="line-height:20px" class="actuTitle">
                    <p class="text-dark mb-0 pb-0" title="<?php echo $data->prenom.' '.$data->nom ?>"><?php echo $data->nom.' '.$data->prenom ?></p>
                    <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                      <small class="mt-0 pt-0"><a href="userEdit.php?id=<?php echo $data->id ?>">Modifier</a> | <a href="#" class="suppr_contact text-danger" id="<?php echo $data->id ?>" data-name ="<?= $data->prenom.' '.$data->nom ?>" data-toggle="modal" data-target="#supprimer">corbeille</a></small>
                    <?php } ?>
                </td>
                <td style="line-height:20px">
					<?php 
					$req = "SELECT * FROM entreprises WHERE id = $data->entreprise_id AND from_site= '$website'";
					$res = $PDO->prepare($req);
					$res->execute();
					$comp = $res->fetch(PDO::FETCH_OBJ);
					?>
                    <p class="text-dark mb-0 pb-0"><?php echo $comp->entreprise ?></p>
                </td>
                <td style="line-height:20px">
				<?php 
					$roles = explode(';', $data->role_projet);
					$role = $roles;
					$lastRole = end($role);
					foreach ($role as $key) {
						$dem = "SELECT * FROM actions WHERE id = $key AND from_site= '$website'";
						$sol = $PDO->prepare($dem);
						$sol->execute();
						$tag = $sol->fetch(PDO::FETCH_OBJ);
						echo $tag->action;
						if($key != $lastRole){echo ', ';}
					}
				?>
                </td>
              </tr>
              <?php endwhile ; ?>
            </tbody>
            <tfoot class="bg-secondary">
                <td class="text-light">Nom</td>
                <td class="text-light">Entreprise</td>
                <td class="text-light">Rôle</td>
            </tfoot>
        </table>

	    </div> <!-- box wrapper -->
	  	</div> <!-- / container-fluid -->

    </div> <!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script src="<?php echo $path ?>backoffice/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $path ?>backoffice/js/dataTables.bootstrap4.min.js"></script>

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


<script type="text/javascript">
$(function(){
	if($(".wrapper").html().length <= 1300){
		emptyDoc = '<div class="col-12">'+
			'<div class="mt-4">'+
				'<p class="text-center">Cliquez ci-dessous pour créer un nouvel utilisateur</p>'+
				<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
				'<center class="mt-1"><a href="user.php" class="btn btn-outline-primary">Ajouter un nouvel utilisateur</a></center>'+
				<?php endif; ?>
			'</div>'+
		'<div>';
		$(".wrapper").html(emptyDoc);
	}
})
</script>
<script type="text/javascript" src="../js/main.js"></script>




</body>        
</html>