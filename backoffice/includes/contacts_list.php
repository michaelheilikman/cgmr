			<form class="d-flex flex-wrap">
				
			<div class="form-group col-12 col-md-4 col-lg-4 px-1">
					<input type="text" data-search="search" class="form-control" placeholder="Recherchez dans le tableau..." id="myInput" onkeyup="searchFilter()">
				</div>

				<div class="form-group col-12 col-md-4 col-lg-4  px-1">
					<select id="entreprise-filter" class="form-control">
						<option value="ALL">Voir toutes les entreprises</option>
						<?php 
						$sql = "SELECT * FROM entreprises WHERE from_site = '{$website}' ORDER BY entreprise ASC";
				        $query = $PDO->prepare($sql);
				        $query->execute();
				        while($data = $query->fetch(PDO::FETCH_OBJ)){
						?>
						<option value="<?php echo $data->entreprise ?>"><?php echo $data->entreprise ?></option>
						<?php } ?>
					</select>
				</div>
		
				<div class="form-group col-12 col-md-4 col-lg-4  px-1">
					<select id="role-filter" class="form-control">
						<option value="ALL">Voir tous les rôles</option>
						<?php 
						$sql = "SELECT * FROM actions WHERE from_site = '{$website}' ORDER BY action ASC";
				        $query = $PDO->prepare($sql);
				        $query->execute();
				        while($data = $query->fetch(PDO::FETCH_OBJ)){
						?>
						<option value="<?php echo $data->action ?>"><?php echo $data->action ?></option>
						<?php } ?>
					</select>
				</div>

			</form>

			
