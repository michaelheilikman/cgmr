<?php
    if(isset($_POST['blog--submit'])){

        extract($_POST);

        @$from_site 		= $website;
        @$title 			= addslashes($_POST['title']);
        @$url 			= str_replace(' ','-', suppr_accents(removeEmojis($title)));
        $creator        = $Auth->user('prenom').' '.$Auth->user('nom');
        @$description 	= addslashes($_POST['description']);
        @$eventStart 	= addslashes($_POST['eventStart']);
        @$eventEnd 		= addslashes($_POST['eventEnd']);
        if(isset($_POST['embededFiles'])){
          @$importedFiles 	= $_POST['embededFiles'];
          @$embededFiles 	  = implode('; ', $importedFiles);
          //@$embededFiles 	  = addslashes($embededFiles);
        }else{
          $_POST['embededFiles'] = NULL;
          @$embededFiles = NULL;
        }
        @$lastid         = $_POST['lastid'];
        @$currentid      = $lastid + 1;

        @$hiddenPhoto = $_POST['hiddenPhoto'];

        if ($hiddenPhoto != $data->photo) {
            require("includes/imgClass.php");

            @$photo_name1	= $_FILES['photo']['name'];
            @$photo1_loc		= $_FILES['photo']['tmp_name'];
            @$photo1_size	= $_FILES['photo']['size'];
            @$photo1_type	= $_FILES['photo']['type'];

            @$folder			= "imgs/original/";
            @$folderMin		= "imgs/thumb/";
            @$folderSoc		= "imgs/social/";

            move_uploaded_file($photo1_loc,$folder.$photo_name1);

            Img::creerMin($folder.$photo_name1,$folderMin,$photo_name1,100,100);
            Img::creerMin($folder.$photo_name1,$folderSoc,$photo_name1,800,414);
            Img::convertirJPG($folder.$photo_name1);

            $sql="INSERT INTO blog (id,from_site,title,url,description,eventStart,eventEnd,embededFiles,photo,creator) VALUES('$currentid','$from_site','$title','$url','$description','$eventStart','$eventEnd','$embededFiles','$photo_name1','$creator')";
            $query = $PDO->prepare($sql);
            $query->execute();
        }else{
            $sql="INSERT INTO blog (id,from_site,title,url,description,eventStart,eventEnd,embededFiles,creator) VALUES('$currentid','$from_site','$title','$url','$description','$eventStart','$eventEnd','$embededFiles','$creator')";
            $query = $PDO->prepare($sql);
            $query->execute();
        }
        
        header('location:eventEdit.php?id='.$currentid);
        

    }
?>