<?php 
$roles = [];

class Auth{
    
    var $forbiddenPage = "forbidden.php";
    
    /**
     * Permet d'identifier un utilisateur
     **/
    function login($d){
        global $PDO; 
        $req = $PDO->prepare('SELECT users.id,users.from_site,users.password,users.passwordCheck,users.prenom,users.mail,users.role_projet,users.nom,users.active,users.role_id,roles.name,roles.slug,roles.level,roles.id FROM users LEFT JOIN roles ON users.role_id=roles.id WHERE mail =:mail AND password=md5(:password) AND (from_site=:from_site OR from_site="")' );
        $req->execute($d); 
        $data = $req->fetchAll();
        if(count($data)>0){
                $_SESSION['Auth'] = $data[0]; 
                return true;
        }
        $this->erreur = 'Votre identifiant ou mot de passe n\'est pas correct. <a href="#" data-popbox="extranet" class="">Rééssayez à nouveau</a> ou contactez <a href="mailto:michael.heilikman@ifip.asso.fr" class="">le référent du projet</a>';
        return false; 
    }
    
    /**
     * Autorise un rang à accéder à une page, redirige vers forbidden sinon
     * */
    function allow($rang){
        global $PDO; 
        $req = $PDO->prepare('SELECT * FROM roles');
        $req->execute(); 
        $data = $req->fetchAll();
        foreach($data as $d){
            @$roles[$d->slug] = $d->level; 
        }
        if(!$this->user('slug')){
            $this->forbidden(); 
        }else{
            return true;
        }

        
    }
    
    /**
     * Récupère une info utilisateur
     ***/
    function user($field){
        if($field == 'role') $field = 'slug'; 
        if(isset($_SESSION['Auth']->$field)){
            return $_SESSION['Auth']->$field;
        } else{
            return false; 
        }
    }
    
    /**
     * Redirige un utilisateur
     * */
    function forbidden(){
        header('Location:'.$this->forbiddenPage);
    }
    
}

$Auth = new Auth();