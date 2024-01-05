<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'events' ;
$Auth->allow('users');
$typeOfDoc = "event";
$parent_id = 0;
?>
<?php include 'includes/head.php'; ?>



<?php include "insert/new--folder.php" ?>
<?php include "edit/edit--folder.php" ?>
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
                <th class="text-light">Créé par</th>
                <th class="text-light">Date</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM blog WHERE from_site= '$website'";
              $query = $PDO->prepare($sql);
              $query->execute();
              while($data = $query->fetch(PDO::FETCH_OBJ)):
              ?>
              <tr>
                <td style="line-height:20px" class="actuTitle">
                    <p class="text-dark mb-0 pb-0" title="<?php echo $data->title ?>"><?php echo reduire($data->title,75) ?></p>
                    <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                      <small class="mt-0 pt-0"><a href="eventEdit.php?id=<?php echo $data->id ?>">Modifier</a> | <a href="#" class="suppr_blog text-danger" id="<?php echo $data->id ?>" data-name ="<?= $data->title ?>" data-toggle="modal" data-target="#supprimer">corbeille</a> | <a href="<?php echo $path ?>actualite/<?php echo $data->url ?>" target="_blank">voir</a></small>
                    <?php } ?>
                </td>
                <td style="line-height:20px">
                    <p class="text-dark mb-0 pb-0"><?php echo $data->creator ?></p>
                </td>
                <td style="line-height:20px">
                    <small><?php echo $data->blogDate ?></small>
                </td>
              </tr>
              <?php endwhile ; ?>
            </tbody>
            <tfoot class="bg-secondary">
                <td class="text-light">Titre</td>
                <td class="text-light">Créé par</td>
                <td class="text-light">Date</td>
            </tfoot>
        </table>

	    </div> <!-- box wrapper -->
      </div> <!-- container-fluid -->
      
    </div><!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->


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
	if($(".wrapper").html().length <= 300){
		emptyDoc = '<div class="col-12">'+
		'<center><img src="img/empty_date.png" class="center" width="100"></center>'+
			'<div class="mt-4">'+
				'<p class="text-center">Nouvel événement à venir</p>'+
				<?php if($Auth->user('role') != 'autre'): ?>
				'<center class="mt-4"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#new-folder">Ajouter un événement</a></center>'+
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