<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$siteKey 		= $_ENV['API_SITE_v3'] ; 
$secretKey     	= $_ENV['API_SECRET_v3'] ;

$recipientEmail = 'm.heilikman@gmail.com'; 
 
$postData = $valErr = $statusMsg = $api_error = ''; 
$status = 'error'; 
 
if(isset($_POST['submit_frm'])){ 

    $postData       = $_POST; 
    $prenom         = trim($_POST['prenom']); 
    $nom            = trim($_POST['nom']); 
    $email          = trim($_POST['email']); 
    $tel            = trim($_POST['tel']); 
    $subject        = trim($_POST["subject"]);
    $message        = $_POST['message']; 
    $message        = str_replace("\n","</br>", $message);
 

    if(empty($prenom)){ 
        $valErr .= 'Merci de bien vouloir entrer votre prénom.<br/>'; 
    } 
    if(empty($nom)){ 
        $valErr .= 'Merci de bien vouloir entrer votre nom.<br/>'; 
    } 
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
        $valErr .= 'Merci de bien vouloir entrer un mail valide.<br/>'; 
    } 
    if(empty($message)){ 
        $valErr .= 'Veuillez taper un message.<br/>'; 
    } 
 

    if(empty($valErr)){ 
        // Validate reCAPTCHA response 
        if(!empty($_POST['g-recaptcha-response'])){ 
 
            // Google reCAPTCHA verification API Request 
            $api_url = 'https://www.google.com/recaptcha/api/siteverify'; 
            $resq_data = array( 
                'secret' => $secretKey, 
                'response' => $_POST['g-recaptcha-response'], 
                'remoteip' => $_SERVER['REMOTE_ADDR'] 
            ); 
 
            $curlConfig = array( 
                CURLOPT_URL => $api_url, 
                CURLOPT_POST => true, 
                CURLOPT_RETURNTRANSFER => true, 
                CURLOPT_POSTFIELDS => $resq_data, 
                CURLOPT_SSL_VERIFYPEER => false 
            ); 
 
            $ch = curl_init(); 
            curl_setopt_array($ch, $curlConfig); 
            $response = curl_exec($ch); 
            if (curl_errno($ch)) { 
                $api_error = curl_error($ch); 
            } 
            curl_close($ch); 
 

            $responseData = json_decode($response); 
 
            if(!empty($responseData) && $responseData->success){ 
                // Send email notification to the site admin 
                $to = $recipientEmail; 
                if($subject == 'contact'):
                    $subject = "CGMR | Demande de contact";
                elseif($subject == 'informations'):
                    $subject = "CGMR | Demande d'informations";
                elseif($subject == 'devis'):
                    $subject = "CGMR | Demande de devis";
                endif; 

                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.ionos.fr'; 
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'no_reply@cgmr.fr';
                    $mail->Password   = $_ENV['MDP_NOREPLY']; 
                    $mail->SMTPSecure = 'tls';
                    $mail->CharSet = 'UTF-8';
                    $mail->Port       = 587;
                    $mail->setFrom('no_reply@cgmr.fr', 'noreply.cgmr');
                    $mail->addAddress(''.$recipientEmail.'', ''.$prenom.' '.$nom.'');
                    $mail->isHTML(true);
                    $mail->Subject = $subject ;
                    $mail->Body    = '
                    <html>
                    <head>
                    <title>'.$subject.'</title>
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
                                   ' . $message . '
                             </td>
                             <td width="20"></td>
                          </tr>

                          <tr>
                             <td width="20"></td>
                             <td>
                                    '.$prenom.' '.$nom.' <br>
                                    <span style="font-style:italic;font-size:11px;color:black;">'.$email.'</span> / '.$tel.' </p>
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
                    $mail->AltBody = $message ;
                
                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                 
                $status = 'success'; 
                $statusMsg = 'Merci ! votre demande de contact bien été envoyée.'; 
                $postData = '';

                $news_prenom    = $prenom;
                $news_nom       = $nom;
                $news_mail      = $email;
                if(substr($tel,0,1) == "0"){
                    $change_tel = after(0,$tel);
                    $news_tel = "33".$change_tel;
                }else{
                    $news_tel = $tel;
                } 
                    
                    try{
                        $insert = $PDO->prepare("INSERT INTO newsletter (news_prenom, news_nom, news_mail, news_tel, from_site) VALUES (:news_prenom, :news_nom, :news_mail, :news_tel, :from_site)");
                        $insert->bindParam(':news_prenom', $news_prenom);
                        $insert->bindParam(':news_nom', $news_nom);
                        $insert->bindParam(':news_mail', $news_mail);
                        $insert->bindParam(':news_tel', $news_tel);
                        $insert->bindParam(':from_site', $website);
                        $insert->execute();
                
                        $curl = curl_init();
                
                        curl_setopt_array($curl, [
                        CURLOPT_URL => "https://api.brevo.com/v3/contacts",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => json_encode([
                            'attributes' => [
                                'PRENOM' => ''.$news_prenom.'',
                                'NOM' => ''.$news_nom.'',
                                'SMS' => ''.$news_tel.''
                            ],
                            'updateEnabled' => true,
                            'email' => ''.$news_mail.'',
                            'listIds' => [
                                7
                            ]
                        ]),
                        CURLOPT_HTTPHEADER => [
                            "accept: application/json",
                            "api-key:".$_ENV['BREVO_API_KEY']."",
                            "content-type: application/json"
                        ],
                        ]);
                
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                
                        curl_close($curl);
                
                    } catch (PDOException $e) {
                        echo 'PDOException : '.  $e->getMessage();
                    }
            }else{ 
                $statusMsg = !empty($api_error)?$api_error:'Echec de la vérification du reCAPTCHA.'; 
            } 
        }else{ 
            $statusMsg = 'Something went wrong, please try again.'; 
        } 
    }else{ 
        $valErr = !empty($valErr)?'<br/>'.trim($valErr, '<br/>'):''; 
        $statusMsg = 'Merci de de remplir tous les champs obligatoires:'.$valErr; 
    } 
} 