<?php
$sql = "SELECT * FROM users WHERE from_site = '{$website}' ORDER BY nom ASC";
$query = $PDO->prepare($sql);
$query->execute();
$data = $query->fetch();
?>
			

		<div class="table-responsive">
			<table class="wrapper table table-striped table-hover <?php if(!empty($data->id)){echo 'table-light';} ?>" id="contacts">
				<?php
				$sql = "SELECT * FROM users WHERE from_site = '{$website}' AND (type != 'supAd') ORDER BY nom ASC";
	            $query = $PDO->prepare($sql);
	            $query->execute();
	            $data = $query->fetch();
	        	
	        	?>
					<thead class="bg-secondary text-light">
						<tr>
							<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
								<th>Nom</th>
								<th>Prénom</td>
								<th class="text-center">Entreprise</th>
								<!-- <th class="text-center">Mail</th> -->
								<th class="text-center">Rôle</th>
								<th class="text-center">Fiche</th>
								<th class="text-center">Modifier</th>
								<th class="text-center">Suppr.</th>
							<?php  }else{ ?>
								<th>Nom</td>
								<th>Prénom</td>
								<th class="text-center">Entreprise</th>
								<!-- <th class="text-center">Mail</th> -->
								<th class="text-center">Rôle</th>
								<th class="text-center">Fiche</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody id="myUL">
				<?php
					$sql = "SELECT * FROM users WHERE from_site = '{$website}' AND (type != 'supAd') ORDER BY nom ASC";
		            $query = $PDO->prepare($sql);
		            $query->execute();
		            while($data = $query->fetch(PDO::FETCH_OBJ)){
				?>
						<tr class="filter">
						<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
							<td class=""><?php echo mb_strtoupper($data->nom) ?></td>
							<td class=""><?php echo $data->prenom ?></td>
							<td class="text-center" title="<?php echo $data->entreprise ?>"><?php echo $data->entreprise ?></td>
							<!-- <td class="text-center"><a href="mailto:<?php echo $data->mail ?>" title="<?php echo $data->mail ?>"><?php echo reduire($data->mail, 30) ?></a></td> -->
							<td class="text-center"><?php echo $data->role_projet ?></td>
							<td class="text-center">
								<a href="#" class="modifier" data-toggle="modal" data-target="#userFiche"
									data-id ="<?= $data->id ?>"
									data-prenom ="<?= $data->prenom ?>"
									data-nom ="<?= $data->nom ?>"
									data-mail ="<?= $data->mail ?>"
									data-work ="<?= $data->entreprise ?>"
									data-fonction ="<?= $data->fonction ?>"
									data-gouvernance ="<?= $data->gouvernance ?>"
									data-adresse ="<?= $data->adresse ?>"
									data-cp ="<?= $data->cp ?>"
									data-ville ="<?= $data->ville ?>"
									data-telFix ="<?= $data->telFix ?>"
									data-telMob ="<?= $data->telMob ?>"
									data-active ="<?= $data->active ?>"
									data-type ="<?= $data->type ?>"
									data-entId = "<?= $data->entreprise_id ?>"
									<?php 
										$roles = explode('; ', $data->role_projet);
										$role = $roles;
										for ($i=0; $i < count($role); $i++) { 
											echo 'data-role'.$i.'='.$role[$i].'';
										}
									?>
								>
									<ion-icon style="font-size : 22px" class="text-dark" name="contact">fiche</ion-icon>
								</a>
							</td>
							<!-- MODIFICATION DE LA FICHE UTILISATEUR - voir main.js -->
							<td class="text-center">
								<a href="#" class="modifier" data-toggle="modal" data-target="#modifier" 
									data-id ="<?= $data->id ?>"
									data-prenom ="<?= $data->prenom ?>"
									data-nom ="<?= $data->nom ?>"
									data-mail ="<?= $data->mail ?>"
									data-work ="<?= $data->entreprise ?>"
									data-fonction ="<?= $data->fonction ?>"
									data-gouvernance ="<?= $data->gouvernance ?>"
									data-adresse ="<?= $data->adresse ?>"
									data-cp ="<?= $data->cp ?>"
									data-ville ="<?= $data->ville ?>"
									data-telFix ="<?= $data->telFix ?>"
									data-telMob ="<?= $data->telMob ?>"
									data-active ="<?= $data->active ?>"
									data-type ="<?= $data->type ?>"
									data-entId = "<?= $data->entreprise_id ?>"
									<?php 
										$roles = suppr_accents($data->role_projet);
										$roles = str_replace(' ','',$roles);
										$roles = explode(';', $roles);
										echo 'data-count="'.count($roles).'"';
										$role = $roles;
										for ($i=0; $i < count($role); $i++) { 
											echo 'data-role'.$i.'="'.$role[$i].'"';
										}
									?>
								>
									<ion-icon style="font-size : 22px" class="text-dark" name="information-circle-outline">modif</ion-icon>
								</a>
							</td>
							<td class="text-center">
								<a href="#" class="suppr_contact" id="<?php echo $data->id ?>" data-name ="<?= $data->prenom.' '.$data->nom ?>" data-toggle="modal" data-target="#supprimer">
									<ion-icon style="font-size : 22px" class="text-dark" name="trash">suppr.</ion-icon>
								</a>
							</td>
						<?php  }else{ ?> 
							<td class=""><?php echo strtoupper($data->nom) ?></td>
							<td class=""><?php echo $data->prenom ?></td>
							<td class="text-center" title="<?php echo $data->entreprise ?>"><?php echo $data->entreprise ?></td>
							<!-- <td class="text-center"><a href="mailto:<?php echo $data->mail ?>" title="<?php echo $data->mail ?>"><?php echo $data->mail ?></a></td> -->
							<td class="text-center"><?php echo $data->role_projet ?></td>
							<td class="text-center">
								<a href="#" class="modifier" data-toggle="modal" data-target="#userFiche"
									data-id ="<?= $data->id ?>"
									data-prenom ="<?= $data->prenom ?>"
									data-nom ="<?= $data->nom ?>"
									data-mail ="<?= $data->mail ?>"
									data-work ="<?= $data->entreprise ?>"
									data-fonction ="<?= $data->fonction ?>"
									data-gouvernance ="<?= $data->gouvernance ?>"
									data-adresse ="<?= $data->adresse ?>"
									data-cp ="<?= $data->cp ?>"
									data-ville ="<?= $data->ville ?>"
									data-telFix ="<?= $data->telFix ?>"
									data-telMob ="<?= $data->telMob ?>"
									data-active ="<?= $data->active ?>"
									data-type ="<?= $data->type ?>"
									data-entId = "<?= $data->entreprise_id ?>"
									<?php 
										$roles = explode('; ', $data->role_projet);
										$role = $roles;
										for ($i=0; $i < count($role); $i++) { 
											echo 'data-role'.$i.'='.$role[$i].'';
										}
									?>
								>
									<ion-icon style="font-size : 22px" class="text-dark" name="contact"></ion-icon>
								</a>
							</td>
						<?php } ?>
						</tr>
						<?php } ?>
					</tbody>

				

			</table> <!-- / myUL -->
			
		</div> <!-- / table responsive -->


