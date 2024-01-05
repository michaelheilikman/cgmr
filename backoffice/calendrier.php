<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'calendrier' ;
$Auth->allow('users');
$typeOfDoc = "event";
?>
<?php include 'includes/configCalendrier.php'; ?>
<?php include 'includes/head.php'; ?>


<?php include "insert/new--event.php"; ?>
<?php include "remove/del--file.php" ?>

 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php"; ?>

	<div class="container-fluid">
        <div class="box">

	<div class="row">
		<div class="container-fluid">
			<div class="calendrier mb-3">
			    <h3 class="h4 bg-white py-4 mb-0" style="border-radius:10px 10px 0 0">
			    	<center>
			    	<a href="?ym=<?php echo $prev; ?>">&lt;</a> 
			    		<?php echo $html_title; ?> 
			    	<a href="?ym=<?php echo $next; ?>">&gt;</a>
			    	</center>
			   	</h3>
			    <table class="">
			        <tr>
			            <th>L<span class="d-none d-md-inline">undi</span></th>
			            <th>M<span class="d-none d-md-inline">ardi</span></th>
			            <th>M<span class="d-none d-md-inline">ercredi</span></th>
			            <th>J<span class="d-none d-md-inline">eudi</span></th>
			            <th>V<span class="d-none d-md-inline">endredi</span></th>
			            <th>S<span class="d-none d-md-inline">amedi</span></th>
			            <th>D<span class="d-none d-md-inline">imanche</span></th>
			        </tr>
			        <?php
			            foreach ($weeks as $week) {
			                echo $week;
			            }
			        ?>
			    </table>
		    </div><!-- FIN DU CALENDRIER -->
		
			<div class="row">
				<div class="col-12">
					<h5 class="d-inline-block px-2 py-1 bg-dark text-light mb-2">Événement(s) du mois :</h5>
				</div>
				<div class="col-12 emptyMonth">
					<div class="row">
			<?php
				$sql = "SELECT * FROM events WHERE from_site = '{$website}' ORDER BY eventDate ASC";
				$query = $PDO->prepare($sql);
		        $query->execute();
		        while($date = $query->fetch(PDO::FETCH_OBJ)):

		        $eventDate = $date->eventDate;
		        $eventDateYm = before_last("-",$eventDate);
		        $eventDateFormat = new DateTime($eventDate);
		        $eventDateFormat = $eventDateFormat->format("d F Y");
		        $eventDateFormat = str_replace($english_months, $french_months, $eventDateFormat);
		        
			?>
			<?php if(!empty($eventDateYm == $_GET["ym"])): ?>
				<div class="col-12 col-md-4 mb-3">
					<div class="card">
						<div class="card-header gb-grey" style="position:relative;">
							<h5 class="card-title mb-0" style="position: relative;" id="<?php echo $date->id ?>" data-date="<?php echo $eventDate ?>"><?php echo $eventDateFormat ?> <span style="font-size:0.6em;position:relative;top:-3px;right:0px">de</span> <span class="badge badge-primary" style="font-size:0.6em;position:relative;top:-3px;right:0px"><?php echo $date->eventTime ?></span> <span style="font-size:0.6em;position:relative;top:-3px;right:0px">à</span> <span class="badge badge-primary" style="font-size:0.6em;position:relative;top:-3px;right:0px"><?php echo $date->eventTimeEnd ?></span></h5>
							
							<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
								<a href="#" class="suppr_event" id="<?php echo $date->id ?>" data-date="<?php echo $eventDateFormat ?>" data-toggle="modal" data-target="#supprimer"><i data-icon='c' class='icon'></i></a>
							<?php endif; ?>
						</div>
						<div class="card-body bg-light">
							<p class="card-text"><?php echo $date->eventTexte ?></p>
							
							<form method="POST" action="ical.php">
								<input type="hidden" name="id" value="<?= $date->id ?>">
								<input type="hidden" name="filename" value="<?= 'meeting-'.$website.'-'.$date->id.'-'.$date->eventDate ?>">
								<input type="hidden" name="start" value="<?= $date->eventDate.'T'.$date->eventTime.':00' ?>">
								<input type="hidden" name="end" value="<?= $date->eventDate.'T'.$date->eventTimeEnd.':00' ?>">
								<input type="hidden" name="description" value="<?= $date->eventTexte
								 ?>">
								<button type="submit" name="submit<?= $date->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-windows mr-2"></i> Ajouter à Outlook</button>
							</form>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php endwhile; ?>
			</div>
			</div>
			</div> <!-- row -->

			<div class="row">
				<div class="col-12">
					<h5 class="d-inline-block px-2 py-1 bg-dark text-light mb-2">Événement(s) à venir :</h5>
				</div>
				<div class="col-12 emptyComing">
					<div class="row">
			<?php
				$sql = "SELECT * FROM events WHERE from_site = '{$website}' ORDER BY eventDate ASC";
				$query = $PDO->prepare($sql);
		        $query->execute();

		        while($date = $query->fetch(PDO::FETCH_OBJ)):
		        $eventDate = $date->eventDate;
		        $eventDateYm = before_last("-",$eventDate);
		        $eventDateFormat = new DateTime($eventDate);
		        $eventDateReg = $eventDateFormat->format("d F Y");
		        $eventDateReg = str_replace($english_months, $french_months, $eventDateReg);
		        $eventMois = $eventDateFormat->format("F");
		        $eventMois = str_replace($english_months, $french_months, $eventMois);
			?>
			<?php if(!empty($eventDateYm > $_GET["ym"])): ?>
				<div class="col-12 col-md-4 mb-3">
					<div class="card">
						<div class="card-header gb-grey" style="position:relative;">
							<h5 class="card-title mb-0" style="position: relative;" id="<?php echo $date->id ?>" data-date="<?php echo $eventDate ?>"><?php echo $eventDateReg ?>  <span style="font-size:0.6em;position:relative;top:-3px;right:0px">de</span> <span class="badge badge-primary" style="font-size:0.6em;position:relative;top:-3px;right:0px"><?php echo $date->eventTime ?></span> <span style="font-size:0.6em;position:relative;top:-3px;right:0px">à</span> <span class="badge badge-primary" style="font-size:0.6em;position:relative;top:-3px;right:0px"><?php echo $date->eventTimeEnd ?></span></h5>
							
							<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
								<a href="#" class="suppr_event" id="<?php echo $date->id ?>" data-date="<?php echo $eventDateReg ?>" data-toggle="modal" data-target="#supprimer"><i data-icon='c' class='icon'></i></a>
							<?php endif; ?>
						</div>
						<div class="card-body bg-light">
							<p class="card-text"><?php echo $date->eventTexte ?></p>
							<form method="POST" action="ical.php">
								<input type="hidden" name="id" value="<?= $date->id ?>">
								<input type="hidden" name="filename" value="<?= 'meeting-'.$website.'-'.$date->id.'-'.$date->eventDate ?>">
								<input type="hidden" name="start" value="<?= $date->eventDate.'T'.$date->eventTime.':00' ?>">
								<input type="hidden" name="end" value="<?= $date->eventDate.'T'.$date->eventTimeEnd.':00' ?>">
								<input type="hidden" name="description" value="<?= $date->eventTexte
								 ?>">
								<button type="submit" name="submit<?= $date->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-windows mr-2"></i> Ajouter à Outlook</button>
							</form>
						</div>
						<div class="card-footer">
					    	<small><a class="" href="calendrier.php?ym=<?= $eventDateYm ?>">Voir le calendrier du mois <?php if($eventMois != 'Octobre' && $eventMois != 'Avril' && $eventMois != 'Août'){echo "de ";}else{ echo "d'";} ?><?= $eventMois ?> <i class="bi bi-arrow-right"></i></a></small>
					    </div>
					</div>
				</div>
			<?php endif; ?>
			<?php endwhile; ?>
			</div>
			</div>
			</div> <!-- row -->


			

		</div> <!-- / container fluid --> 
	</div> <!-- fin de row -->

 </div> <!-- / box wrapper -->

  	  </div> <!-- / container-fluid -->

    </div> <!-- /#page-content-wrapper -->

  </div> <!-- /#wrapper -->

