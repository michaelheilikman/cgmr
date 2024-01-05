<?php
if(isset($_POST['page--submit'])){

    extract($_POST);

    @$from_site 	= $website;
    @$titre 		= addslashes($_POST['titre']);
    @$page_url 		= str_replace(' ','-', suppr_accents(removeEmojis($titre)));
    @$page_category = $_POST['page_category'];
    @$page_category = implode(';', $page_category);
    @$page_category = addslashes($page_category);
    if(isset($_POST['embededFiles'])){
        @$importedFiles 	= $_POST['embededFiles'];
        @$embededFiles 	  = implode('; ', $importedFiles);
        //@$embededFiles 	  = addslashes($embededFiles);
    }else{
        $_POST['embededFiles'] = NULL;
        @$embededFiles = NULL;
    }
    @$pageUpdate   = $today;
    @$active        = 1;
    @$hiddenPhoto = $_POST['hiddenPhoto'];

    $select = "SELECT * FROM pages WHERE from_site='$website' AND page_id = $id";
    $res = $PDO->prepare($select);
    $res->execute();
    $uri = $res->fetch(PDO::FETCH_OBJ);

    if(!empty($uri->page_id)):
        if ($hiddenPhoto != $data->photo) {
            @$photo_name	= $_FILES['photo']['name'];
            @$photo_loc	    = $_FILES['photo']['tmp_name'];
            @$photo_size	= $_FILES['photo']['size'];
            @$photo_type	= $_FILES['photo']['type'];

            @$folder		= "imgs/original/";
            @$folderMin		= "imgs/thumb/";
            @$folderSoc		= "imgs/social/";

            move_uploaded_file($photo_loc,$folder.$photo_name);

            Img::creerMin($folder.$photo_name,$folderMin,$photo_name,100,100);
            Img::creerMin($folder.$photo_name,$folderSoc,$photo_name,800,414);
            Img::convertirJPG($folder.$photo_name);

            $sql = "SELECT * FROM page_tools WHERE from_site='$website' AND page_id = $id";
            $query = $PDO->prepare($sql);
            $query->execute();
            while($tool = $query->fetch(PDO::FETCH_OBJ)):
                if($tool->tool_type == "simpleText"):
                    @$pageTool = $_POST['pageTool'.$tool->tool_id];
                    try{
                        $req = "UPDATE page_tools SET tool_content= '$pageTool' WHERE tool_id = $tool->tool_id";
                        $dem = $PDO->prepare($req);
                        $dem->execute();
                    }catch (PDOException $e) {
                        echo 'PDOException : '.  $e->getMessage();
                    }
                elseif($tool->tool_type == "simpleImage"):
                    if(empty($tool->tool_content)):
                        @$toolPict_name	    = $_FILES['toolPicture'.$tool->tool_id]['name'];
                        @$toolPict_loc	    = $_FILES['toolPicture'.$tool->tool_id]['tmp_name'];
                        @$toolPict_size	    = $_FILES['toolPicture'.$tool->tool_id]['size'];
                        @$toolPict_type	    = $_FILES['toolPicture'.$tool->tool_id]['type'];

                        @$pictFolder		= "imgs/original/";
                        @$pictFolderMin		= "imgs/thumb/";
                        @$pictFolderSoc		= "imgs/social/";
                        
                        move_uploaded_file($toolPict_loc,$pictFolder.$toolPict_name);

                        Img::creerMin($pictFolder.$toolPict_name,$pictFolderMin,$toolPict_name,100,100);
                        Img::creerMin($pictFolder.$toolPict_name,$pictFolderSoc,$toolPict_name,800,414);
                        Img::convertirJPG($pictFolder.$toolPict_name);
                        try{
                            $req = "UPDATE page_tools SET tool_content= '$toolPict_name' WHERE tool_id = $tool->tool_id";
                            $dem = $PDO->prepare($req);
                            $dem->execute();
                        }catch (PDOException $e) {
                            echo 'PDOException : '.  $e->getMessage();
                        }
                    elseif($tool->tool_content == 'NULL'):
                        
                    endif;
                endif; // condition sur le type de l'outil    
            endwhile;


            if(empty($uri->page_url)):
                $sql = "UPDATE pages SET titre='$titre', page_url='$page_url', page_update='$pageUpdate', photo = '$photo_name', embededFiles='$embededFiles', page_category='$page_category',active='$active' WHERE page_id = $id";
                $query = $PDO->prepare($sql);
                $query->execute();
            else:
                $sql = "UPDATE pages SET titre='$titre', page_update='$pageUpdate', photo = '$photo_name', embededFiles='$embededFiles', page_category='$page_category',active='$active' WHERE page_id = $id";
                $query = $PDO->prepare($sql);
                $query->execute();
            endif;
        }elseif($hiddenPhoto == $data->photo OR empty($hiddenPhoto)){
            $sql = "SELECT * FROM page_tools WHERE from_site='$website' AND page_id = $id";
            $query = $PDO->prepare($sql);
            $query->execute();
            while($tool = $query->fetch(PDO::FETCH_OBJ)):
                if($tool->tool_type == "simpleText"):
                    @$pageTool = $_POST['pageTool'.$tool->tool_id];
                    try{
                        $req = "UPDATE page_tools SET tool_content= '$pageTool' WHERE tool_id = $tool->tool_id";
                        $dem = $PDO->prepare($req);
                        $dem->execute();
                    }catch (PDOException $e) {
                        echo 'PDOException : '.  $e->getMessage();
                    }
                elseif($tool->tool_type == "simpleImage"):
                    if(empty($tool->tool_content)):
                        @$toolPict_name	    = $_FILES['toolPicture'.$tool->tool_id]['name'];
                        @$toolPict_loc	    = $_FILES['toolPicture'.$tool->tool_id]['tmp_name'];
                        @$toolPict_size	    = $_FILES['toolPicture'.$tool->tool_id]['size'];
                        @$toolPict_type	    = $_FILES['toolPicture'.$tool->tool_id]['type'];

                        @$pictFolder		= "imgs/original/";
                        @$pictFolderMin		= "imgs/thumb/";
                        @$pictFolderSoc		= "imgs/social/";
                        
                        move_uploaded_file($toolPict_loc,$pictFolder.$toolPict_name);

                        Img::creerMin($pictFolder.$toolPict_name,$pictFolderMin,$toolPict_name,100,100);
                        Img::creerMin($pictFolder.$toolPict_name,$pictFolderSoc,$toolPict_name,800,414);
                        Img::convertirJPG($pictFolder.$toolPict_name);
                        try{
                            $req = "UPDATE page_tools SET tool_content= '$toolPict_name' WHERE tool_id = $tool->tool_id";
                            $dem = $PDO->prepare($req);
                            $dem->execute();
                        }catch (PDOException $e) {
                            echo 'PDOException : '.  $e->getMessage();
                        }
                    elseif($tool->tool_content == 'NULL'):
                        
                    endif;
                endif; // condition sur le type de l'outil    
            endwhile;

            if(empty($uri->page_url)):
                $sql = "UPDATE pages SET titre='$titre', page_url='$page_url', page_update='$pageUpdate', embededFiles='$embededFiles', page_category='$page_category',active='$active' WHERE page_id = $id";
                $query = $PDO->prepare($sql);
                $query->execute();
            else:
                $sql = "UPDATE pages SET titre='$titre', page_update='$pageUpdate', embededFiles='$embededFiles', page_category='$page_category',active='$active' WHERE page_id = $id";
                $query = $PDO->prepare($sql);
                $query->execute();
            endif;
        }
    
    endif;
    
    header('location:pageSingle.php?page_id='.$id);        

}
?>
