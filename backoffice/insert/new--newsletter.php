<?php
include '../../class/bdd_connect.php';

if(!empty($_POST['website'])){

    $news_prenom    = $_POST['news_prenom'];
    $news_nom       = $_POST['news_nom'];
    $news_mail      = $_POST['news_mail'];
    $website        = $_POST['website'];

    try{
        $insert = $PDO->prepare("INSERT INTO newsletter (news_prenom, news_nom, news_mail, from_site) VALUES (:news_prenom, :news_nom, :news_mail, :from_site)");
        $insert->bindParam(':news_prenom', $news_prenom);
        $insert->bindParam(':news_nom', $news_nom);
        $insert->bindParam(':news_mail', $news_mail);
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
        CURLOPT_POSTFIELDS => "{\"attributes\":{\"PRENOM\":\"$news_prenom\",\"NOM\":\"$news_nom\"},\"listIds\":[7],\"updateEnabled\":true,\"email\":\"$news_mail\"}",
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
?>