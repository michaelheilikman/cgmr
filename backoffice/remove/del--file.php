<!-- Modal -->
<div class="modal fade" id="supprimer" tabindex="-1" role="dialog" aria-labelledby="supprimer" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<?php if($typeOfDoc != "contact" && $typeOfDoc != "event" && $typeOfDoc != "outil"){ ?>
        	<h5 class="modal-title" id="supprimer">Supprimer le <?php echo $typeOfDoc ?></h5>
        <?php }elseif($typeOfDoc == "event"){ ?>
        	<h5 class="modal-title" id="supprimer">Supprimer <?php if($typeOfDoc == "event"){echo "l'événement du";} ?> <span class="getUserName font-weight-bold text-info"></span></h5>
        <?php }elseif($typeOfDoc == "outil"){ ?>
        <h5 class="modal-title" id="supprimer">Supprimer <span class="getUserName font-weight-bold text-info"></span></h5>
        <?php } ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if($typeOfDoc != "contact" && $typeOfDoc != "event" && $typeOfDoc != "outil"){ ?>
          <p>Voulez-vous vraiment supprimer ce <?php echo $typeOfDoc ?> ?</p>
        <?php }elseif($typeOfDoc == "event"){ ?>
          <p>Voulez-vous vraiment supprimer <?php if($typeOfDoc == "event"){echo "l'événement du";} ?> <span class="getUserName font-weight-bold text-info"></span> ?</p>
        <?php }elseif($typeOfDoc == "outil"){ ?>
        <p>Voulez-vous vraiment supprimer <span class="getUserName font-weight-bold text-info"></span> ?</p>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="#" class="btn btn-danger" id="getValue">Supprimer</a>
      </div>
    </div>
  </div>
</div>