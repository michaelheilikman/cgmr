<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'docs' ;
$subPage = 'all';
$Auth->allow('users');
$typeOfDoc = "dossier";
$parent_id = 0;
?>
<?php include 'includes/head.php'; ?>
<div id="overlay"></div>


<?php include "insert/new--folder.php" ?>
<?php include "edit/edit--folder.php" ?>
<?php include "remove/del--file.php" ?>

 <div class="d-flex" id="wrapper">

    <?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

      <div class="container-fluid">
        <div class="box wrapper">
		<div class="row p-3" id="sortable">
			 <?php
		        $sql = "SELECT * FROM docs WHERE parent_id = 0 AND (folderType != 'biblio' AND folderType != 'copil' AND folderType != 'colloque') AND from_site = '$website' ORDER BY item_order ASC";
		        $query = $PDO->prepare($sql);
		        $query->execute();
		        while($folder = $query->fetch(PDO::FETCH_OBJ)){
		    ?>
		    <div class="px-2 mb-3" id="<?= $folder->id ?>" style="width:145px;">
				<div class="pt-3 px-3">
					<div class="">
						<a href="files.php?files=<?php echo $folder->id ?>" class="text-decoration-none text-dark">
							<img src="img/dossier.png" width="100">
						</a>
					</div>
					<div class="unMove">
						<?php if($Auth->user('role') != 'autre'): ?>
							<div class="position-relative">
								<a href="#" class="modifile d-flex justify-content-end" data-drop="drop-<?= $folder->id ?>" 
									data-id="<?= $folder->id ?>" 
									data-name="<?= $folder->name ?>" 
									style="position: absolute;top:-65px;right:0px;">
									<ion-icon name="more" ></ion-icon>
								</a>
								<div class="dropped" id="drop-<?= $folder->id ?>">
									<!-- SUPPRIMER UN DOCUMENT -->
									<a href="#" class="supprimer dropdown-item" id="<?php echo $folder->id ?>" data-toggle="modal" data-target="#supprimer">Supprimer</a>
									<!-- MODIFIER UN DOSSIER -->
									<a href="#" class="modifier dropdown-item" 
										data-id="<?= $folder->id ?>" data-name="<?= $folder->name ?>" 
										data-fileDate="<?= $folder->fileDate ?>" 
										data-toggle="modal" data-target="#modifier">
										Modifier
									</a>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<aside class="d-flex justify-content-center pt-0" style="cursor:move">
					<small class="text-center" title="<?php echo $folder->name ?>"><?php echo $folder->name ?></small>
				</aside>
			</div>
		<?php  } ?>

		</div> <!-- sortable -->

	</div> <!-- box wrapper -->
      </div> <!-- container-fluid -->
    </div><!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>


  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<script type="text/javascript">
$(function(){
	if($(".wrapper").html().length <= 300){
		emptyDoc = '<div class="col-12 mt-5">'+
		'<center><img src="img/dossier.png" class="text-center" width="100"></center>'+
			'<div class="mt-2">'+
				'<p class="text-center">Aucun dossier partagé n\'est disponible pour le moment</p>'+
				<?php if($Auth->user('role') != 'autre'): ?>
				'<center class="mt-4"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#new-folder">Ajouter un dossier</a></center>'+
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