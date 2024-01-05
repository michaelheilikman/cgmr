<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'pages' ;
$Auth->allow('users');
$typeOfDoc = "outil";
$parent_id = 1;
?>
<?php include 'includes/head.php'; ?>

<?php
    
    $id = $_GET['page_id'];
    $sql = "SELECT * FROM pages WHERE page_id = $id";
    $query = $PDO->prepare($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    $photo = substr($data->photo,0,-4);

    date_default_timezone_set('Europe/Paris');
    $maintenant = new DateTime();
    $today = $maintenant->format('Y-m-d H:i:s');

    $pageCat = $data->page_category;
    
    

?>
<?php require("includes/imgClass.php"); ?>
<?php include "edit/edit--page.php" ?>
<?php include "remove/del--file.php" ?>

 <div class="d-flex" id="wrapper">

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

      <div class="">
        <div class="box pt-0">

        <div class="d-flex bg-white">

        

        <form action="" method="POST" enctype="multipart/form-data" class="d-flex col-12 col-md-12 blogEditor px-0" id="submissionForm">

            <input type="hidden" name="page_id" value="<?php echo $data->page_id ?>" id="page_id">

            <main class="col-12 col-md-9 blogEditorMain">
              <section class="p-5">

              <div class="form-group">
                <textarea name="titre" class="form-control" id="page_title" placeholder="Titre de la page"><?php echo $data->titre ?></textarea>

                <div id="pageTools" class="sortable">
                  <?php

                      $sql = "SELECT * FROM page_tools WHERE from_site='$website' AND page_id = $id  ORDER BY item_order ASC";
                      $query = $PDO->prepare($sql);
                      $query->execute();
                      while($tool = $query->fetch(PDO::FETCH_OBJ)):

                          if($tool->tool_type == 'simpleText'){
                              echo 
                              '<div id="'.$tool->tool_id.'" class="p-3 toolParagraphe">
                              <textarea class="descriptionArea unMove p-3 simpleText'.$tool->tool_id.' w-100 form-control mt-4" placeholder="Insérer votre texte..." rows="8" name="pageTool'.$tool->tool_id.'">'.(($tool->tool_content != "Insérer votre texte...")?$tool->tool_content : "").'</textarea>
                              <div class="toolTrash">
                                <a href="#" class="suppr_tool text-dark shadow" id="'.$tool->tool_id.'" data-name ="'.$tool->tool_type.'" data-toggle="modal" data-target="#supprimer"><i class="bi bi-trash-fill"></i></a>
                              </div>
                              </div>';
                          }elseif($tool->tool_type == 'simpleImage'){ 
                            $picture = substr($tool->tool_content,0,-4);
                            ?>
                              <?php if(!empty($tool->tool_content) ): ?>
                                <div class="col-12 my-3 toolPicture" id="<?php echo $tool->tool_id ?>">
                                  <div class="col-12 col-md-12 col-lg-10 col-xl-8">
                                    <img src="imgs/original/<?php echo $picture ?>.jpg" alt="nom de l'image : <?php echo $tool->tool_content ?>">
                                    <div class="toolTrash">
                                      <a href="#" class="suppr_tool text-dark shadow" id="<?php echo $tool->tool_id ?>" data-name ="<?= $tool->tool_content ?>" data-toggle="modal" data-target="#supprimer"><i class="bi bi-trash-fill"></i></a>
                                    </div>
                                  </div>
                                </div>
                              <?php else: ?>
                              <div id="<?php echo $tool->tool_id ?>" class="form-group mt-3 bg-light rounded toolPicture p-3">
                                <div class="col-12">
                                  <input type="file" name="toolPicture<?php echo $tool->tool_id ?>" value="<?php echo @$tool->tool_content ?>">
                                  <div class="toolTrash">
                                      <a href="#" class="suppr_tool text-dark shadow" id="<?php echo $tool->tool_id ?>" data-name ="<?= $tool->tool_content ?>" data-toggle="modal" data-target="#supprimer"><i class="bi bi-trash-fill"></i></a>
                                    </div>
                                </div>
                              </div>
                              <?php endif; ?>
                          <?php  } ?>

                      <?php endwhile; ?>
                </div>
              </div>

            </section>
          </main>

          <aside class="col-12 col-md-3 blogEditorSide px-0">

            <section class="pb-5">

              <div class="accordion" id="accordionExample">

                <div class="cardHead">
                <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapse00" aria-expanded="true" aria-controls="collapse00">
                  <span class="h4 mr-2" style="position:relative;top:3px;"><i class="bi bi-link-45deg"></i></span> Hyperlien
                  </h3>
                </div>

                <div id="collapse00" class="collapse">
                  <div class="card-body cardBody">
                    <div class="form-group">
                      <input id="newURL" type="text" class="form-control col-auto" value="<?php echo $data->page_url ?>"/>
                      <a id="addNewPageUrl" class="btn btn-success btn-sm btn-block mt-2 col-auto" data-id="<?php echo $id ?>">Ajouter</a>
                    </div>
                    <div class="p-2" id="displayURL">
                      <a href="<?php echo $path.'thematique/'.$data->page_url ?>" target="_blank" class="h6 text-dark small"><?php echo $path.'thematique/'.$data->page_url ?></a>
                    </div>
                  </div>
                </div>

                <?php 
                  $images = $data->photo;
                  $image = explode('; ',$images);
                  $countImg = count($image);
                ?>
                <div class="cardHead">
                  <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <span class="h4 mr-2" style="position:relative;top:3px;"><i class="bi bi-image-fill"></i></span> Image mise en avant <?php if(!empty($images)): ?> <i class="bi bi-check-circle-fill text-info ml-2"></i><?php else: ?><i class="bi bi-exclamation-diamond-fill text-orange ml-2"></i><?php endif ?>
                  </h3>
                </div>

                <div id="collapseOne" class="collapse <?php if(empty($data->photo)){echo 'show';} ?>">
                  <div class="card-body cardBody">
                    <div class="form-group image-upload d-flex flex-wrap justify-content-center mt-3">
                      <label for="file-input">
                          <?php if(!empty($data->photo)):?>
                              <img src="imgs/thumb/<?= $photo ?>.jpg" class="mr-3" id="blah" style="width:100px;aspect-ratio:1/1">
                          <?php else: ?>
                              <img src="img/gallery.png" id="blah" class="mr-3 mb-0">
                          <?php endif; ?>
                      </label>
                      <input type="file" name="photo" id="file-input" value="<?= @$data->photo ?>">
                      <input type="hidden" name="hiddenPhoto" id="hiddenFile" value="<?= @$data->photo ?>">
                    </div>
                  </div>
                </div>

                <?php 
                  $categories = $data->page_category;
                  $categorie = explode('; ',$categories);
                  $countCat = count($categorie);
                ?>
                <div class="cardHead">
                  <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span class="h4 mr-2" style="position:relative;top:3px;"><i class="bi bi-bookmarks-fill"></i></span> Catégories <?php if(!empty($categories)): ?> <i class="bi bi-check-circle-fill text-info ml-2"></i><?php else: ?><i class="bi bi-exclamation-diamond-fill text-orange ml-2"></i><?php endif ?>
                  </h3>
                </div>

                <div id="collapseTwo" class="collapse">
                  <div class="card-body cardBody">
                      
                      <div id="catOutput" class="mt-3">
                        <div class="form-group">
                        
                          <select id="" class="form-control" name="page_category[]">
                            <option value="">Choisissez votre catégorie</option>
                            <?php
                              $sql = "SELECT * FROM category WHERE from_site='$website'";
                              $query = $PDO->prepare($sql);
                              $query->execute();
                              while($cat = $query->fetch(PDO::FETCH_OBJ)):?>
                                
                                <option <?php if($data->page_category == $cat->cat_id){ echo 'selected';} ?> value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></option>

                              <?php endwhile; ?>
                          </select>
                        </div>
                      </div>
                      <div class="d-flex justify-content-center">
                        <small class="mb-3">-- OU --</small>
                      </div>
                      <div class="form-group">
                        <input type="text" id="newCategory" class="form-control col-auto" placeholder="Ajouter une nouvelle catégorie">
                        <a id="addNewCategory" class="btn btn-success btn-sm btn-block mt-3 col-auto" data-website="<?php echo $website ?>">Ajouter</a> 
                      </div>
                  </div>
                </div>

                <?php 
                  $docs = $data->embededFiles;
                  $doc = explode('; ',$docs);
                  $countDocs = count($doc);
                  ?>

                  <div class="cardHead">
                    <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                      <span class="h4 mr-2" style="position:relative;top:5px;"><ion-icon name="folder"></ion-icon></span> Document<?php if($countDocs >=2){echo "s";}?> attaché<?php if($countDocs >=2){echo "s";}?> <?php if(!empty($docs)): ?> <span class="badge badge-danger ml-2"><?php echo $countDocs ?></span><?php else: ?><span class="badge badge-danger ml-2">0</span><?php endif ?>
                    </h3>
                  </div>

                  <div id="collapseThree" class="collapse show">
                    <div class="card-body cardBody">
                      <div class="form-group importedDocs d-flex flex-wrap">
                      <?php
                        if(!empty($data->embededFiles)):

                          foreach ($doc as $docs) {
                              $sql = "SELECT * FROM docs WHERE id = '$docs' AND from_site = '$website'";
                              $query = $PDO->prepare($sql);
                              $query->execute();
                              $files = $query->fetch(PDO::FETCH_OBJ);
                              $format = after_last('.', $files->fileDoc);

                              if($format == 'pdf'):
                              echo '<div class="col-3 mt-4"><input type="hidden" name="embededFiles[]" class="doc'.@$files->id.'" value="'.@$files->id.'">
                              <div class="imgEdit img'.@$files->id.'" data-editDocID="'.@$files->id.'">
                                <div style="background-image:url('.@$files->imgBase64.');background-size:contain;width:100%;height:100px;background-repeat:no-repeat;" class="p-2 rounded">
                                  <div class="bg-white shadow-sm fermer" style="width:20px;height:20px;position:absolute;top:-5px;left:-5px;border-radius:50px">
                                    <button type="button" class="close position-relative" aria-label="Close"><span aria-hidden="true" class="position-absolute" style="top:-1px;right:2px;">×</span></button>
                                  </div>
                                </div>
                              </div></div>';
                              else:
                                echo '<div class="col-3 mt-4"><input type="hidden" name="embededFiles[]" class="doc'.@$files->id.'" value="'.@$files->id.'">
                                <div class="imgEdit img'.@$files->id.'" data-editDocID="'.@$files->id.'">
                                  <div style="background-image:url(img/format/'.@$format.'.png);background-size:contain;height:100px;width:100px;position:relative;background-repeat:no-repeat" class="p-2 rounded">
                                    <div class="bg-white shadow-sm fermer" style="width:20px;height:20px;position:absolute;top:-5px;left:-5px;border-radius:50px">
                                      <button type="button" class="close position-relative" aria-label="Close"><span aria-hidden="true" class="position-absolute" style="top:-1px;right:2px;">×</span></button>
                                    </div>
                                  </div>
                                </div></div>';
                              endif ;
                            
                          }
                        endif;
                      ?>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3 d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-secondary mr-3" data-toggle="modal" data-target="#exampleModal"> <ion-icon name="document" style="font-size:1.3em; position:relative;top:4px" class="mr-1"></ion-icon> Ajouter des documents</button>
                  </div>

                    
                    
                  </div>


              </div><!-- fin de accordion -->
            </section>

          </aside>        

        </form>

        </div>

	    </div> <!-- box wrapper -->
      </div> <!-- container-fluid -->
    </div><!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/tinymce.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script src="<?php echo $path ?>backoffice/js/crud.js"></script>

<script>
$('#newToolBox').popover({
  trigger: 'focus',
})
</script>

<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>

<script> 
    tinymce.init({
        selector:'.descriptionArea',
        menubar: false,
        statusbar: false,
        body_class: 'p-2',
        plugins: 'link media code emoticons image importcss autoresize',
        content_css: '../css/bootstrap.css',
        importcss_append: true,
        toolbar: 'undo redo | fontfamily fontsize backcolor forecolor | customInsertButton h2 h3 h4 bold italic strikethrough blockquote bullist numlist | alignleft aligncenter alignright alignjustify outdent indent | link image media | removeformat fullscreen emoticons preview save print code',
        setup: (editor) => {
          editor.ui.registry.addButton('customInsertButton', {
            icon: 'new-tab',
            tooltip: 'Ajouter un bouton',
            onAction: (_) => editor.insertContent('<a href="#" target="_blank" class="btn btn-info"><b>Clic droit</b> : modifier le texte et ajouter un lien</a>')
          });
        },
  toolbar_sticky: true,
  toolbar_sticky_offset: 70,
  skin: 'oxide',
  toolbar_drawer: 'floating',
  autoresize_max_height: 500,       
  autoresize_bottom_margin: 16,
  toolbar_mode: 'sliding',
  image_title: true,
  automatic_uploads: true,
  file_picker_types: 'image',
  file_picker_callback: (cb, value, meta) => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.addEventListener('change', (e) => {
      const file = e.target.files[0];

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        const id = 'blobid' + (new Date()).getTime();
        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        const base64 = reader.result.split(',')[1];
        const blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);
        cb(blobInfo.blobUri(), { title: file.name });
      });
      reader.readAsDataURL(file);
    });
    input.click();
  },
    });
  </script>



