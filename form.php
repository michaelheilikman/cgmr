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
    } 
}
?>