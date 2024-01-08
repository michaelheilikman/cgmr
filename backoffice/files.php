<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'file' ;
$Auth->allow('users');
$typeOfDoc = "document";
?>
<?php	
	$sql = "SELECT * FROM docs WHERE id={$_GET['files']}";
	$query = $PDO->prepare($sql);
	$query->execute();
	$folder = $query->fetch(PDO::FETCH_OBJ);

	$id = $_GET["files"];
	$parent_id = $folder->id;
	$parent_name = $folder->name;

?>
<?php include 'includes/head.php'; ?>
<div id="overlay"></div>


<?php include "insert/new--folder.php" ?>
<?php include "insert/new--file.php" ?>
<?php include "edit/edit--file.php" ?>
<?php include "edit/edit--activation.php" ?>
<?php include "edit/edit--folder.php" ?>
<?php include "remove/del--file.php" ?>

 <div class="d-flex" id="wrapper">

	<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
    <div id="page-content-wrapper">

<?php include "includes/navigation.php" ?>
	

      <div class="container-fluid">
        <div class="box wrapper">
			

		<div class="row p-3" id="sort">
			<?php
		        $sql = "SELECT * FROM docs WHERE parent_id = $id AND folderType != ' ' AND from_site = '$website' ORDER BY item_order ASC";
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
			<?php } ?>
		</div>

		<div class="row" id="sortable">
			<?php	
				$sql = "SELECT * FROM docs WHERE toolDesc LIKE '%{$parent_name}%' AND fileDoc != 'NULL' AND from_site = '$website' ORDER BY item_order ASC";
				$query = $PDO->prepare($sql);
				$query->execute();
				while($folder = $query->fetch(PDO::FETCH_OBJ)){

				$format = after_last('.', $folder->fileDoc);
				$fileDate = new DateTime($folder->fileDate);
				$fileDate = $fileDate->format('d/m/Y');
			?>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3" style="padding:0 10px;" id="<?= $folder->id ?>">
				<div class="doc d-flex justify-content-between">
					<?php if (!empty($folder->imgBase64)){ ?>
						<div class="d-none d-md-block col-md-3">
							<a target="_blank" href="uploads/<?php echo $folder->fileDoc ?>" class="noUnder">
								<div class="popBox popBox-medium" id="<?php echo $folder->id ?>">
									<img src="<?php echo $folder->imgBase64 ?>" height="110">
								</div>
							</a>
						</div>
					<?php }elseif (!empty($folder->fileDoc) AND empty($folder->imgBase64)){ ?>
						<div class="d-none d-md-block col-md-3">
							<?php if($format == 'jpg' || $format == 'png' || $format == 'jpeg' || $format == 'gif'){?>
							<a data-toggle="modal" data-target="#pop<?php echo $folder->id ?>" href="#" class="noUnder"><img src="img/format/<?php echo $format ?>.png"></a>
							<div class="modal fade" id="pop<?php echo $folder->id ?>" tabindex="-1" aria-labelledby="pop<?php echo $folder->id ?>" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"><?php echo $folder->fileDoc ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body d-flex flex-wrap justify-content-center">
											<img src="uploads/<?php echo $folder->fileDoc ?>" width="100%">
										</div>
									</div>
								</div>
							</div>
							<?php }else{ ?>
								<a target="_blank" href="uploads/<?php echo $folder->fileDoc ?>" class="noUnder"><img src="img/format/<?php echo $format ?>.png" height="110"></a>
							<?php } ?>
						</div>
					<?php }elseif(empty($folder->fileDoc) AND empty($folder->toolLink) ){ ?>
						<?php $format = 'rien' ?>
					<div class="d-none d-md-block col-md-3">
						<img src="img/format/<?php echo $format ?>.png" height="110">
					</div>
					<?php }elseif(!empty($folder->toolLink)){ ?>
						<?php $format = 'lien' ?>
					<div class="d-none d-md-block col-sm-3">
						<a target="_blank" href="<?php echo $folder->toolLink ?>" class="noUnder"><img src="img/format/<?php echo $format ?>.png" height="110"></a>
					</div>
					<?php } ?>
					<div class="col-11 col-md-8 unMove textInblock">
						<?php if (!empty($folder->fileDoc)){ ?>
						<a target="_blank" href="uploads/<?php echo $folder->fileDoc ?>" class="noUnder text-dark"><h5 class="text-dark" title="<?php echo $folder->name ?>"><?php echo $folder->name?></h5></a>
						<?php }elseif(empty($folder->fileDoc) AND empty($folder->toolLink) ){ ?>
							<h5 class="text-dark" title="<?php echo $folder->toolDesc ?>"><?php echo $folder->toolDesc ?></h5>
						<?php }elseif(!empty($folder->toolLink)){ ?>
							<a target="_blank" href="<?php echo $folder->toolLink ?>" class="noUnder text-dark"><h5 class="text-dark" title="<?php echo $folder->name ?>"><?php echo $folder->name ?></h5></a>
						<?php } ?>
						<?php if (!empty($folder->fileDoc)){ ?>
							<p class="text-muted mb-0 d-none d-md-block">Taille : <?php echo formatBytes($folder->sizeDoc,2);  ?></p>
						<?php } ?>
						<p class="text-muted mb-0 d-none d-md-block">Créé par <b><?php echo $folder->created_by ?></b></p>
						<p class="text-muted mb-0 d-none d-md-block">Le <b><?php echo $fileDate ?></b></p>
						<p class="text-muted mb-0">Document <span class="font-weight-bolder <?php if($folder->active == '0'){echo 'text-danger';}elseif($folder->active == '1'){echo 'text-success';}; ?>"><?php if($folder->active == '0'){echo 'DÉSACTIVÉ';}elseif($folder->active == '1'){echo 'ACTIVÉ';}; ?></span></p>
					</div>
					<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
						<div class="">
							<a href="#" class="modifile d-flex justify-content-end" data-drop="drop-<?= $folder->id ?>" file-id="<?= $folder->id ?>">
								<ion-icon name="more" ></ion-icon>
							</a>
							<div class="dropped" id="drop-<?= $folder->id ?>">
								<!-- SUPPRIMER UN DOCUMENT -->
							    <a class="dropdown-item supprimer" href="#" id="<?php echo $folder->id ?>" data-img="<?php echo $folder->fileDoc ?>" data-toggle="modal" data-target="#supprimer">Supprimer</a>

							    <!-- MODIFIER UN DOCUMENT -->
							    
								<a class="dropdown-item edit-file" href="#" 
								file-id="<?php echo $folder->id ?>" 
								file-name="<?php echo $folder->name ?>" 
								file-date="<?php echo $folder->fileDate ?>" 
								file-type="<?php echo $folder->toolType ?>" 
								file-prod="<?php echo $folder->toolProd ?>" 
								file-target="<?php echo $folder->toolTarget ?>" 
								file-link="<?php echo $folder->toolLink ?>" 
								file-img = "<?php echo $folder->imgBase64 ?>" 
								file-file="<?php echo $folder->fileDoc ?>"  
								<?php
									$parents = $folder->toolDesc;
									$parents = str_replace(' ','',$parents);
									$parents = explode(';', $parents);
									echo 'data-count="'.count($parents).'"';
									$parent = $parents;
									for ($i=0; $i < count($parent); $i++) { 
										echo 'data-role'.$i.'="'.$parent[$i].'"';
									}
								?>
								file-parent="<?php echo $folder->parent_id ?>"
								data-toggle="modal" data-target="#edit-file"> Modifier</a>
								
								<a class="dropdown-item edit-file" href="#" 
								active-id="<?php echo $folder->id ?>" 
								file-name="<?php echo $folder->name ?>"
								file-active="<?php echo $folder->active ?>"
								data-toggle="modal" data-target="#modif-active"> <?php if($folder->active == '0'){echo 'Activer';}elseif($folder->active == '1'){echo 'Désactiver';}; ?></a>
						  	</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php } ?>
		</div>

		</div> <!-- /box wrapper -->

		<?php
			$sql = "SELECT * FROM chatbox WHERE doc_id = $id ORDER BY date DESC";
			$query = $PDO->prepare($sql);
			$query->execute();
		?>
		<div class="chatBox">
			<div class="chatBox--icon">
				<img src="img/chatbox/chatbox.svg" width="30">

				<?php 

		          $sql2 = "SELECT * FROM chatbox WHERE doc_id = $id";
		          $req = $PDO->prepare($sql2);
		          $req->execute();
		          $blink = $req->fetchAll();

		          if(count($blink)>0){
		          echo '<span><span class="countMessage">'.count($blink).'</span></span>';
		          }

		        ?>

			</div>
			

			<div class="chatBox--text">
			
			<?php	
					while($folder = $query->fetch(PDO::FETCH_OBJ)){

					$fileDate2 = new DateTime($folder->date);
					$fileDate2 = $fileDate2->format('d/m/Y H:i:s');

				?>
			
				<?php if($folder->author == $Auth->user('prenom').' '.$Auth->user('nom')){?>
					<div class="my-message mt-10 content">
				<?php }else{ ?>
					<div class="other-message mt-10 content">
				<?php } ?>
						<p class="author"><?php echo $folder->author ?></p>
						<p class="date"><?php echo $fileDate2 ?></p>
						<p class="text"><?php echo $folder->texte ?></p>
					</div>
			<?php } ?>
			</div>

			<div class="chatBox--input" style="bottom:-3px;">
				<form action="" method="POST" id="chatBoxForm">
					<input type="hidden" name="doc_id" id="doc_id" value="<?php echo $id ?>">
					<input type="hidden" name="author" id="author" value="<?php echo $Auth->user('prenom').' '.$Auth->user('nom'); ?>">
					<textarea name="texte" id="texte" class=""></textarea>
					<input class="btn btn-primary btn-block w-100" type="submit" name="chatBox--submit" id="chatBoxSubmit" value="envoyer"/>
				</form>
			</div>

		</div> <!-- fin de chatBox text -->
		</div> <!-- fin de chatBox -->

	</div> <!-- /.container-fluid -->

    </div><!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/pdf.js"></script>
