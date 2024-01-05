<div class="d-flex flex-wrap">

	<div class="col-12 col-md-12 mb-4">
		<a href="#" data-toggle="modal" data-target="#new-action" class="btn btn-info pr-5"><ion-icon name="add-circle-outline" style="font-size: 1.3em;position:absolute;top:8px;"></ion-icon> <span style="position:relative;left: 30px;">Nouveau rôle</span></a>
	</div>

	<div class="col-12 col-md-7">
		<?php
			$sql = "SELECT * FROM actions WHERE from_site = '{$website}' ORDER BY id ASC";
            $query = $PDO->prepare($sql);
            $query->execute();
            while($data = $query->fetch(PDO::FETCH_OBJ)): // WHILE
		?>
				<div class="badge badge-primary mb-2 mr-1 p-2">
					<span style="position: relative;top:-1px;font-size:1.1em;cursor: pointer;" class="modifier" data-toggle="modal" data-target="#modif-action"
							data-idRole ="<?= $data->id ?>"
							data-action ="<?= $data->action ?>"
					>
						<?php echo $data->action ?>
					</span>
					<a href="#" class="text-light ml-2 suppr_action" style="position: relative;top:1px;font-size:1.3em" id="<?php echo $data->id ?>" data-name ="<?= $data->action ?>" data-toggle="modal" data-target="#supprimer">
						<ion-icon name="close-circle-outline"></ion-icon>
					</a>
				</div>
		<?php endwhile; ?>
	</div>
</div>