<!--****************************************************
DATE PICKER
****************************************************-->
<script src="js/jquery.datetimepicker.js"></script>
<script>
$('.datetimepicker').datetimepicker({
lang:'fr',
 i18n:{
  de:{
   months:[
    'Janvier','Fevrier','Mars','Aavri',
    'Mai','Juin','Juillet','Août',
    'Septembre','Octobre','Novembre','Decembre',
   ],
   dayOfWeek:[
    "Di", "Lu", "Ma", "Me", 
    "Je", "Ve", "Sa",
   ]
  }
 },
    onGenerate:function( ct ){
        $(this).find('.xdsoft_date')
            .toggleClass('xdsoft_disabled');
    },
    minDate:'-2000-02-01',
    maxDate:'+2030-02-01',
    timepicker:false,
    format:'Y-m-d'
});
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Documents disponibles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="return d-none" style="cursor:pointer"><i data-icon="p" class="icon mr-3" style="font-size:0.8em;position: relative;top:1px;"></i>Retour</p>
        <div class="d-flex flex-wrap">
        <?php
        $sql = "SELECT * FROM docs WHERE from_site= '$website'";
				$query = $PDO->prepare($sql);
				$query->execute();
				while($data = $query->fetch(PDO::FETCH_OBJ)):
          $format = after_last('.', $data->fileDoc);
        ?>
          <?php if($data->active == NULL OR $data->active == 1): ?>
            <?php if(empty($data->imgBase64) AND empty($data->fileDoc) AND $data->parent_id == 0){ ?>
              <div class="openChildren folder<?php echo $data->parent_id ?> p-1 col-2" data-docid="<?php echo $data->id ?>" data-parent="<?php echo $data->parent_id ?>">
                <div class="p-2 rounded">
                  <div class="square2 rounded" style="background-image: url(img/dossier.png);"></div>
                  <div class="text-center"><small class="text-height-1"><?php echo $data->name ?></small></div>
                </div>
              </div>
            <?php } ?>

            <?php if($data->parent_id > 0 AND $format == 'pdf' AND empty($data->folderType)){ ?>
              <div class="imgDocs folder<?php echo $data->parent_id ?> p-1 col-2 prout<?php echo $data->parent_id ?> d-none" data-docid="<?php echo $data->id ?>" data-parent="<?php echo $data->parent_id ?>" data-docBackground="<?php echo $data->imgBase64 ?>">
                <div class="p-2 rounded">
                  <div class="square2 rounded" style="background-image: url(<?php echo $data->imgBase64 ?>);"></div>
                  <div class="text-center"><small class="text-height-1"><?php echo $data->name ?></small></div>
                </div>
              </div>
            <?php }elseif($data->parent_id > 0 AND $format != 'pdf' AND empty($data->folderType)){ ?>
                <div class="imgDocs folder<?php echo $data->parent_id ?> p-1 col-2 prout<?php echo $data->parent_id ?> d-none" data-docid="<?php echo $data->id ?>" data-parent="<?php echo $data->parent_id ?>" data-docBackground="img/format/<?php echo $format ?>.png">
                <div class="p-2 rounded">
                  <div class="square2 rounded" style="background-image: url(img/format/<?php echo $format ?>.png);"></div>
                  <div class="text-center"><small class="text-height-1"><?php echo $data->name ?></small></div>
                </div>
              </div>
              <?php }elseif($data->parent_id > 0 AND !empty($data->folderType)){ ?>
                <div class="subFolder folder<?php echo $data->parent_id ?> p-1 col-2 prout<?php echo $data->parent_id ?> d-none" data-docid="<?php echo $data->id ?>" data-parent="<?php echo $data->parent_id ?>" data-prev="" data-docBackground="img/dossier.png">
                  <div class="p-2 rounded">
                    <div class="square2 rounded" style="background-image: url(img/dossier.png);"></div>
                    <div class="text-center"><small class="text-height-1"><?php echo $data->name ?></small></div>
                  </div>
                </div>
            <?php } ?>
          <?php endif; ?>

        <?php endwhile; ?> 
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

</body>        
</html>