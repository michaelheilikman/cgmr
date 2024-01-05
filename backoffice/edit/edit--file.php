<?php
if(isset($_POST['file--edit']) && $_POST['file--edit'] == 'modifier le document'){
  @$idM = $_POST['id'];
  @$name = addslashes($_POST['name']);
  @$fileDate = addslashes($_POST['fileDate']);
  if(!empty($_POST['parent_id'])){
    @$parent = $_POST['parent_id'];
    @$parent_id = implode('; ', $parent);
    @$parent_id = addslashes($parent_id);
  }
  @$toolType = addslashes($_POST['toolType']);
  @$toolProd = addslashes($_POST['toolProd']);
  @$toolTarget = addslashes($_POST['toolTarget']);

  $sql = "UPDATE docs SET name = '$name', fileDate = '$fileDate', toolType = '$toolType', toolProd = '$toolProd' , toolTarget = '$toolTarget', toolDesc = '$parent_id'  WHERE id = $idM ";
  $query = $PDO->prepare($sql);
  $query->execute();
}
?>
<div class="modal fade" id="edit-file" tabindex="-1" role="dialog" aria-labelledby="new-file" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-file">Modifier le document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
      
      <form action="" method="POST" enctype="multipart/form-data" class="container-fluid d-flex flex-wrap" > 
        
        <div class="d-flex justify-content-center align-items-center w-100">
            <img class="d-flex" id="getFile-link" src="" height="200"/>
        </div>
			
  			<input type="hidden" name="id" value="" id="getFile-id">
        
        <div class="form-group col-sm-12" style="padding: 0 10px">
  			 <label>Nom du document</label><br>
         <textarea name="name" placeholder="Nom du document" class="form-control" id="getFile-name"></textarea>
        </div>
      
        <div class="form-group col-sm-12" style="padding: 0 10px">
          <label>Date du document</label>
  				<input type="text" name="fileDate" class="datetimepicker form-control form-control-sm" placeholder="Date" id="getFile-date">
        </div>

        <!-- <div class="form-group col-sm-12" style="padding: 0 10px;">
          <label>Espèces</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="porcEdit" value="porc">
            <label class="form-check-label" for="porcEdit">porc</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="lapinEdit" value="lapin">
            <label class="form-check-label" for="lapinEdit">lapin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="poissonEdit" value="poisson">
            <label class="form-check-label" for="poissonEdit">poisson</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="volailleEdit" value="volaille">
            <label class="form-check-label" for="volailleEdit">volaille</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="bovinEdit" value="bovin">
            <label class="form-check-label" for="bovinEdit">bovin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="ovinEdit" value="ovin">
            <label class="form-check-label" for="ovinEdit">ovin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="caprinEdit" value="caprin">
            <label class="form-check-label" for="caprinEdit">caprin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="equinEdit" value="equin">
            <label class="form-check-label" for="equinEdit">equin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input getUser-role" name="parent_id[]" type="checkbox" id="multi-filieresEdit" value="multi-filieres">
            <label class="form-check-label" for="multi-filieresEdit">multi-filieres</label>
          </div>
        </div>

        <div class="form-group col-sm-12" style="padding: 0 10px">
         <label>Mot clé 1</label><br>
         <input type="text" name="toolType" placeholder="Mot clé 1" class="form-control form-control" id="getFile-type">
        </div>

        <div class="form-group col-sm-12" style="padding: 0 10px">
         <label>Mot clé 2</label><br>
         <input type="text" name="toolProd" placeholder="Mot clé 2" class="form-control form-control" id="getFile-prod">
        </div>
        
        <div class="form-group col-sm-12" style="padding: 0 10px">
         <label>Mot clé 3</label><br>
         <input type="text" name="toolTarget" placeholder="Mot clé 3" class="form-control form-control" id="getFile-target">
        </div> -->

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary d-col-12 t-col-12 m-col-12 mt-10" type="submit" name="file--edit" value="modifier le document" id="submit">Sauvegarder</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>