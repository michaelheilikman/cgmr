<?php
$sql = "SELECT * FROM visitors";
$req = $PDO->prepare($sql);
$req->execute();
while($data = $req->fetch(PDO::FETCH_OBJ)){

    echo '"'.$data->countryCode.'": {"latitude":'.$data->latitude.', "longitude":'.$data->longitude.'},';

}
?>