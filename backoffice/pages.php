<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'pages' ;
$subPage = 'all' ;
$Auth->allow('users');
$typeOfDoc = "outil";
$parent_id = 0;
?>
<?php include 'includes/head.php'; ?>
<?php include "remove/del--file.php" ?>

<?php

$sql = "SELECT * FROM pages ORDER BY page_id DESC LIMIT 1";
$query = $PDO->prepare($sql);
$query->execute();
$data = $query->fetch(PDO::FETCH_OBJ);
if(isset($data->page_id)){
  $pageID =  $data->page_id;
}else{
  $pageID = 0;
}

if(isset($_POST['page--submit'])){

extract($_POST);
$website = $website;
$page_type = 'page';

$pageID = $pageID + 1;

$sql="INSERT INTO pages (page_id,from_site, page_type) VALUES ('$pageID','$website','$page_type')";
$query = $PDO->prepare($sql);
$query->execute();

header('location:'.$path.'backoffice/pageSingle.php?page_id='.$pageID);

}
?>

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
              $sql = "SELECT * FROM pages WHERE from_site= '$website'";
              $query = $PDO->prepare($sql);
              $query->execute();
              while($data = $query->fetch(PDO::FETCH_OBJ)):
              ?>
              <tr>
                <td style="line-height:20px" class="actuTitle">
                    <p class="text-dark mb-0 pb-0" title="<?php echo $data->titre ?>"><?php echo reduire($data->titre,75) ?></p>
                    <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                      <small class="mt-0 pt-0"><a href="pageSingle.php?page_id=<?php echo $data->page_id ?>">Modifier</a> | <a href="#" class="suppr_page text-danger" id="<?php echo $data->page_id ?>" data-name ="<?= $data->titre ?>" data-toggle="modal" data-target="#supprimer">corbeille</a> | <a href="<?php echo $path ?><?php echo $data->page_url ?>" target="_blank">voir</a></small>
                    <?php } ?>
                </td>
                <td style="line-height:20px">
                    <p class="text-dark mb-0 pb-0"><?php echo $data->photo ?></p>
                </td>
                <td style="line-height:20px">
                    <small><?php echo $data->page_update ?></small>
                    <p class="text-dark mb-0 pb-0"><?php if($data->active == 1){echo 'publié';}else{echo "non publié";} ?></p>
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