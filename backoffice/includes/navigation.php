<nav class="navbar navbar-expand-lg navbar-light pt-4 px-4">
  <span class="navbar-toggler-icon d-lg-none" id="menu-toggle"></span>
  
<?php if($page == 'dashboard'){?>
   <h3 class="font-weight-bold"><i class="bi bi-tv-fill text-primary mr-3"></i>Tableau de bord</h3>
<?php }elseif($page == 'docs'){?>
   <h3 class="font-weight-bold"><i class="bi bi-folder-fill text-warning mr-3"></i>Documents</h3>
<?php }elseif($page == 'biblio'){?>
   <h3 class="font-weight-bold"><i class="bi bi-bookmarks-fill text-danger mr-3"></i>Bibliographie</h3>
<?php }elseif($page == 'pages' && $parent_id == 0){?>
   <h3 class="font-weight-bold"><i class="bi bi-layout-text-sidebar-reverse text-teal mr-3"></i>Pages</h3>
<?php }elseif($page == 'pages' && $parent_id > 0){?>
  <h3 class="font-weight-bold"><a href="pages.php"><i class="bi bi-arrow-left mr-3"></i>Retour</a></h3>
  <div id="newToolBox" class="text-success h2 ml-4 mb-0" style="margin-top:4px;cursor:pointer"><i class="bi bi-plus-square-fill"></i></div>
  <div class="" id="toolBox">
    <div class="d-flex">
      <div class="textTool"><button id="addSimpleText" form="toolsForm" data-type="simpleText"><i class="bi bi-paragraph"></i><span class="small">Texte</span></button></div>
      <div class="imgTool"><button class="" id="addSimpleImage" form="toolsForm" data-type="simpleImage"><i class="bi bi-image-fill"></i><span class="small">Image</span></button></div>
    </div>
  </div>
  <form action="" method="POST" id="toolsForm">
      <input type="hidden" name="page_id" value="<?php echo $data->page_id ?>" id="tools_page_id">
      <input type="hidden" name="from_site" value="<?php echo $website ?>" id="tools_website">
  </form>
<?php }elseif($page == 'events' && $parent_id == 0){?>
   <h3 class="font-weight-bold"><i class="bi bi-newspaper text-purple mr-3"></i>Actualités</h3>
<?php }elseif($page == 'events' && $parent_id > 0){?>
   <h3 class="font-weight-bold"><a href="events.php"><i class="bi bi-arrow-left mr-3"></i>Retour</a></h3>
<?php }elseif($page == 'contact' && $typeOfDoc == 'contact' && $subPage == 'all'){?>
   <h3 class="font-weight-bold"><i class="bi bi-layout-text-sidebar-reverse text-purple mr-3"></i>Comptes</h3>
<?php }elseif($page == 'contact' && $typeOfDoc == 'user' && $subPage == 'all'){?>
    <h3 class="font-weight-bold"><a href="contact.php"><i class="bi bi-arrow-left mr-3"></i>Retour</a></h3>
<?php }elseif($page == 'contact' && $typeOfDoc == 'contact' && $subPage == 'entreprise'){?>
   <h3 class="font-weight-bold"><i class="bi bi-buildings text-teal mr-3"></i>Entreprises</h3>
<?php }elseif($page == 'contact' && $typeOfDoc == 'contact' && $subPage == 'newsletter'){?>
   <h3 class="font-weight-bold"><i class="bi bi-send text-orange mr-3"></i>Newsletter</h3>
<?php }elseif($page == 'calendrier'){?>
   <h3 class="font-weight-bold"><i class="bi bi-calendar3 text-danger mr-3"></i>Calendrier</h3>
<?php }elseif($page == 'account'){?>
   <h3 class="font-weight-bold"><i class="bi bi-person-fill text-primary mr-3"></i><?php echo $Auth->user('prenom').' '.$Auth->user('nom') ?></h3>
 

<?php }elseif($folder->parent_id != 0){?>
  <a href="files.php?files=<?php echo $folder->parent_id ?>" class="text-dark text-decoration-none"><h3><i class="bi bi-arrow-left mr-3"></i> <span title="<?php echo $folder->name ?>"><?php echo reduire($folder->name,25) ?></span></h3></a>
<?php }else{ ?>
  <a href="docs.php" class="text-dark text-decoration-none"><h3><i class="bi bi-arrow-left mr-3"></i> <span title="<?php echo $folder->name ?>"><?php echo reduire($folder->name,25) ?></span></h3></a>
<?php } ?>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
  <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'): ?>
    
    <?php if(@$page == 'docs' || @$page == 'biblio' || @$page == 'colloque' AND $subPage != 'keywords'){ ?>
      <li class="nav-item">
			  <a href="#" class="mr-3 btn btn-success" data-toggle="modal" data-target="#new-folder"><i class="bi bi-folder-fill text-white mr-1"></i> Nouveau dossier</a>
      </li>
  <?php } elseif($page == 'docs' && $subPage == 'keywords'){?>
      <li class="nav-item">
			  <a href="#" class="mr-3 btn btn-success" data-toggle="modal" data-target="#new-key">
        <span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>
        <i class="bi bi-key-fill text-white mr-1"></i> Nouveau mot-clé</a>
      </li>
  <?php } elseif($page == 'contact' && $typeOfDoc == 'contact' && $subPage == 'all'){?>
    <li class="nav-item">
      <a href="user.php" class="mr-3 btn btn-success" style="position: relative;top:2px;"><i class="bi bi-person-circle text-white mr-1"></i> Nouvel utilisateur</a>
    </li>
  <?php } elseif($page == 'contact' && $typeOfDoc == 'contact' && $subPage == 'entreprise'){?>
    <li class="nav-item">
      <a href="#" class="mr-3 btn btn-primary" data-toggle="modal" data-target="#new-company">
        <span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>
        <i class="bi bi-buildings mr-1"></i> Nouvelle entreprise</a>
    </li>
  <?php } elseif(@$page == 'calendrier'){?>
    <li class="nav-item">
      <a href="#" class="mr-3 btn btn-success" data-toggle="modal" data-target="#new-event"><i class="bi bi-calendar3 mr-1"></i> Nouvel événement</a>
    </li>
  <?php } elseif(@$page == 'inscription'){?>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark mr-3" data-toggle="modal" data-target="#new-inscrit"><i data-icon='o' class='icon' style="position: relative;top:2px;"></i> Nouveau participant</a>
    </li>
    <?php } elseif(@$page == 'file'){?>
    <li class="nav-item">
      <a href="#" class="mr-3 btn btn-success" data-toggle="modal" data-target="#new-folder"><i class="bi bi-folder-fill text-white mr-1"></i> Nouveau dossier</a>
    </li>
    <li class="nav-item">
      <a href="#" class="mr-3 btn btn-primary createNewFile" data-toggle="modal" data-target="#new-file"><i class="bi bi-file-earmark-plus-fill text-white mr-1"></i> Nouveau document</a>
    </li>
    <?php } elseif(@$page == 'pages' && $parent_id == 0){?>
    <li class="nav-item">
      <form action="" method="POST">
        <button type="submit" name="page--submit" class="mr-3 btn btn-success"><i class="bi bi-layout-text-sidebar-reverse mr-1"></i> Nouvelle page</button>
      </form>
    </li>
    <?php } elseif(@$page == 'pages' && $parent_id > 0){?>
    <li class="nav-item">
      <button class="btn btn-primary mr-2" type="submit" id="pageSubmit" name="page--submit" form="submissionForm">
          <span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>
          Enregistrer
      </button>
      <!-- <button class="btn btn-secondary ml-3 mr-4" type="submit" id="pageDraft" form="submissionForm">
          <span class="spinner-border-sm saveInactive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>
          Brouillon
      </button> -->
    </li>
    <?php } elseif(@$page == 'events' && $parent_id == 0){?>
    <li class="nav-item">
      <a href="<?php if($page == "edit"){echo "../";}else{} ?>eventSingle.php" class="mr-3 btn btn-success"><i class="bi bi-newspaper mr-1"></i> Nouvelle actualité</a>
    </li>
    <?php } elseif(@$page == 'events' && $parent_id == 1){?>
    <li class="nav-item">
      <button class="btn btn-success mr-4" type="submit" form="blogForm" name="blog--submit" id="submitFormBlog">
          <span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>
          Enregistrer
      </button>
    </li>
    <?php } elseif(@$page == 'events' && $parent_id == 2){?>
    <li class="nav-item">
      <button class="btn btn-success mr-4" type="submit" form="blogForm" name="blog--submit" id="submitFormBlog">
          <span class="spinner-border-sm saveActive" style="position:relative;top:-3px;" role="status" aria-hidden="true"></span>
          Enregistrer
      </button>
    </li>
    <?php } ?>
  
		<?php endif; ?>
    
    <li class="nav-item dropdown">
      <a class="btn btn-outline-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $Auth->user('prenom').' '.$Auth->user('nom') ?>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item"  href="<?php if($page == "edit"){echo "../";}else{} ?>compte.php?user=<?php echo $Auth->user("nom") ?>">Compte</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php if($page == "edit"){echo "../";}else{} ?>../class/logout.php" >Déconnexion</a>
      </div>
    </li>
  </ul>
</div>
</nav>