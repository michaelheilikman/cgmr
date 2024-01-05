<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'account' ;
$Auth->allow('users');
?>

<?php include 'includes/head.php'; ?>

<?php
if (isset($_POST['password--edit'])) {
	$mail = $_POST['mail'];
	$pass_old = md5($_POST['pass_old']);
    $new_pass = md5($_POST['new_pass']);
    $new_pass_conf = md5($_POST['new_pass_conf']);
    
// tu récupère ancien mot de passe dans la bdd

$sql="SELECT * FROM users WHERE nom='{$_GET['user']}'";
$sth = $PDO->prepare($sql);
$sth->execute();
$data = $sth->fetch(PDO::FETCH_OBJ);

	if ($new_pass === $new_pass_conf)
	{
	    //tu vérifie s'il sont identiques
	    if ($data->password === $pass_old)
	    {
	        //si oui tu update et encrypte le nouveau mot de passe dans la bdd
	 	 
			$sql="UPDATE users SET password='$new_pass', passwordCheck = '$pass_old' WHERE mail = '$mail'";
			$sth = $PDO->prepare($sql);
			$sth->execute();
	 
	        $Confirmation = "<div class='alert alert-success' role='alert'>Le mot de passe a bien été changé</div>";
	    }
	    else
	    {
	        $UnvalidFormer = "<div class='alert alert-danger' role='alert'>Mot de passe incorrect !</div>";
	    }
	}
	else
	{
		$UnConfirmed =  "<div class='alert alert-warning' role='alert'>Le mot de passe de confirmation n'est pas correct ! Veuillez réessayer.</div>";
	}
}
?>

 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

		<div class="container-fluid d-flex flex-wrap">
                <?php
                    $sql = "SELECT * FROM users WHERE from_site = '{$website}' AND nom='{$_GET['user']}'";
                    $query = $PDO->prepare($sql);
                    $query->execute();
                    $user = $query->fetch(PDO::FETCH_OBJ);
                ?>

            <div class="col-12 col-md-6 px-3 py-5">
                <h5>Changer de mot de passe :</h5>
                <?php if (isset($_POST['password--edit'])) {
                    echo @$Confirmation;
                    echo @$UnvalidFormer;
                    echo @$UnConfirmed;
                }
                ?>
                <form action="" method="POST" >
                    <div class="form-group col-12">
                        <label>Adresse mail</label>
                        <input type="mail" class="form-control" name="mail" value="<?php echo @$user->mail ?>">
                    </div>
                    <div class="form-group col-12">
                        <label>Ancien mot de passe</label>
                        <div class="input-group show_hide_password">
                            <input type="password" class="form-control" name="pass_old">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label>Nouveau mot de passe</label>
                        <div class="input-group show_hide_password">
                            <input type="password" class="form-control" name="new_pass">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label>Confirmer mot de passe</label>
                        <div class="input-group show_hide_password">
                            <input type="password" class="form-control" name="new_pass_conf">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <button class="btn btn-primary w-100" type="submit" name="password--edit">Changer le mot de passe</button>
                    </div>
                </form>
            </div>

	  	</div> <!-- / container-fluid -->

    </div> <!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="../js/jquery-cookie.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="../js/main.js"></script>


<script>
	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});
</script>


</body>        
</html>