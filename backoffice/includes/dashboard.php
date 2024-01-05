<section class="d-flex flex-wrap justify-content-between align-item-start mx-3 mt-5">
        <div class="col-12 col-md-4 p-3">
            <div class="bg-white p-3 border-radius-lg box-shadow-lg">
                <aside class="d-flex justify-content-between align-item-center">
                    <div class="">                        
                        <?php
                            $now = new DateTime();
                            $month = $now->format('m');
                            
                            $sql = "SELECT * FROM visitors WHERE from_site = '$website'";
                            $query = $PDO->prepare($sql);
                            $query->execute();
                            $row = $query->fetchAll(PDO::FETCH_OBJ);
                            
                            $maintenant = new DateTime();
                            $today = $maintenant->format('Y-m-d');
                            $hier = new DateTime("-1 day");
                            $yesterday =  $hier->format('Y-m-d');
                            
                            foreach ($row as $results) {
                                $formatedDate = new DateTime($results->visitor_date);
                                $formatedDate = $formatedDate->format('Y-m-d');
                                $visitorDate[] = strtotime($formatedDate);
                                
                            }
                            $valeurParDate = array_count_values($visitorDate);
                            $dateKeys = array_keys($valeurParDate);
                            $dateValues = array_values($valeurParDate);
                            
                            for ($i=0; $i <= count($row); $i++) { 
                                if(isset($dateKeys[$i])){
                                    if ($dateKeys[$i] == strtotime($today)) {
                                        $jour = $dateValues[$i];
                                        $jourKey = $dateKeys[$i];
                                    }elseif($dateKeys[$i] -1 == strtotime($yesterday)){
                                       $hier = $dateValues[$i];
                                    }elseif($dateKeys[$i] -1 != strtotime($yesterday)){
                                        $hier = $dateValues[$i];
                                    }
                                }
                            }
                                                        

                        ?>
                        <h4 class="h6 mb-0 text-muted text-uppercase">VISITEUR<?php if(count($row) > 1){echo 'S';}?> UNIQUE<?php if(count($row) > 1){echo 'S';}?></h4>
                        <h3 class="h4 mb-0 font-weight-bold"><?php echo count($row); ?></h3>
                    </div>
                    <div>
                        <div class="bg-gradient-indigo icon-shape text-center rounded-circle">
                            <ion-icon name="contact"></ion-icon>
                        </div>
                    </div>
                </aside>
                <?php /*
                <!-- <?php if ($jour > $hier) {?>
                    <p class="mb-0 text-muted"><span class="text-teal">+<?php echo round(($jour - $hier)/$hier * 100) ?>%</span> depuis hier</p>
                <?php }elseif($jour < $hier){ ?>
                    <p class="mb-0 text-muted"><span class="text-danger">-<?php echo round(($jour - $hier)/$hier * 100) ?>%</span> depuis hier</p>
                <?php } ?> -->
                <!-- <p class="mb-0 text-muted small"><?= $month ?></p> -->
                */?>
            </div>
        </div>

        <div class="col-12 col-md-4 p-3">
            <div class="bg-white p-3 border-radius-lg box-shadow-lg">
                <aside class="d-flex justify-content-between align-item-center">
                    <div class="">
                    <?php
                            $sql = "SELECT * FROM views WHERE from_site = '$website' AND MONTH(visitor_date) = $month";
                            $query = $PDO->prepare($sql);
                            $query->execute();
                            $row = $query->fetchAll(PDO::FETCH_OBJ);

                            $maintenant = new DateTime();
                            $today = $maintenant->format('Y-m-d');
                            $hier = new DateTime("-1 day");
                            $yesterday =  $hier->format('Y-m-d');
                            
                            foreach ($row as $results) {
                                $formatedDate = new DateTime($results->visitor_date);
                                $formatedDate = $formatedDate->format('Y-m-d');
                                $visitorDate[] = strtotime($formatedDate);
                                
                            }
                            $valeurParDate = array_count_values($visitorDate);
                            $dateKeys = array_keys($valeurParDate);
                            $dateValues = array_values($valeurParDate);
                            
                            for ($i=0; $i <= count($row); $i++) { 
                                if(isset($dateKeys[$i])){
                                    if ($dateKeys[$i] == strtotime($today)) {
                                        $jour = $dateValues[$i];
                                        $jourKey = $dateKeys[$i];
                                    }elseif($dateKeys[$i] -1 == strtotime($yesterday)){
                                       $hier = $dateValues[$i];
                                    }elseif($dateKeys[$i] -1 != strtotime($yesterday)){
                                        $hier = $dateValues[$i];
                                    }
                                }
                            }
                                                        

                        ?>
                        <h4 class="h6 mb-0 text-muted text-uppercase">PAGE<?php if(count($row) > 1){echo 'S';}?> VUE<?php if(count($row) > 1){echo 'S';}?></h4>
                        <h3 class="h4 mb-0 font-weight-bold"><?php echo count($row); ?></h3>
                    </div>
                    <div>
                        <div class="bg-gradient-danger icon-shape text-center rounded-circle">
                            <ion-icon name="eye"></ion-icon>
                        </div>
                    </div>
                </aside>
                <?php /*
                <!-- <?php if ($jour >= $hier) {?>
                    <p class="mb-0 text-muted"><span class="text-teal">+<?php echo round(($jour - $hier)/$hier * 100) ?>%</span> depuis hier</p>
                <?php }elseif($jour < $hier){ ?>
                    <p class="mb-0 text-muted"><span class="text-danger"><?php echo round(($jour - $hier)/$hier * 100) ?>%</span> depuis hier</p>
                <?php } ?> -->
                */ ?>
            </div>
        </div>

        <div class="col-12 col-md-4 p-3">
            <div class="bg-white p-3 border-radius-lg box-shadow-lg">
                <aside class="d-flex justify-content-between align-item-center">
                    <div class="">
                    <?php
                            $sql = "SELECT * FROM online WHERE from_site = '$website'";
                            $query = $PDO->prepare($sql);
                            $query->execute();
                            $row = $query->fetchAll(PDO::FETCH_OBJ);

                            $maintenant = new DateTime();
                            $today = $maintenant->format('Y-m-d');
                            $hier = new DateTime("-1 day");
                            $yesterday =  $hier->format('Y-m-d');
                            
                            foreach ($row as $results) {
                                $formatedDate = new DateTime($results->visitor_date);
                                $formatedDate = $formatedDate->format('Y-m-d');
                                $visitorDate[] = strtotime($formatedDate);
                                
                            }
                            $valeurParDate = array_count_values($visitorDate);
                            $dateKeys = array_keys($valeurParDate);
                            $dateValues = array_values($valeurParDate);
                            
                            for ($i=0; $i <= count($row); $i++) { 
                                if(isset($dateKeys[$i])){
                                    if ($dateKeys[$i] == strtotime($today)) {
                                        $jour = $dateValues[$i];
                                        $jourKey = $dateKeys[$i];
                                    }elseif($dateKeys[$i] -1 == strtotime($yesterday)){
                                       $hier = $dateValues[$i];
                                    }elseif($dateKeys[$i] -1 != strtotime($yesterday)){
                                        $hier = $dateValues[$i];
                                    }
                                }
                            }
                                                        

                        ?>
                        <h4 class="h6 mb-0 text-muted text-uppercase">Connectés</h4>
                        <h3 class="h4 mb-0 font-weight-bold"><?php echo count($row) ; ?></h3>
                    </div>
                    <div>
                        <div class="bg-gradient-teal icon-shape text-center rounded-circle">
                            <ion-icon name="wifi"></ion-icon>
                        </div>
                    </div>
                </aside>
                <?php /*
                <!-- <?php if ($jour >= $hier) {?>
                    <p class="mb-0 text-muted"><span class="text-teal">+<?php echo round(($jour - $hier)/$hier * 100) ?>%</span> depuis hier</p>
                <?php }elseif($jour < $hier){ ?>
                    <p class="mb-0 text-muted"><span class="text-danger"><?php echo round(($jour - $hier)/$hier * 100) ?>%</span> depuis hier</p>
                <?php } ?> -->
                */ ?>
            </div>
        </div>

        
        
    </section>

    <section class="d-flex flex-wrap justify-content-between align-items-stretch mx-3 mt-4 ">

    <div class="col-12 col-md-7 p-3">
        <div class="bg-white border-radius-lg box-shadow-lg">
            <div id="chartdiv" class="w-100 p-3" style="height:500px"></div>
        </div>
    </div>

    <!-- <div class="col-5 p-3">
        <div class="shadow-sm border-radius-xl">
            <div id="carouselExampleCaptions" class="carousel slide border-radius-xl" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://picsum.photos/200/400" height="500" class="d-block w-100 border-radius-xl" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/200/300" height="500" class="d-block w-100 border-radius-xl" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/200/200" height="500" class="d-block w-100 border-radius-xl" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-12 col-md-5 p-3">
        <div class="bg-white border-radius-lg box-shadow-lg" style="height:500px">
        <?php 

