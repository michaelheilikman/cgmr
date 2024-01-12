<?php 
require_once __DIR__.'/config.php';

if (!isset($PDO)) {
    try{
        $PDO = new PDO("mysql:host=$host;dbname=$bdd",$login,$pass);
        $PDO->exec("SET NAMES 'UTF8'"); 
        $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'Connexion impossible: '. $e;
    }
}