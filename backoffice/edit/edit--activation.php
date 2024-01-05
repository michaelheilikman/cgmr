<?php
if (isset($_POST['active--edit'])) {

    @$active = $_POST['active'];
    @$idA = $_POST['id'];
    
    $sql = "UPDATE docs SET active = '$active' WHERE id = $idA ";
    $query = $PDO->prepare($sql);
    $query->execute();
} 
?>

<div class="modal fade" id="modif-active" tabindex="-1" role="dialog" aria-labelledby="modif-active" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleActive"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0">
        <form action="" method="POST">
			
            <div class="d-flex flex-wrap">
				
				<div id="activation1"></div>
                <div id="activation0"></div>

                <input type="hidden" name="id" id="getActive-id">
                <input type="hidden" id="getFile-active" name="active" value="">

			</div>

      </div> <!-- / modal-body -->
      <div class="modal-footer d-flex flex-wrap justify-content-center border-0 pt-0">
        <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
        <button class="btn btn-secondary" type="submit" name="active--edit">OUI</button>
      </div>
      </form>
    </div>
  </div>
</div>