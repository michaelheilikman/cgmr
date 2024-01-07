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

require __DIR__ . '/../vendor/autoload.php';

if($_SERVER['HTTP_HOST'] == "localhost"){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
    $host 		= $_ENV['DB_HOST_LOCAL'];
	$login		= $_ENV['DB_USER_LOCAL'];
	$pass 		= $_ENV['DB_PASSWORD_LOCAL'];
    $bdd		= $_ENV['DB_NAME_LOCAL'];
    $path       = "http://".$_SERVER['SERVER_NAME']."/".$website."/";
}else{
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
