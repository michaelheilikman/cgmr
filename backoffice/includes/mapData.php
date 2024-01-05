<?php
$sql = "SELECT countryCode,country FROM visitors WHERE from_site = '$website'";
$req = $PDO->prepare($sql);
$req->execute();
$data = $req->fetchAll(PDO::FETCH_OBJ);

//echo count($data);

foreach($data AS $datas):
    $CC[] = $datas->countryCode;
    $view = implode(';',$CC);
    $views = explode(';',$view);

    $country[] = $datas->country;
    $viewC = implode(';',$country);
    $viewsC = explode(';',$viewC);
endforeach;

$valeurParPage = array_count_values($views);
arsort($valeurParPage);
$page = array_keys($valeurParPage);
$valeur = array_values($valeurParPage);

$valeurParPageC = array_count_values($viewsC);
arsort($valeurParPageC);
$pageC = array_keys($valeurParPageC);
$valeurC = array_values($valeurParPageC);

for ($i=0; $i <= count($valeurParPage) ; $i++):
    if(isset($page[$i])){
        echo "{";
        print_r('"id":"'.$page[$i].'", "name":"'.$pageC[$i].'", "value" :'.$valeur[$i]);
        echo "},";
    }
endfor;
?>