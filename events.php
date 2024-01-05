<?php
include 'includes/session-Auth.php';
$page = "projects";
$title = "Actualités <br>du RMT Filarmoni";
$pageURL = $page;
include "includes/doctype.php" ?>
<?php if (!empty($error)) echo @$error ?>

<?php include "includes/nav.php" ?>


  
<div class="container">
	<div class="d-flex flex-wrap g-3">
		<?php
			$sql = "SELECT * FROM blog WHERE from_site = '{$website}' ORDER BY blogDate DESC";
			$query = $PDO->prepare($sql);
			$query->execute();

			while($data = $query->fetch(PDO::FETCH_OBJ)):
				$photo = substr($data->photo,0,-4);
				$actusTexte = strip_tags($data->description) ;
				// TABLEAU POUR TRANSFORMER LES DATES (MOIS) EN FRANÇAIS
				$mois = array("","Jan.","Fév.","Mars","Avr.","Mai","Juin","Juil.","Août","Sept","Oct.","Nov","Déc");

				$eventStart = new DateTime($data->eventStart);
				$eventStart = $eventStart->format('d/m/Y');
				$eventStart = date_create_from_format('d/m/Y', $eventStart);
				$eventStart = $eventStart -> getTimestamp();
				$eventStartJour = date('d',$eventStart);
				$eventStartMois = $mois[date('n',$eventStart)];
				$eventStartAnnee = date('Y',$eventStart);

				$eventEnd = new DateTime($data->eventEnd);
				$eventEnd = $eventEnd->format('d/m/Y');
				$eventEnd = date_create_from_format('d/m/Y', $eventEnd);
				$eventEnd = $eventEnd -> getTimestamp();
				$eventEndJour = date('d',$eventEnd);
				$eventEndMois = $mois[date('n',$eventEnd)];
				$eventEndAnnee = date('Y',$eventEnd);
		?>
			<a href="<?php echo $path.'chantier/'. $data->url ?>" class="col-12 col-md-4 p-2">
				<section class="card-hover">
					<img src="<?= $path ?>backoffice/imgs/original/<?= $photo ?>.jpg" class="img-fluid" alt="<?php echo $data->title ?>">
					<div class="card-text">
						<h2 class="display-6 lh-1 fw-bold"><?php echo $data->title ?></h2>
						<p><?php echo reduire($actusTexte,200) ?></p>
					</div>
				</section>
			</a>
		<?php endwhile; ?>
	</div>
</div>
 
 
  

<?php include "includes/footer.php" ?>
<?php include "includes/end.php" ?>