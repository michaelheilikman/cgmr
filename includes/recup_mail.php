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
               $mail->Username   = 'no_reply@michaelheilikman.com';                  // SMTP username
               $mail->Password   = 'Mike@3138142';                               // SMTP password
               //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
               $mail->SMTPSecure = 'tls';
               $mail->CharSet = 'UTF-8';
               $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
           
               //Recipients
               $mail->setFrom('no_reply@michaelheilikman.com', 'noreply.michaelheilikman');
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
                              <h2>Hi '.strtoupper($prenom[0]->prenom).'! 🖐</h2>
                              <p>Your recovery code to copy and paste into the dedicated field at the step 2 of 3: </p>
                              <p style="font-size:30px;margin-top:20px;margin-bottom:20px;">'.$recup_code.'</p>
                              <p>If you have lost the password recovery page, you can <a href="'.$liveURL.'/recuperation.php?section=code&a='.$recup_mail.'">click here</a> and go back to the step 2 of 3. You just need to paste your recovery code into the field dedicated for this purpose.</p>
                              <p>Thank you and see you soon at <a href="'.$liveURL.'">'.$liveURL.'</a> !</p>
                              
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
                           <center color:#ffffff;><a style="font-size:12px;color:#ffffff;" href="'.$liveURL.'">'.$liveURL.'</a> | <a style="font-size:12px;color:#ffffff;" href="mailto:'.$administrator.'">contact us</a></center>
                        </td>
                     </tr>
   
                     <tr>
                        <td colspan="3" height="5" bgcolor="#000000" style="font-size:12px;border-radius:0 0 5px 5px;"></td>
                     </tr>
   
                     <tr>
                        <td colspan="3" align="center">
                           <font size="2">
                           This is an automated email, please do not reply to it.
                           </font>
                        </td>
                     </tr>
                     </table>
                  </div>
               </body>
               </html>
               ';
               $mail->AltBody = 'Please kindly copy and paste the following recovery code: '.$recup_code.'';
           
               $mail->send();
               //echo 'Gestion Message has been sent';
           } catch (Exception $e) {
               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           }
            
            header('location:recuperation.php?section=code');
         } else {
            $errorInfo = "<span class='font-weight-bold'>This email address is not registered.</span><br> <small>If you don't think you have an account, please contact the <a href='mailto:".$administrator."?subject=Account creation request for ".$website." website'>administrator</a>, or try again with a different email address.</small>";
         }
      } else {
         $errorDanger = "<span class='font-weight-bold'>The format entered does not correspond to a valid email address!</span>";
      }
   } else {
      $errorWarning = "<span class='font-weight-bold'>Please enter your email address</span>";
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
         $errorDanger = "<span class='font-weight-bold'>Invalid recovery code</span>";
      }
   } else {
      $errorWarning = "<span class='font-weight-bold'>Please enter your confirmation password</span>";
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
               $errorWarning = "Your passwords do not match.";
            }
         } else {
            $errorWarning = "Please fill in all fields.";
         }
      } else {
         $errorDanger = "Please verify your email by using the verification code that was sent to you by email.";
      }

   } else {
      $errorWarning = "Please fill in all fields.";
   }
}
?>