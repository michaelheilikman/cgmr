<?php
if(isset($_POST['event--submit'])){

extract($_POST);
$eventDate = addslashes($_POST["eventDate"]);
$eventTime = addslashes($_POST["eventTime"]);
$eventTimeEnd = addslashes($_POST["eventTimeEnd"]);
$eventTexte = nl2br(addslashes($_POST["eventTexte"]));
$from_site = $website;

$sql="INSERT INTO events (eventDate,eventTime,eventTimeEnd,eventTexte,from_site) VALUES('$eventDate','$eventTime','$eventTimeEnd','$eventTexte','$from_site')";
$query = $PDO->prepare($sql);
$query->execute();

}

$start = "08:00";
$end = "20:00";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;
$eStart = strtotime($start);
$eEnd = strtotime($end);
$eNow = $eStart;

?>

<div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-event">Ajouter un nouvel événement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="" method="POST" enctype="multipart/form-data" class="row">
			
        
        <div class="form-group col-sm-6" style="padding: 0 10px">
  			<label>Date de l'événement</label><br>
  			<input type="text" name="eventDate" id="getTheDate" placeholder="Nom du document" class="form-control">
        </div>
      
      <div class="col-12 col-sm-6 row">
        <label>Horaire de l'événement :</label>
          <div class="form-group col-sm-6" style="padding: 0 10px">
  			<select name="eventTime" style="width:100%" class="form-control">
  			<?php 
  				while($tNow <= $tEnd){
  				  echo "<option value='" . date("H:i",$tNow) . "'>" . date("H:i",$tNow) . "</option>";
  				  $tNow = strtotime('+30 minutes',$tNow);
  				}
  			?>
  			</select>
          </div>
        <div class="form-group col-sm-6" style="padding: 0 10px">
           <select name="eventTimeEnd" style="width:100%" class="form-control">
        <?php 
          while($eNow <= $eEnd): ?>
            <option value="<?= date("H:i",$eNow) ?>"><?= date("H:i",$eNow) ?></option>";
          <?php  
            $eNow = strtotime('+30 minutes',$eNow);
            endwhile;
          ?>
        </select>
        </div>
      </div>

        <div class="form-group col-sm-12" style="padding: 0 10px">
         <label>Description :</label><br>
         <textarea type="text" name="eventTexte" placeholder="" class="form-control form-control-sm"></textarea>
        </div>

      </div>
      <div class="modal-footer">
      	<button class="btn btn-primary d-col-12 t-col-12 m-col-12 mt-10" type="submit" name="event--submit">Confirmer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>