</div>




<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="../js/datatable.js"></script>
<script type="text/javascript" src="../js/main.js"></script>


<script>
	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});
</script>

<script>
$(function(){
	if($(".emptyMonth").html().length <= 150){
		emptyDoc = '<div class="col-12">'+
			'<div class="">'+
				'<p class="">Aucun événément ce mois-ci.</p>'+
			'</div>'+
		'<div>';
		$(".emptyMonth").html(emptyDoc);
	}
})
</script>
<script>
$(function(){
	if($(".emptyComing").html().length <= 150){
		emptyDoc = '<div class="col-12">'+
			'<div class="">'+
				'<p class="">Auncun événement à venir pour le moment !</p>'+
			'</div>'+
		'<div>';
		$(".emptyComing").html(emptyDoc);
	}
})
</script>

<?php
	$sql = "SELECT * FROM events WHERE from_site = '{$website}'";
	$query = $PDO->prepare($sql);
    $query->execute();
    while($date = $query->fetch(PDO::FETCH_OBJ)):

    $eventDate = $date->eventDate;
    $eventDateYm = htmlentities(before_last("-",$eventDate));
    $eventDateFormat = new DateTime($eventDate);
    $eventDateFormat = $eventDateFormat->format("j/m/Y");

   $eventTexte = $date->eventTexte;
?>
	<script type="text/javascript">
		$(function(){
			$("td.<?php echo $eventDate ?>").html('<p style="position:relative"><?php echo before("/",$eventDateFormat)?><span class="bg-primary" style="position:absolute;top:5px;left:10px;width:15px;height:15px;border-radius:50px;display:block;" ></span></p>')
		})
	</script>

<?php endwhile; ?>



</body>        
</html>