<script type="text/javascript" src="js/pdf.worker.js"></script>

<script>
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
</script>



<script type="text/javascript">
$(function(){
	if($(".wrapper").html().length <= 100){
		emptyDoc = '<div class="d-col-12 t-col-12 m-col-12 padding-20">'+
		'<center><img src="img/empty_status.png" class="center" width="100"></center>'+
			'<div class="mt-20">'+
				'<p class="text-center mt-2">Ce dossier est vide</p>'+
				<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
				'<center class="mt-3">'+
					'<a href="#" class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#new-folder"><ion-icon name="folder" style="font-size:20px;position:relative;top:3px;"></ion-icon> Ajouter un dossier</a>'+
					'<a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#new-file"><ion-icon name="document" style="font-size:20px;position:relative;top:3px;"></ion-icon> Ajouter un document</a>'+
				'</center>'+
				<?php endif; ?>
			'</div>'+
		'<div>';
		$(".wrapper").html(emptyDoc);
	}
})
</script>
<script type="text/javascript" src="../js/main.js"></script>


<!--****************************************************
DATE PICKER
****************************************************-->
<script src="js/jquery.datetimepicker.js"></script>
<script>
$('.datetimepicker').datetimepicker({
lang:'fr',
 i18n:{
  de:{
   months:[
    'Janvier','Fevrier','Mars','Aavri',
    'Mai','Juin','Juillet','Août',
    'Septembre','Octobre','Novembre','Decembre',
   ],
   dayOfWeek:[
    "Di", "Lu", "Ma", "Me", 
    "Je", "Ve", "Sa",
   ]
  }
 },
    onGenerate:function( ct ){
        $(this).find('.xdsoft_date')
            .toggleClass('xdsoft_disabled');
    },
    minDate:'-2000-02-01',
    maxDate:'+2030-02-01',
    timepicker:false,
    format:'Y-m-d'
});
</script>



