<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'events' ;
$Auth->allow('users');
$typeOfDoc = "dossier";
$parent_id = 1;
?>
<?php include 'includes/head.php'; ?>

<?php
  $sql = "SELECT * FROM blog WHERE from_site='$website' AND id={$_GET['id']}";
  $query = $PDO->prepare($sql);
  $query->execute();
  $data = $query->fetch(PDO::FETCH_OBJ);
  $photo = substr($data->photo,0,-4);
  $id = $_GET['id'];

?>

<?php
    if(isset($_POST['blog--submit'])){

        extract($_POST);

        @$from_site 		= $website;
        @$title 			= addslashes($_POST['title']);
        //@$url 			= str_replace(' ','-', suppr_accents(removeEmojis($title)));
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

          $sql = "UPDATE blog SET title='$title', description='$description', eventStart='$eventStart', eventEnd='$eventEnd', photo = '$photo_name1', embededFiles='$embededFiles', creator='$creator' WHERE id = $id";
          $query = $PDO->prepare($sql);
          $query->execute();
        }else{
          $sql = "UPDATE blog SET title='$title', description='$description', eventStart='$eventStart', eventEnd='$eventEnd', embededFiles='$embededFiles', creator='$creator' WHERE id = $id";
          $query = $PDO->prepare($sql);
          $query->execute();
        }
        
        header('location:eventEdit.php?id='.$id);
        $success = '<aside class="px-5 pt-3"><div class="alert alert-success" role="alert">L\'article : <b>'.$data->title.'</b> a bien été mis à jour.</div></aside>';
        

    }
?>

 <div class="d-flex" id="wrapper">

    <?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

      <div class="">
        <div class="box pt-0">

        <div class="">

        <form action="" method="POST" enctype="multipart/form-data" class="d-flex bg-white blogEditor" id="blogForm">

          <main class="col-12 col-md-9 blogEditorMain">

            <?php echo @$success ?>

            <section class="px-5 py-3">
              <div class="form-group">
                <textarea name="title" class="form-control" id="page_title"><?php echo $data->title ?></textarea>
              </div>

              <div class="form-group mt-4">
                <textarea class="form-control" name="description" id="descriptionArea"><?php echo $data->description ?></textarea>
              </div>
              

            </section>
            
          </main>
          
          <aside class="col-12 col-md-3 blogEditorSide px-0">
            <section class="pb-5">

              <div class="accordion" id="accordionExample">
                  
                  <div class="cardHead">
                    <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapse00" aria-expanded="true" aria-controls="collapse00">
                      <span class="h4 mr-2" style="position:relative;top:5px;"><ion-icon name="open"></ion-icon></span> Hyperlien
                    </h3>
                  </div>

                  <div id="collapse00" class="collapse">
                    <div class="card-body cardBody">
                      <div class="form-group">
                        <input id="newURL" type="text" class="form-control col-auto" value="<?php echo $data->url ?>"/>
                        <a id="addNewUrl" class="btn btn-success btn-sm btn-block mt-2 col-auto" data-id="<?php echo $id ?>">Ajouter</a>
                      </div>
                      <div class="p-2" id="displayURL">
                        <a href="<?php echo $path.'project/'.$data->url ?>" target="_blank" class="h6 text-dark small"><?php echo $path.'project/'.$data->url ?></a>
                      </div>
                    </div>
                  </div>


                  <div class="cardHead">
                    <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span class="h4 mr-2" style="position:relative;top:5px;"><ion-icon name="images"></ion-icon></span> Image mise en avant
                    </h3>
                  </div>

                  <div id="collapseOne" class="collapse show">
                    <div class="card-body cardBody">
                      <div class="form-group image-upload d-flex flex-wrap justify-content-center mt-3">
                        <label for="file-input">
                            <?php if(!empty($data->photo)):?>
                                <img src="imgs/thumb/<?= $photo ?>.jpg" class="mr-3" id="blah" style="width:100px;aspect-ratio:1/1">
                            <?php else: ?>
                                <img src="img/gallery.png" id="blah" class="mr-3 mb-0">
                            <?php endif; ?>
                        </label>
                        <input type="file" name="photo" id="file-input" value="<?= $data->photo ?>">
                        <input type="hidden" name="hiddenPhoto" id="hiddenFile" value="<?= $data->photo ?>">
                      </div>
                    </div>
                  </div>

                  <div class="cardHead">
                    <h3 class="h6 mb-0 py-4 px-4 font-weight-bold" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      <span class="h4 mr-2" style="position:relative;top:5px;"><ion-icon name="calendar"></ion-icon></span> Événement
                    </h3>
                  </div>

                  <div id="collapseTwo" class="collapse">
                    <div class="card-body cardBody">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkBlogDate" <?php if(!empty($data->eventStart) OR !empty($data->eventEnd)){echo 'checked';} ?>>
                        <label class="form-check-label" for="checkBlogDate"> Ajouter une date pour un événement</label>
                      </div>
                      <div class="row blogDates d-none mt-3">
                        <div class="col">
                          <input type="text" name="eventStart" class="form-control datetimepicker" placeholder="Date de début" value="<?php echo $data->eventStart ?>">
                        </div>
                        <div class="col">
                          <input type="text" name="eventEnd" class="form-control datetimepicker" placeholder="Date de fin" value="<?php echo $data->eventEnd ?>">
                        </div>
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
<script type="text/javascript" src="js/tinymce.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script src="<?php echo $path ?>backoffice/js/crud.js"></script>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<script> 
    tinymce.init({
        selector:'#descriptionArea',
        menubar: false,
        statusbar: false,
        body_class: 'p-4',
        plugins: 'link media code emoticons image importcss autoresize',
        content_css: '../css/bootstrap.css',
        importcss_append: true,
        toolbar: 'undo redo | fontfamily fontsize backcolor forecolor | customInsertButton h2 h3 h4 bold italic strikethrough blockquote bullist numlist | alignleft aligncenter alignright alignjustify outdent indent | link image media | removeformat fullscreen emoticons preview save print code',
        setup: (editor) => {
          editor.ui.registry.addButton('customInsertButton', {
            icon: 'new-tab',
            tooltip: 'Ajouter un bouton',
            onAction: (_) => editor.insertContent('<a href="#" target="_blank" class="btn btn-info">Clic droit pour modifier le texte et ajouter un lien</a>')
          });
        },
        toolbar_sticky: true,
        toolbar_sticky_offset: 70,
        skin: 'oxide',
        toolbar_drawer: 'floating',
        autoresize_max_height: 500,           
        autoresize_bottom_margin: 16,
        toolbar_mode: 'sliding',
        /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: (cb, value, meta) => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.addEventListener('change', (e) => {
      const file = e.target.files[0];

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        const id = 'blobid' + (new Date()).getTime();
        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        const base64 = reader.result.split(',')[1];
        const blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
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
        <p class="return d-none" style="cursor:pointer" data-parent="" data-id="" data-prev=""><i data-icon="p" class="icon mr-3" style="font-size:0.8em;position: relative;top:1px;"></i>Retour</p>
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