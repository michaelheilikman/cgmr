<?php
include 'includes/session-Auth.php';
$page = "projects";
$getURL = $_GET['url'];

$sql = "SELECT * FROM blog WHERE url='{$getURL}'";
$query = $PDO->prepare($sql);
$query->execute();
$event = $query->fetch(PDO::FETCH_OBJ);

if($getURL != $event->url):
    header('location :'.$path.'erreur_404.php');
else:

// TABLEAU POUR TRANSFORMER LES DATES (MOIS) EN FRANÇAIS
$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
$blogDate = new DateTime($event->blogDate);
$blogDate = $blogDate->format('d/m/Y');
$blogDate = date_create_from_format('d/m/Y', $blogDate);
$blogDate = $blogDate -> getTimestamp();
$blogDate = date('d',$blogDate)." ".$mois[date('n',$blogDate)]." ".date('Y',$blogDate);

$pageURL = 'actualite/'.$event->url;
$pageTitle = $event->title;
$description = $event->description;
$photo = substr($event->photo,0,-4);
$pageDate = $event->blogDate;

include "includes/doctype.php" ?>
<?php if (!empty($error)) echo @$error ?>

<?php include "includes/nav.php" ?>

<section id="marginMenuEvents"></section>

<nav aria-label="breadcrumb" class="position-sticky sticky-top bg-white keep-white">
    <div class="breadcrumb mb-0 pt-3 pb-0 rounded-0 d-flex px-3 bg-white">
        <ol class="breadcrumb container-fluid pb-0">
          <li class="breadcrumb-item"><a href="<?php echo $path ?>chantiers" class="text-success">Les chantiers</a></li>
          <li class="breadcrumb-item active text-dark" aria-current="page" title="<?php echo $event->title ?>"><?php echo $event->title ?></li>
        </ol>
    </div>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div> 
</nav>

<?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?> 
<ul id="pageEdition">
    <li class="bg-black"><a href="<?php echo $path ?>backoffice/" target="_blank"><i class="bi bi-gear-fill"></i></a></li>
    <li class="bg-primary"><a href="<?php echo $path ?>backoffice/eventEdit.php?id=<?php echo $event->id ?>" target="_blank"><i class="bi bi-pencil-square"></i></a></li>
</ul>
<?php endif; ?>

<div class="container px-md-5 py-md-5">

    
    <div class="container d-flex justify-content-center">
        <img src="<?php echo $path ?>backoffice/imgs/original/<?php echo $photo ?>.jpg" alt="<?php echo $event->title ?>" class="img-fluid col-lg-7">
    </div>

    <div class="content col-12 d-flex flex-wrap ps-0">

        <div class="socialNav d-flex d-md-block col-12 col-lg-1 h-25 justify-content-center position-md-sticky sticky-md-top ps-0">
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $path.'chantier/'.$event->url ?>" target="_blank" class="border border-success border-2 rounded-3 bg-white text-success me-2 me-md-0"><i class="bi bi-linkedin position-relative"></i></a>
            <a href="http://www.twitter.com/share?url=<?php echo $path.'chantier/'.$event->url ?>&amp;text=<?php echo $event->title ?>&amp;hashtags=<?php echo $event->from_site  ?>" target="_blank"  class="border border-success border-2 rounded-3 bg-white text-success me-2 me-md-0"><i class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $path.'chantier/'.$event->url ?>" target="_blank"  class="border border-success border-2 rounded-3 bg-white text-success me-2 me-md-0"><i class="bi bi-facebook"></i></a>
            <a href="mailto:?subject=<?php echo $event->from_site.' | '.$event->title ?>&body=Bonjour {*NOM DU CORRESPONDANT*},%0D%0A%0D%0AJe souhaiterai partager avec vous une page du site <?= $website ?> :%0D%0A<?php echo $path.'chantier/'.$event->url ?>%0D%0A%0D%0A Retrouvez toutes les informations sur le site <?php echo $website ?> <?php echo $path ?>%0D%0A%0D%0A Très respectueusement !" target="_blank"  class="border border-success border-2 rounded-3 bg-white text-success"><i class="bi bi-send-fill"></i></a>
        </div>

        <div class="col-12 col-lg-11 d-flex flex-wrap justify-content-center my-5 evenement">
            <h1 class="col-12 text-success font-weight-bold px-0"><?php echo $event->title ?></h1>
            <small class="col-12 mb-3 px-0">Le <?php echo $blogDate ?></small>
            <div class="mt-4 col-12 text-justify px-0"><?php echo $event->description ?></div>
        </div>
    </div>

    


                    
    <?php
        if(!empty($event->embededFiles)):
            $docs = $event->embededFiles;
            $doc = explode('; ',$docs);
            $countDoc = count($doc);
            
            if($countDoc < 2){
                echo '<h2 class="h5 fw-bold mb-2">Document associé :</h2>';
            }else{
                echo '<h2 class="h5 fw-bold mb-2">Documents associés :</h2>';
            }
            echo '<div class="row row-cols-2 row-cols-md-5 mb-5">';
            
            foreach ($doc as $docs) {
                $sql = "SELECT * FROM docs WHERE id = $docs AND active = 1";
                $query = $PDO->prepare($sql);
                $query->execute();
                $files = $query->fetch(PDO::FETCH_OBJ);
                @$format = after_last('.', @$files->fileDoc);
                @$docNoSpace = str_replace(' ','%20',@$files->fileDoc);

                if(@$format == 'pdf' AND @$files->active == 1):
                    echo '
                    <div class="py-2 px-3 text-center">
                        <a href="'.$path.'backoffice/uploads/'.$docNoSpace.'" target="_blank" class="pdfPrez d-block text-dark text-decoration-none p-2 rounded">
                        <div class="px-3 text-center" data-toggle="tooltip" data-placement="bottom" title="'.@$files->fileDoc.'">
                            <img src="'.@$files->imgBase64.'" height="95" class="border p-1 bg-white">
                        </div>
                        <small class="pt-2 d-block text-height-1 text-center text-wrap">'.reduire(@$files->fileDoc, 25).'</small>
                        </a>
                    </div>';
                elseif(@$format != 'pdf' AND @$files->active == 1):
                    echo '
                    <div class="py-2 px-3 text-center">
                        <a href="'.$path.'backoffice/uploads/'.@$docNoSpace.'" target="_blank" class="pdfPrez d-block text-dark text-decoration-none p-2 rounded">
                        <div class="px-3 text-center" data-toggle="tooltip" data-placement="bottom" title="'.@$files->fileDoc.'">
                            <img src="'.$path.'backoffice/img/format/'.@$format.'.png" height="95">
                        </div>
                        <small class="pt-2 d-block text-height-1 text-center text-wrap">'.reduire(@$files->fileDoc, 15).'</small>
                        </a>
                    </div>';
                else:
                    echo '
                    <div class="py-2 px-3 text-center">
                        <div class="px-3 text-center" data-toggle="tooltip" data-placement="bottom" title="Le document associé n\'est plus disponible en accès public ">
                            <img src="'.$path.'img/file-secure.png" height="95">
                        </div>
                        <small class="pt-2 d-block text-height-1 text-center text-wrap">'.reduire('le document n\'est plus disponible en accès public', 15).'</small>
                    </div>';
                endif;
            }
            echo '</div>';
        endif; 
    ?>
    
</div>
<?php endif ?>

<?php include "includes/footer.php" ?>
<?php include "includes/end.php" ?>