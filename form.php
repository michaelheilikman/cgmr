<?php
if (!empty($_POST)) {
    if($captcha->isValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']) === false){
        
        $error_msg = 'Le captcha ne semble pas valide';

    } else {

        $emailto   = "m.heilikman@gmail.com";
        $prenom     = $_POST["prenom"];
        $nom        = $_POST["nom"];
        $email      = $_POST["email"];
        $tel      = $_POST["tel"];
        $subject    = $_POST["subject"];
        if($subject == 'contact'):
            $subject = "CGMR | Demande de contact";
        elseif($subject == 'informations'):
            $subject = "CGMR | Demande d'informations";
        elseif($subject == 'devis'):
            $subject = "CGMR | Demande de devis";
        endif;
        $message    = stripslashes($_POST["message"]);
        $message    = str_replace("\n","</br>", $message);

        $text ='
        <table border="0" margin="0" padding="0" width="500">
            <tr>
                <td style="padding:10px;">
                    <p style="font-size:15px">'.$message.'</p>
                </td>
            <tr>
            <tr>
                <td style="padding:10px;">
                    <p style="font-weight:bold;font-size:13px">'.$prenom.' '.$nom.' <br>
                    <span style="font-style:italic;font-size:11px;color:black;">'.$email.'</span> / '.$tel.' </p>
                 </td>
             </tr>
         </table>
         ';
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html; charset=utf-8" . "\r\n"; 
        $headers .= "From: <$email>" . "\r\n";
        mail($emailto, $subject, $text, $headers);
    
         $success_msg = 'Merci pour votre email';


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
        
    } 
}
?>