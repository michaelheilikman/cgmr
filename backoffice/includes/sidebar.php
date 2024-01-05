<div class="px-4 py-3 d-flex" id="sidebar-wrapper">
  <div class="sidebar">
    <main class="position-sticky sticky-top">
      <div class="sidebar-heading mb-4">
        <center><a href="<?php echo $path ?>accueil"><img src="<?php echo $path ?>img/<?= $logo ?>" height="50" class="mt-3 mb-0 logo"></a></center>
      </div>
      
      <hr class="horizontal mt-0 mx-3">

      <div class="list-group list-group-flush">

        <a href="<?php if($page == "edit"){echo "../";}else{} ?>index.php" class="list-group-item list-group-item-action <?php if($page == 'dashboard'): echo 'active'; endif;?>"><i class="bi bi-tv text-primary mr-3"></i> Dashboard</a>
        
        <!-- <a href="<?php if($page == "edit"){echo "../";}else{} ?>contact.php" class="list-group-item list-group-item-action <?php if($page == 'contact'): echo 'active'; endif;?>"><i class="bi bi-person-video text-info mr-3"></i> Contacts</a> -->

        <a href="#item-0" class="list-group-item list-group-item-action <?php if($page == 'contact'): echo 'active'; endif;?> text-capitalize"  data-toggle="collapse" aria-expanded="false"><i class="bi bi-person-video text-info mr-3"></i> Contact</a>
        
        <div class="list-group <?php if($page != 'contact'): echo 'collapse'; endif?>" id="item-0">
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>contact.php" class="list-group-item list-group-item-action <?php if($page == 'contact' AND $subPage == 'all'): echo 'active'; endif?> text-capitalize">
            <i class="bi bi-layout-text-sidebar-reverse text-purple mr-3"></i> Comptes
          </a>
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>entreprise.php" class="list-group-item list-group-item-action <?php if($page == 'contact' AND $subPage == 'entreprise'): echo 'active'; endif?> text-capitalize">
            <i class="bi bi-buildings text-teal mr-3"></i></i>Entreprises
          </a>
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>newsletter.php" class="list-group-item list-group-item-action <?php if($page == 'contact' AND $subPage == 'newsletter'): echo 'active'; endif?> text-capitalize">
            <i class="bi bi-send text-orange mr-3"></i></i>Newsletter
          </a>
        </div>
        
        <a href="#item-2" class="list-group-item list-group-item-action <?php if($page == 'docs'): echo 'active'; endif;?> text-capitalize"  data-toggle="collapse" aria-expanded="false"><i class="bi bi-folder text-warning mr-3"></i> Documents</a>

        <div class="list-group <?php if($page != 'docs'): echo 'collapse'; endif?>" id="item-2">
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>docs.php" class="list-group-item list-group-item-action <?php if($page == 'pages' AND $subPage == 'all'): echo 'active'; endif?> text-capitalize">
          <i class="bi bi-folder text-orange mr-3"></i> Documents
          </a>
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>keywords.php" class="list-group-item list-group-item-action <?php if($page == 'docs' AND $subPage == 'keywords'): echo 'active'; endif?> text-capitalize">
            <i class="bi bi-key text-purple mr-3"></i></i>Mots clés
          </a>
        </div>

        <a href="#item-1" class="list-group-item list-group-item-action <?php if($page == 'pages'): echo 'active'; endif;?> text-capitalize"  data-toggle="collapse" aria-expanded="false"><i class="bi bi-layout-text-sidebar-reverse text-teal mr-3"></i> Pages</a>
        
        <div class="list-group <?php if($page != 'pages'): echo 'collapse'; endif?>" id="item-1">
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>pages.php" class="list-group-item list-group-item-action <?php if($page == 'pages' AND $subPage == 'all'): echo 'active'; endif?> text-capitalize">
          <i class="bi bi-layout-text-sidebar-reverse text-purple mr-3"></i> Toutes les pages
          </a>
          <a href="<?php if($page == "edit"){echo "../";}else{} ?>category.php" class="list-group-item list-group-item-action <?php if($page == 'pages' AND $subPage == 'category'): echo 'active'; endif?> text-capitalize">
            <i class="bi bi-bookmark text-orange mr-3"></i></i>Catégories
          </a>
        </div>

        <a href="<?php if($page == "edit"){echo "../";}else{} ?>events.php" class="list-group-item list-group-item-action <?php if($page == 'events'): echo 'active'; endif;?> text-capitalize"><i class="bi bi-newspaper text-purple mr-3"></i> Actualités</a>
        

        <a href="<?php if($page == "edit"){echo "../";}else{} ?>calendrier.php?ym=<?php echo date('Y-m'); ?>" class="list-group-item list-group-item-action <?php if($page == 'calendrier'): echo 'active'; endif;?>"><i class="bi bi-calendar3 text-danger mr-3"></i> Calendrier</a>

        
      </div>

    </main> <!-- position sticky-top -->
  </div> 
</div>


<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>