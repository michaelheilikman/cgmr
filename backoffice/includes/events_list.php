<form class="d-flex flex-wrap">
				
<div class="form-group col-12 col-md-4 col-lg-4 px-1">
        <input type="text" data-search="search" class="form-control" placeholder="Recherchez dans le tableau..." id="myInput" onkeyup="searchFilter()">
    </div>

</form>


<?php
$sql = "SELECT * FROM blog WHERE from_site = '{$website}' ORDER BY title ASC";
$query = $PDO->prepare($sql);
$query->execute();
$data = $query->fetch();
?>


<div class="table-responsive">
<table class="wrapper table table-striped <?php if(!empty($data->id)){echo 'table-light';} ?>" id="contacts">
    <?php
    $sql = "SELECT * FROM blog WHERE from_site = '{$website}' ORDER BY title ASC";
    $query = $PDO->prepare($sql);
    $query->execute();
    $data = $query->fetch();
    
    ?>
        <thead class="bg-secondary text-light">
            <tr>
                <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                    <th class="">Titre</th>
                    <th class="">Créé par</th>
                    <th class="">Date</th>
                <?php  }else{ ?>
                    <th>Titre</td>
                <?php } ?>
            </tr>
        </thead>

        <tbody id="myUL">

            <?php
                $sql = "SELECT * FROM blog WHERE from_site = '{$website}' ORDER BY blogDate DESC";
                $query = $PDO->prepare($sql);
                $query->execute();
                while($data = $query->fetch(PDO::FETCH_OBJ)){
            ?>

                <tr>
                
                    <td width="60%" style="line-height:20px" class="actuTitle">
                        <p class="text-dark mb-0 pb-0"><?php echo $data->title ?></p>
                        <?php if($Auth->user('role') == 'admin' OR $Auth->user('role') =='superAdmin'){ ?>
                        <small class="mt-0 pt-0"><a href="eventEdit.php?id=<?php echo $data->id ?>">Modifier</a> | <a href="#" class="suppr_blog text-danger" id="<?php echo $data->id ?>" data-name ="<?= $data->title ?>" data-toggle="modal" data-target="#supprimer">corbeille</a> | <a href="<?php echo $path ?>actualite/<?php echo $data->url ?>" target="_blank">voir</a></small>
                        <?php } ?>
                    </td>
                        
                    <td style="line-height:20px">
                        <p class="text-dark mb-0 pb-0"><?php echo $data->creator ?></p>
                    </td>

                    <td style="line-height:20px">
                        <p class="text-dark mb-0 pb-0">Publié</p>
                        <small><?php echo $data->blogDate ?></small>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    

    

</table> <!-- / myUL -->

</div> <!-- / table responsive -->


