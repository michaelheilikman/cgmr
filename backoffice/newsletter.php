<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'contact' ;
$subPage = 'newsletter' ;
$Auth->allow('users');
$typeOfDoc = "contact";
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/7/contacts?limit=50&offset=0&sort=desc",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => [
  "accept: application/json",
  "api-key:".$_ENV['BREVO_API_KEY']."" 
  ],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
?>

<?php include 'includes/head.php'; ?>



<?php include "remove/del--file.php" ?>

 <div class="d-flex" id="wrapper">

<?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php include "includes/navigation.php" ?>

		<div class="container-fluid">
		<div class="box wrapper my-5">


      <?php

    if($_SERVER['HTTP_HOST'] == "localhost"){ ?>
        
      <table id="pages" class="table table-striped table-light w-100">
          <thead class="bg-dark">
              <th class="text-light">Nom</th>
              <th class="text-light">E-mail</th>
              <th class="text-light">Date d'inscription</th>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM newsletter WHERE from_site= '$website' ORDER BY news_date DESC";
            $query = $PDO->prepare($sql);
            $query->execute();
            while($data = $query->fetch(PDO::FETCH_OBJ)):
            ?>
            <tr>
              <td style="line-height:20px" class="actuTitle">
                  <p class="text-dark mb-0 pb-0" title="<?php echo $data->news_prenom.' '.$data->news_nom ?>"><?php echo $data->news_nom.' '.$data->news_prenom ?></p>
                  <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                    <small class="mt-0 pt-0"><a href="#" class="suppr_newsletter text-danger" id="<?php echo $data->id ?>" data-name ="<?= $data->news_prenom.' '.$data->news_nom ?>" data-toggle="modal" data-target="#supprimer">corbeille</a></small>
                  <?php } ?>
              </td>
              <td style="line-height:20px">
                  <p class="text-dark mb-0 pb-0"><?php echo $data->news_mail ?></p>
              </td>
              <td style="line-height:20px">
              <p class="text-dark mb-0 pb-0"><?php echo $data->news_date ?></p>
              </td>
            </tr>
            <?php endwhile ; ?>
          </tbody>
          <tfoot class="bg-secondary">
              <td class="text-light">Nom</td>
              <td class="text-light">E-mail</td>
              <td class="text-light">Date d'inscription</td>
          </tfoot>
      </table>
      
		<?php } else { ?>

      <table id="pages" class="table table-striped table-light w-100">
          <thead class="bg-dark">
              <th class="text-light">ID Brevo</th>
              <th class="text-light">Nom</th>
              <th class="text-light">E-mail</th>
              <th class="text-light">Téléphone</th>
              <th class="text-light">Date d'inscription</th>
          </thead>
          <tbody>
            <?php
            $jsondec = json_decode($response);
            $countList = $jsondec->count;
            for ($i=0; $i < $countList; $i++) {
              print_r(
                '<tr>
              <td style="line-height:20px" class="actuTitle">
                <p class="text-dark mb-0 pb-0">'.$jsondec->contacts[$i]->id.'</p>
              </td>
              <td style="line-height:20px">
                  <p class="text-dark mb-0 pb-0" title="'.$jsondec->contacts[$i]->attributes->PRENOM.' '.strtoupper($jsondec->contacts[$i]->attributes->NOM).'">'.$jsondec->contacts[$i]->attributes->PRENOM.' '.strtoupper($jsondec->contacts[$i]->attributes->NOM).'</p>
              </td>
              <td style="line-height:20px">
                  <a class="text-primary mb-0 pb-0" href="mailto:'.$jsondec->contacts[$i]->email.'">'.$jsondec->contacts[$i]->email.'</a>
              </td>
              <td style="line-height:20px">
                  <p class="text-dark mb-0 pb-0">+'.$jsondec->contacts[$i]->attributes->SMS.'</p>
              </td>
              <td style="line-height:20px">
              <p class="text-dark mb-0 pb-0">'.date_format(date_create($jsondec->contacts[$i]->modifiedAt), "Y-m-d H:i:s").'</p>
              </td>
            </tr>'
              );
            }
            
            ?>
            
          </tbody>
          <tfoot class="bg-secondary">
              <td class="text-light">ID Brevo</td>
              <td class="text-light">Nom</td>
              <td class="text-light">E-mail</td>
              <td class="text-light">Téléphone</td>
              <td class="text-light">Date d'inscription</td>
          </tfoot>
      </table>
      
      
    <?php } ?>

	    </div> <!-- box wrapper -->
	  	</div> <!-- / container-fluid -->

    </div> <!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script src="<?php echo $path ?>backoffice/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $path ?>backoffice/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#pages').DataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Tout"]],
        "order": [[4, 'desc']],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
} );
</script>

<script>
	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});
</script>


<script type="text/javascript">
$(function(){
	if($(".wrapper").html().length <= 1000){
		emptyDoc = '<div class="col-12 d-flex flex-wrap justify-content-center">'+
			'<div class="mt-4">'+
                '<img class="mb-3" src="img/desert.png" alt="newsletter vide">'+
				'<p class="text-center">Vous n\'avez pas encore d\'inscris à votre newsletter</p>'+
			'</div>'+
		'<div>';
		$(".wrapper").html(emptyDoc);
	}
})
</script>
<script type="text/javascript" src="../js/main.js"></script>




</body>        
</html>