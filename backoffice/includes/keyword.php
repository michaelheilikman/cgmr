<?php
$dem = "SELECT * FROM keywords WHERE from_site= '$website'";
$req = $PDO->prepare($dem);
$req->execute();
$key = $req->fetchAll(PDO::FETCH_OBJ);

foreach ($key as $keys):
    if(isset($keys->key_name)):
        echo '<option value="'.$keys->key_name.'">'.$keys->key_name.'</option>';
    endif;
endforeach;