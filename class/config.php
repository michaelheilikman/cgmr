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
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();

    $host 		= $_ENV['DB_HOST'];
	$login		= $_ENV['DB_USER'];
	$pass 		= $_ENV['DB_PASSWORD'];
    $bdd		= $_ENV['DB_NAME'];
    global $path;
    $path       = "https://".$_SERVER['SERVER_NAME']."/";
}

include 'words.php';