$sql = "SELECT * FROM views WHERE from_site = '$website' AND MONTH(visitor_date) = $month";
$req = $PDO->prepare($sql);
$req->execute();
$data = $req->fetchAll(PDO::FETCH_OBJ);

//echo count($data);
if(!empty($data)):
foreach($data AS $datas):
    $pages[] = $datas->pageView;
    $view = implode(';',$pages);
    $views = explode(';',$view);
endforeach;

$valeurParPage = array_count_values($views);
arsort($valeurParPage);
$page = array_keys($valeurParPage);
$valeur = array_values($valeurParPage);
?>
<table class="table table-striped border-radius-xl">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Rang</th>
      <th scope="col">Pages</th>
      <th scope="col">Vues</th>
    </tr>
  </thead>
  <tbody>
<?php
$start = 1;
for ($i=0; $i <= 7 ; $i++):
    if(isset($page[$i])):
        print_r('<tr><th>#'.($start+$i).'</th><td><a href="'.$path.''.$page[$i].'" target="_blank">'.reduire(str_replace('actualite/','',$page[$i]),40).'</a></td><td>'.$valeur[$i].'</td></tr>');
    endif;
endfor;
?>
</tbody>
</table>
<?php 
else:
    echo '<p class="d-flex justify-content-center">NO DATA</p>';
endif ?>
        </div>
    </div>



    </section>

    <section>
    </section>