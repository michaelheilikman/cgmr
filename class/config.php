<?php
$website = "cgmr";
$logo = "logo.png";
$administrator = "m.heilikman@gmail.com";
$websiteDetail = "CGMR";
$googleSearchConsole = "";
$replyTo = "artus.bertin@gmail.com";
$author = "Artus Bertin";
$company = "cgmr";
$liveURL = "https://cgmr.fr";
$noCacheFile = strtotime(Date('Y-m-d h:i:s'));

if($_SERVER['HTTP_HOST'] == "localhost"){
    $host 		= "localhost";
    $login		= "root";
	$pass 		= "root";
    $bdd		= "cgmr";
    $path       = "http://".$_SERVER['SERVER_NAME']."/".$website."/";
}else{
    $host 		= "db5014728913.hosting-data.io";
	$login		= "dbu1219705"; 
	$pass 		= "Cgmr@2023+!AbMh";
    $bdd		= "dbs12237937";
    global $path;
    $path       = "https://".$_SERVER['SERVER_NAME']."/";
}

include 'words.php';
