<?php
require "includes/session-Auth.php";
include 'includes/recup_mail.php';
$page = "recuperation" ;
$title = "Password recovery";
$pageURL = $page;
if(isset($_GET['a'])){
    $_SESSION['recup_mail']=$_GET['a'];
}
?>
<?php include "includes/doctype.php" ?>

<?php include "includes/nav.php" ?>


<div class="container mt-5">

	<div class="d-flex flex-wrap">

        <div class="col-12 col-md-6 me-5">
            <h3 class="h3 text-primary mb-1">Forgot your password?</h3>
            <p class="mb-0"><small class="text-body-secondary">Password recovery process :</small></p>
            <?php if(isset($errorDanger)) { echo '<div class="mt-3 mb-0 alert alert-danger" role="alert">'.$errorDanger.'</div>'; } else { echo ""; } ?>
            <?php if(isset($errorWarning)) { echo '<div class="mt-3 mb-0 alert alert-warning" role="alert">'.$errorWarning.'</div>'; } else { echo ""; } ?>
            <?php if(isset($errorInfo)) { echo '<div class="mt-3 mb-0 alert alert-info" role="alert">'.$errorInfo.'</div>'; } else { echo ""; } ?>
        </div>

        <div class="col-12 col-md-6 mt-3">
            <?php if($section == 'code' OR $section == 'code?a='.@$_SESSION["recup_mail"]) { ?>
                <p class="mb-2 text-body-secondary">Step 2/3</p>
                <p class="mb-0">A verification code has been sent by email to: <b><?php echo $_SESSION['recup_mail'] ?></b></p>
                <small class="text-body-secondary mb-2 d-block">Please check your spam folder if you don't see the email. Otherwise, go back to the <a href="recuperation.php">previous step</a>.</small>
                
                <form method="post" class="form-group">
                    <label for="typeCode"><small>Enter your code :</small></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="typeCode" placeholder="Type here your 8 numbers code" name="verif_code"/>
                            <label for="typeCode" class="text-black">Type here your 8 numbers code</label>
                        </div>
                    </div>
                    <button type="submit" value="PASSER À L'ÉTAPE SUIVANTE" name="verif_submit" class="btn btn-block btn-primary">NEXT STEP <i class="bi bi-arrow-right"></i></button>
                </form>

            <?php } elseif($section == "changemdp") { ?>
                <p>Create a new password for : <b><?php echo $_SESSION['recup_mail'] ?></b></p>
                <p class="mb-2 text-body-secondary">Step 3 / 3</p>

                <form method="post" class="form-group">
                    <div class="input-group mb-3">
                        <div class="form-floating show_hide_password">
                            <input type="password" name="change_mdp" class="form-control" id="changemdp1" placeholder="entrez votre mot de passe">
                            <label for="changemdp1" class="text-black">New password</label>
                        </div>
                        <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating show_hide_password">
                            <input type="password" name="change_mdpc" class="form-control" id="changemdp2" placeholder="entrez votre mot de passe">
                            <label for="changemdp2" class="text-black">Confirm password</label>
                        </div>
                        <span class="input-group-text"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
                    </div>

                    <button type="submit" name="change_submit" class="btn btn-block btn-primary">CONFIRM AND LOGIN <i class="bi bi-fingerprint"></i></button>
                </form>

            <?php } else { ?>
                <p class="mb-2 text-body-secondary">Step 1 / 3</p>
                <form method="post" class="form-group">
                    <label for="typeMail"><small>Type your email :</small></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">@</span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="typeMail" placeholder="exemple@societe.fr" name="recup_mail"/>
                            <label for="typeMail" class="text-black">Email</label>
                        </div>
                    </div>
                    <button type="submit" name="recup_submit" class="btn btn-block btn-primary">NEXT STEP <i class="bi bi-arrow-right"></i></button>
                </form>
            <?php } ?>

        </div>
        

	</div>
	
</div> <!-- container -->
	

<?php include 'includes/footer.php' ?>
<?php include 'includes/end.php' ?>