<!--****************************************************
IMG GENERATOR FROM PDF
****************************************************-->
<script>

var __PDF_DOC,
	__CURRENT_PAGE,
	__TOTAL_PAGES,
	__PAGE_RENDERING_IN_PROGRESS = 0,
	__CANVAS = $('#pdf-canvas').get(0),
	__CANVAS_CTX = __CANVAS.getContext('2d');

	$("#pdf-main-container").hide();

function showPDF(pdf_url) {

	PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
		__PDF_DOC = pdf_doc;
		__TOTAL_PAGES = __PDF_DOC.numPages;
		
		// Hide the pdf loader and show pdf container in HTML
		$("#pdf-contents").show();

		// Show the first page
		showPage(1);
	}).catch(function(error) {
		// If error re-show the upload button
		$("#upload-button").show();
		
		alert(error.message);
	});
}

function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;

		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);

		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;

			// Show the canvas and hide the page loader
			$("#pdf-canvas").show();
			$("#pdf-main-container").show();
			$("#displayImage").hide();
			$(".imgPath").attr('value', $('#pdf-canvas').get(0).toDataURL("image/jpeg", 1))
		});
	});
}



// When user chooses a PDF file
$("#file-to-upload").on('change', function() {
	// Validate whether PDF
    if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
        console.log('Error : Not a PDF');
        return;
    }
	// Send the object url of the pdf
	showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
});

// $("#download-image").on('click', function() {
//     $("#displayImage").show();
// 	$(this).next(".imgPath").attr('value', $('#pdf-canvas').get(0).toDataURL("image/jpeg", 1))
// });

</script>



</body>        
</html>