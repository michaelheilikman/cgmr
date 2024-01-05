<?php
include 'includes/session-Auth.php';
require 'includes/recaptcha.php';
$captcha = new Recaptcha('6LfDgIIeAAAAAPcC8Ro0M32xehY5j6xqVuPWMVr8', '6LfDgIIeAAAAAJuguq8i7O58uA5HjWo-ldmASx4m');
$page = 'contact';
$pageURL = 'contact-me';
$pageDesc = "Get in touch</span>, I'd ❤ to hear from you!";
?>
<?php include "form.php" ?>

<?php include "includes/doctype.php" ?>

<?php include "includes/nav.php" ?>

<?php include "includes/getintouch.php" ?>

<section class="container d-flex justify-content-center mb-5 pb-5">

    
    <form class="d-flex flex-wrap justify-content-start col-12 col-md-9 mt-3 mb-5" id="contactForm" action="" method="POST">

        <?php
            if(isset($error_msg))
            {
                echo '<div class="form-group col-12 col-md-12">
                    <div class="alert alert-danger">'.$error_msg.'</div>
                </div>';
            }

            if(isset($success_msg))
            {
                echo '<div class="form-group col-12 col-md-12">
                    <div class="alert alert-success">'.$success_msg.'</div>
                </div>';
            }

        ?>
        <section class="row g-3 mb-3">
            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="First Name">
                    <label for="prenom" class="text-black">First Name</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Last Name">
                    <label for="nom" class="text-black">Last Name</label>
                </div>
            </div>

            <div class="form-floating mb-3 col-12 col-md-6">
                <input type="email" class="form-control" id="mail" name="email" placeholder="email">
                <label for="mail" class="text-black">email</label>
            </div>

            <div class="form-floating mb-3 col-12">
                <input type="text" class="form-control" id="objet" name="subject" placeholder="Objet">
                <label for="objet" class="text-black">Objet :</label>
            </div>
            <div class="form-group mb-3 col-12">
                <label for="message">Votre message :</label>
                <textarea id="summernote1" class="form-control" id="message" name="message" style="background-color:white"></textarea>
            </div>
            <div class="form-group mb-3col-12 mb-3">
                <?php echo $captcha->html(); ?>
            </div>
            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary btn-block">Envoyer le message</button>
            </div>
        </section>
    </form>

</section>

<?php include 'includes/footer.php' ?>
<?php include 'includes/end.php' ?>