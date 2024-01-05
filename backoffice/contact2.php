<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'contact' ;
$Auth->allow('users');
$typeOfDoc = "contact";
$subPage = 'entreprise';
?>

<?php include 'includes/head.php'; ?>



<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
	<?php include "insert/new--user.php" ?>
	<?php include "insert/new--company.php" ?>
	<?php include "insert/new--action.php" ?>
<?php endif;?>
<?php include "remove/del--file.php" ?>
<?php include "edit/edit--user.php" ?>
<?php include "edit/edit--company.php" ?>
<?php include "edit/edit--action.php" ?>

 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

		<div class="container-fluid">
		    <div class="box">
			
		    	<ul class="tabulation">
		    		<div class="d-flex justify-content-between">
						<div class="tabs row" id="tabs1">
							<li class="mr-1"><a href="#contacts">Contacts</a></li>
							<li class="mr-1"><a href="#entreprises">Entreprises</a></li>
							<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
							<li class="mr-1"><a href="#roles">Roles</a></li>
							<?php endif ; ?>
						</div>
						<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
						<div class="mr-0 mt-3">
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<ion-icon style="font-size:1.2em;position: relative;top:3px;" name="document"></ion-icon> Export Rôle
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<?php 
										$sql = "SELECT * FROM actions WHERE from_site = '{$website}' ORDER BY action ASC";
								        $query = $PDO->prepare($sql);
								        $query->execute();
								        while($data = $query->fetch(PDO::FETCH_OBJ)){
									?>
										<form action="export.php" method="POST" class="dropdown-item">
											<input type="hidden" name="role_projet" value="<?php echo $data->action ?>">
											<button style="border:none;background:none;" type="submit"><?php echo $data->action ?></button>
										</form>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php endif; ?>

					</div>
				</ul>

				<div class="content">
					<div id="contacts">
						<?php include "includes/contacts_list.php" ?>
					</div>

					<div id="entreprises">
						<?php include "includes/entreprises_list.php" ?>
					</div>

					<div id="roles">
						<?php include "includes/actions_list.php" ?>
					</div>

				</div>

		    </div> <!-- / box -->
	  	</div> <!-- / container-fluid -->

    </div> <!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="../js/jquery-cookie.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="https://use.fontawesome.com/b9bdbd120a.js"></script>
<script type="text/javascript" src="../js/main.js"></script>


<script>
	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});
</script>


<script type="text/javascript">
$(function(){
	if($(".wrapper").html().length <= 2000){
		emptyDoc = '<div class="col-12">'+
			'<div class="mt-4">'+
				'<p class="text-center">Cliquez ci-dessous pour créer un nouvel utilisateur</p>'+
				<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
				'<center class="mt-1"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#new-user">Ajouter un nouvel utilisateur</a></center>'+
				<?php endif; ?>
			'</div>'+
		'<div>';
		$(".wrapper").html(emptyDoc);
	}
})
</script>




</body>        
</html>