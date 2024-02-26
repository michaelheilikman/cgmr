<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_GET['section'])) {
  $section = htmlspecialchars($_GET['section']);
}else{
  $section ="";
}


if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $PDO->prepare('SELECT id,prenom,nom,from_site FROM users WHERE (from_site = "'.$website.'" OR from_site = "") AND mail = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         
         if($mailexist_count == 1) {
            $prenom = $mailexist->fetchAll();

            $_SESSION['recup_mail'] = $recup_mail;
            $recup_code = "";
            
            for($i=0; $i < 8; $i++){ 
               $recup_code .= mt_rand(0,9);
            }

            $mail_recup_exist = $PDO->prepare('SELECT id FROM recuperation WHERE mail = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();

            if($mail_recup_exist == 1) {
               $recup_update = $PDO->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
               $recup_update->execute(array($recup_code,$recup_mail));
            }else{
               $recup_insert = $PDO->prepare('INSERT INTO recuperation(mail,code) VALUES (?, ?)');
               $recup_insert->execute(array($recup_mail,$recup_code));
            }

            try {
               //Server settings
               //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
               $mail->isSMTP();                                            // Send using SMTP
               $mail->Host       = 'smtp.ionos.fr';                   // Set the SMTP server to send through
               $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
               $mail->Username   = 'no_reply@cgmr.fr';                  // SMTP username
               $mail->Password   = $_ENV['MDP_NOREPLY'];                               // SMTP password
               //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
               $mail->SMTPSecure = 'tls';
               $mail->CharSet = 'UTF-8';
               $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
           
               //Recipients
               $mail->setFrom('no_reply@cgmr.fr', 'noreply.cgmr');
               $mail->addAddress(''.$recup_mail.'', ''.strtoupper($prenom[0]->prenom).' '.strtoupper($prenom[0]->nom).'');     // Add a recipient
               // $mail->addAddress('claire.benes@ifip.asso.fr', 'Claire Benes');     // Add a recipient
               // $mail->addAddress('ellen@example.com');               // Name is optional
               // $mail->addReplyTo('info@example.com', 'Information');
               //$mail->addCC('claude.montariol@ifip.asso.fr');
               // $mail->addBCC('bcc@example.com');
           
               // Attachments
               // $mail->addAttachment('C:\Temp\imgtest.png');         // Add attachments
               // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
           
               // Content
               $mail->isHTML(true);                                  // Set email format to HTML
               $mail->Subject = '"'.strtoupper($website).'" - Changez de mot de passe';
               $mail->Body    = '
               <html>
               <head>
               <title>Récupération de mot de passe</title>
               <meta charset="utf-8" />
               </head>
               <body>
                  <div align="center">
                     <table width="600" margin="0" padding="0" style="border-collapse: collapse;font-family: helvetica, arial sans-serif;">
   
                     <tr>
                        <td colspan="3">
                           <center><img src="'.$liveURL.'/img/'.$logo.'?v='.$noCacheFile.'" height="100"></center>
                        </td>
                     </tr>
   
                     <tr>
                        <td colspan="3" height="30"></td>
                     </tr>
   
                     <tr>
                        <td width="20"></td>
                        <td>
                              <h2>Bonjour '.strtoupper($prenom[0]->prenom).'! 🖐</h2>
                              <p>Votre code de récupération à copier et coller dans le champ dédié de l\'étape 2 / 3 : </p>
                              <p style="font-size:30px;margin-top:20px;margin-bottom:20px;">'.$recup_code.'</p>
                              <p>Si vous avez perdu la page de récupération du mot de passe, vous pouvez <a href="'.$liveURL.'/recuperation.php?section=code&a='.$recup_mail.'">cliquez-ici</a> et retourner à l\'étape 2 / 3. Il vous suffira de coller votre code de récupération dans le champ dédié à cet effet.</p>
                              <p>Merci et à bientôt sur <a href="'.$liveURL.'">'.$liveURL.'</a> !</p>
                              
                        </td>
                        <td width="20"></td>
                     </tr>
   
                     <tr>
                        <td colspan="3" height="10" bgcolor="#ffffff"></td>
                     </tr>
   
                     <tr>
                        <td colspan="3" height="5" bgcolor="#000000"></td>
                     </tr>
   
                     <tr>
                        <td colspan="3" bgcolor="#000000" color:#ffffff;>
                           <center color:#ffffff;><a style="font-size:12px;color:#ffffff;" href="'.$liveURL.'">'.$liveURL.'</a> | <a style="font-size:12px;color:#ffffff;" href="mailto:'.$administrator.'">contactez-nous</a></center>
                        </td>
                     </tr>
   
                     <tr>
                        <td colspan="3" height="5" bgcolor="#000000" style="font-size:12px;border-radius:0 0 5px 5px;"></td>
                     </tr>
   
                     <tr>
                        <td colspan="3" align="center">
                           <font size="2">
                           Ceci est un email automatique, merci de ne pas y répondre.
                           </font>
                        </td>
                     </tr>
                     </table>
                  </div>
               </body>
               </html>
               ';
               $mail->AltBody = 'Merci de bien vouloir copier et coller le code de récupération suivant: '.$recup_code.'';
           
               $mail->send();
               //echo 'Gestion Message has been sent';
           } catch (Exception $e) {
               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           }
            
           header('location:recuperation.php?section=code');
         } else {
            $errorInfo = "<span class='font-weight-bold'>Cette adresse mail n'est pas enregistrée</span>.<br> <small>Si vous ne pensez pas posséder de compte, veuillez contacter l'<a href='mailto:".$administrateur."?subject=Demande de création de compte pour le site ".$website."'>administrateur</a>, ou réessayez avec une autre adresse mail.</small>";
         }
      } else {
         $errorDanger = "<span class='font-weight-bold'>Le format saisi ne correspond pas à une adresse mail valide !</span>";
      }
   } else {
      $errorWarning = "<span class='font-weight-bold'>Veuillez entrer votre adresse mail</span>";
   }
}
if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $PDO->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
      $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
      $verif_req = $verif_req->rowCount();
      if($verif_req == 1) {
         $up_req = $PDO->prepare('UPDATE recuperation SET confirme = 1 WHERE mail = ?');
         $up_req->execute(array($_SESSION['recup_mail']));
         header('location:recuperation.php?section=changemdp');
      } else {
         $errorDanger = "<span class='font-weight-bold'>Code invalide</span>";
      }
   } else {
      $errorWarning = "<span class='font-weight-bold'>Veuillez entrer votre code de confirmation</span>";
   }
}
if(isset($_POST['change_submit'])) {

   if(!empty($_POST['change_mdp'] AND $_POST['change_mdpc'])) {
      $verif_confirme = $PDO->prepare('SELECT * FROM recuperation');
      $verif_confirme->execute();
      $verif_confirme = $verif_confirme->fetchAll();
      //var_dump($verif_confirme[0]->confirme);

      if($verif_confirme[0]->confirme == 1) {
         $mdp = $_POST['change_mdp'];
         $mdpc = $_POST['change_mdpc'];
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
               $mdp = md5($mdp);
               $mdpc = md5($mdpc);

              $ins_mdp = $PDO->prepare('UPDATE users SET password = ? WHERE mail = ?');
              $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));

              $del_req = $PDO->prepare('DELETE FROM recuperation WHERE id = ?');
              $del_req->execute();
              header('location:index.php');
            } else {
               $errorWarning = "Vos mots de passe ne correspondent pas";
            }
         } else {
            $errorWarning = "Veuillez remplir tous les champs";
         }
      } else {
         $errorDanger = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }

   } else {
      $errorWarning = "Veuillez remplir tous les champs";
   }
}
?>