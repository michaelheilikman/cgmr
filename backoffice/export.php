<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$Auth->allow('users');

extract($_POST);
$role_projet = $_POST['role_projet'];
$role = suppr_accents($role_projet);
$role = str_replace(" ", "_", $role);

$req = $PDO->prepare("SELECT from_site as SITE, role_projet as ROLE, prenom as PRENOM, nom as NOM, fonction as FONCTION, mail as EMAIL, entreprise as ENTREPRISE, gouvernance as GOUVERNANCE, adresse as ADRESSE, cp as CODE_POSTAL, ville as VILLE, telFix as TELEPHONE, telMob as MOBILE, dateDebut as INSCRIPTION FROM users WHERE from_site = '{$website}' AND CONCAT('; ',`role_projet`,';') LIKE '%; {$role_projet};%' ORDER BY nom ASC");
$req -> execute();
$data = $req->fetchAll(PDO::FETCH_ASSOC);

require 'class.csv.php';
CSV::export($data,$website.'-'.$role.'-'.date("d-m-Y"));
?>