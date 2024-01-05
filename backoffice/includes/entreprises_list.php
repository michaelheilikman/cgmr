<div class="table-responsive">
	<table class="wrapper table table-striped table-hover" id="entreprises">
			<thead class="bg-secondary text-light">
				<tr>
					<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
						<th class="text-center">Entreprise</th>
						<th class="text-center">Gouvernance</th>
						<th class="text-center">Fiche</th>
						<th class="text-center">Modifier</th>
						<th class="text-center">Supprimer</th>
					<?php  }else{ ?>
						<th class="text-center">Entreprise</th>
						<th class="text-center">Gouverance</th>
						<th class="text-center">Fiche</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
		<?php
			$sql = "SELECT * FROM entreprises WHERE from_site = '{$website}' ORDER BY entreprise ASC";
            $query = $PDO->prepare($sql);
            $query->execute();
            while($data = $query->fetch(PDO::FETCH_OBJ)){
		?>
				<tr>
				<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
					<td class="text-center" title="<?php echo $data->entreprise ?>"><?php echo $data->entreprise ?></td>
					<td class="text-center"><?php echo ucfirst($data->gouvernance) ?></td>
					<td class="text-center">
						<a href="#" class="modifier" data-toggle="modal" data-target="#entFiche" 
							data-idEntreprise ="<?= $data->id ?>"
							data-entreprise ="<?= $data->entreprise ?>"
							data-gouv ="<?= $data->gouvernance ?>"
							data-adresseEnt ="<?= $data->adresse ?>"
							data-cpEnt ="<?= $data->cp ?>"
							data-villeEnt ="<?= $data->ville ?>"
							data-tva ="<?= $data->num_TVA ?>"
						>
							<ion-icon style="font-size : 22px" class="text-dark" name="business"></ion-icon>
						</a>
					</td>
					<!-- MODIFICATION DE LA FICHE UTILISATEUR - voir main.js -->
					<td class="text-center">
						<a href="#" class="modifier" data-toggle="modal" data-target="#modif-comp" 
							data-idEntreprise ="<?= $data->id ?>"
							data-entreprise ="<?= $data->entreprise ?>"
							data-gouv ="<?= $data->gouvernance ?>"
							data-adresseEnt ="<?= $data->adresse ?>"
							data-cpEnt ="<?= $data->cp ?>"
							data-villeEnt ="<?= $data->ville ?>"
							data-tva ="<?= $data->num_TVA ?>"
						>
							<ion-icon style="font-size : 22px" class="text-dark" name="information-circle-outline"></ion-icon>
						</a>
					</td>
					<td class="text-center">
						<a href="#" class="suppr_company" id="<?php echo $data->id ?>" data-name ="<?= $data->entreprise ?>" data-toggle="modal" data-target="#supprimer">
							<ion-icon style="font-size : 22px" class="text-dark" name="trash"></ion-icon>
						</a>
					</td>
				<?php  }else{ ?> 
					<td class="text-center" title="<?php echo $data->entreprise ?>"><?php echo $data->entreprise ?></td>
					<td class="text-center"><?php echo $data->gouvernance ?></td>
					<td class="text-center">
						<a href="#" class="modifier" data-toggle="modal" data-target="#entFiche"
							data-idEntreprise ="<?= $data->id ?>"
							data-entreprise ="<?= $data->entreprise ?>"
							data-gouv ="<?= $data->gouvernance ?>"
							data-adresseEnt ="<?= $data->adresse ?>"
							data-cpEnt ="<?= $data->cp ?>"
							data-villeEnt ="<?= $data->ville ?>"
							data-tva ="<?= $data->num_TVA ?>"
						>
							<ion-icon style="font-size : 22px" class="text-dark" name="business"></ion-icon>
						</a>
					</td>
				<?php } ?>
				</tr>
				<?php } ?>
			</tbody>

		

	</table> <!-- / entreprises -->
	
</div> <!-- / table responsive -->


