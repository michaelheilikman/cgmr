<?php
session_start();
require __DIR__ .'/../class/bdd_connect.php';
require __DIR__ .'/../class/class.auth.php';
if(!empty($_POST['password']) AND !empty($_POST['mail'])){
    if($Auth->login($_POST) && $Auth->user('password') != $Auth->user('passwordCheck') ){
        if($Auth->user('role') == 'superAdmin' || $Auth->user('role') == 'admin' || $Auth->user('role') == 'autre'){
            header('Location:'.$path.'/backoffice/index.php?user='.$Auth->user("prenom").'_'.$Auth->user("nom").'');
            die();
        }
    }elseif($Auth->login($_POST) && $Auth->user('password') == $Auth->user('passwordCheck') ){
        header('Location:'.$path.'/backoffice/compte.php?user='.$Auth->user("nom").'');
        die();
    }else{
        $error = '<div class="flex-grid notification spaceBetween notify--danger"><div class="d-col-11 t-col-11 m-col-11">'.$Auth->erreur.'</div><div class="d-col-1 t-col-1 m-col-1"><span class="floatR close">x</span></div></div>';
    }
}
?>