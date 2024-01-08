<?php
if(isset($_POST['file--submit'])){

extract($_POST);

@$file = $_FILES['file']['name'];
@$file_loc = $_FILES['file']['tmp_name'];
@$file_size = $_FILES['file']['size'];
@$file_type = $_FILES['file']['type'];
@$folderfile		= "uploads/";

move_uploaded_file($file_loc,$folderfile.$file);

@$name = addslashes($_POST["name"]);
@$tool = $_POST['toolDesc'];
@$toolDesc = implode('; ', $tool);
@$toolDesc = addslashes($toolDesc);
@$toolProd = addslashes($_POST["toolProd"]);
@$toolType = addslashes($_POST["toolType"]);
@$toolTarget = addslashes($_POST["toolTarget"]);
@$toolLink = addslashes($_POST["toolLink"]);
@$imgBase64 = $_POST['imgBase64'];
@$from_site = $website;
@$created_by = $Auth->user('prenom').' '.$Auth->user('nom');
@$active = 0;

$sql="INSERT INTO docs (name,fileDate,fileDoc,typeDoc,sizeDoc,parent_id,created_by,from_site,toolDesc,toolProd,toolType,toolTarget,toolLink,imgBase64,active) VALUES('$name','$fileDate','$file','$file_type','$file_size','$parent_id','$created_by','$from_site','$toolDesc','$toolProd','$toolType','$toolTarget','$toolLink','$imgBase64','$active')";
$query = $PDO->prepare($sql);
$query->execute();

}
?>

<div class="modal fade" id="new-file" tabindex="-1" role="dialog" aria-labelledby="new-file" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-file">Ajouter un nouveau document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="" method="POST" enctype="multipart/form-data" class="row">
			
  			<input type="hidden" name="parent_id" value="<?php echo $id ?>">
        
        <div class="form-group col-12" style="padding: 0 10px">
  			 <label>Nom du document</label><br>
         <textarea name="name" placeholder="Nom du document" class="form-control"></textarea>
        </div>
      
        <div class="form-group col-12" style="padding: 0 10px">
          <label>Date du document</label>
  				<input type="text" name="fileDate" class="datetimepicker form-control" placeholder="Date">
        </div>
        
        <div class="form-group col-sm-12" style="padding: 0 10px;">
					<label>Pratiques en production</label><br>

          <?php
          $sql = "SELECT name FROM docs WHERE parent_id = 0 AND from_site = '$website' ORDER BY toolDesc DESC";
          $query = $PDO->prepare($sql);
          $query->execute();
          while($data = $query->fetch(PDO::FETCH_OBJ)):
          ?>

            <div class="form-check form-check-inline">
              <input class="form-check-input" name="toolDesc[]" type="checkbox" id="<?= $data->name ?>" value="<?= $data->name ?>" <?php if($data->name == $parent_name){echo 'checked';}?>>
              <label class="form-check-label" for="<?= $data->name ?>"><?= $data->name ?></label>
            </div>

          <?php endwhile; ?>
        </div>

        <div class="form-group col-12" style="padding: 0 10px">
         <label>Mot clé 1</label><br>
         <select name="toolType" class="form-control">
          <option value="NULL">Choisissez un mot clé</option>
          <?php include 'includes/keyword.php'; ?>
         </select>
        </div>
        <div class="form-group col-12" style="padding: 0 10px">
         <label>Mot clé 2</label><br>
         <select name="toolProd" class="form-control">
          <option value="NULL">Choisissez un mot clé</option>
          <?php include 'includes/keyword.php'; ?>
         </select>
        </div>
        <div class="form-group col-12" style="padding: 0 10px">
         <label>Mot clé 3</label><br>
         <select name="toolTarget" class="form-control">
          <option value="NULL">Choisissez un mot clé</option>
          <?php include 'includes/keyword.php'; ?>
         </select>
        </div>
        <div class="form-group col-12" style="padding: 0 10px">
         <label>Mot clé 4</label><br>
         <select name="toolLink" class="form-control">
          <option value="NULL">Choisissez un mot clé</option>
          <?php include 'includes/keyword.php'; ?>
         </select>
        </div>

        <div class="form-group col-12 fileIt" style="padding: 0 10px">
          <label for="file-to-upload">Ajouter la fiche</label><br>
          <input type="file" name="file" class="form-control-file" id="file-to-upload"/>
        </div>

        <div id="pdf-main-container">
          <div id="pdf-contents">
            <a id="download-image" href="#">
              <canvas id="pdf-canvas" height="150"></canvas>
            </a>
            <input type="hidden" name="imgBase64" class="imgPath" value="">
          </div>
        </div>

        

      </div>
      <div class="modal-footer">
      	<button class="btn btn-primary d-col-12 t-col-12 m-col-12 mt-10" type="submit" name="file--submit">Sauvegarder</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>