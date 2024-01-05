<?php
include 'includes/session-Auth.php';
$page = 'search';
$pageTitle = 'Explore cutting-edge research on our website today!';
?>

<?php include 'includes/doctype.php' ?>
<?php include 'includes/nav.php' ?>


<div class="container search">


<?php

// fonction pour transformer un mot au pluriel


if(!empty($_GET['q'])){

  $q = mb_strtolower($_GET['q'],'UTF-8'); // Modification
  $q = str_replace("'", "’", $q);
  $s = explode(" ",$q);
  
  $stmt="SELECT title,description,photo FROM blog";


$k=0;
foreach ($s as $terme){
  $terme = mb_strtolower($terme,'UTF-8'); // Modification
    if(strlen($terme)>=2){
        if($k==0){
            $stmt.=" WHERE ";
        }
        else{
            $stmt.=" AND ";
        }
        $stmt.="((title LIKE '%$terme%' OR description LIKE '%$terme%' OR photo LIKE '%$terme%') OR (title LIKE '%".plural($terme)."%' OR description LIKE '%".plural($terme)."%' OR photo LIKE '%".plural($terme)."%') OR (title LIKE '%".singular($terme)."%' OR description LIKE '%".singular($terme)."%' OR photo LIKE '%".singular($terme)."%'))";
        $k++;

    }
}

$stmt .= " ORDER BY (";
foreach ($s as $terme) {
    if(strlen($terme)>=2){
        $stmt .= "CASE
                    WHEN title LIKE '%$terme%' THEN 1
                    WHEN description LIKE '%$terme%' THEN 2
                    WHEN photo LIKE '%$terme%' THEN 3
                    ELSE 5
                END + ";
    }
}
$stmt = rtrim($stmt, "+ ");
$stmt .= ") ASC";
$query = $PDO->prepare($stmt);
$query->execute();

$nbArticles = $query->rowCount();

    // On détermine sur quelle page on se trouve
    if(isset($_GET['page']) && !empty($_GET['page'])){
      $currentPage = (int)$_GET['page'];
      }else{
      $currentPage = 1;
      }

  // On détermine le nombre d'articles par pagestmt
  $parPage = 10;
  // Calcul du 1er article de la page
  $premier = (int)($currentPage * $parPage) - $parPage;
  // On calcule le nombre de pages total
  $pages = ceil($nbArticles / $parPage);


$sql="SELECT title,description,photo,url FROM blog";
  
  $i=0;
  foreach ($s as $mot){
    $mot = mb_strtolower($mot,'UTF-8'); // Modification
      if(strlen($mot)>=2){
          if($i==0){
              $sql.=" WHERE ";
          }
          else{
              $sql.=" AND ";
          }
          $sql.="((title LIKE '%$mot%' OR description LIKE '%$mot%' OR photo LIKE '%$mot%') OR (title LIKE '%".plural($mot)."%' OR description LIKE '%".plural($mot)."%' OR photo LIKE '%".plural($mot)."%') OR (title LIKE '%".singular($mot)."%' OR description LIKE '%".singular($mot)."%' OR photo LIKE '%".singular($mot)."%'))";
          $i++;

      }
  }
  
  $sql .= " ORDER BY (";
  foreach ($s as $mot) {
      if(strlen($mot)>=2){
          $sql .= "CASE
                      WHEN title LIKE '%$mot%' THEN 1
                      WHEN description LIKE '%$mot%' THEN 2
                      WHEN photo LIKE '%$mot%' THEN 3
                      ELSE 5
                  END + ";
      }
  }
  $sql = rtrim($sql, "+ ");
  $sql .= ") ASC LIMIT :parpage OFFSET :premier";

  $sth = $PDO->prepare($sql);
  $sth->bindValue(':premier', $premier, PDO::PARAM_INT);
  $sth->bindValue(':parpage', $parPage, PDO::PARAM_INT);
  $sth->execute();

echo '<div class="mt-5 mb-0">';
echo '<h3 class="h3 mb-4 text-dark font-weight-bold">'.$_GET["q"].' <span id="loader" class="spinner-border text-danger" role="status" aria-hidden="true" style="display:none;position:relative;top:0;font-weight:lighter"></span></h3>';
include 'includes/modules/search.php';
echo '</div>';

if($query->rowCount() > 1){
echo "<p class='mb-5'>Total results for <span class='font-italic text-success font-weight-bold'>{$_GET['q']}</span> : <small class='font-weight-bold'>".$query->rowCount()."</small></p>";
}else{
  echo "<p class='mb-5'>Result found for <span class='font-italic text-success font-weight-bold'>{$_GET['q']}</span> : <small class='font-weight-bold'>".$query->rowCount()."</small></p>";
}
  echo '<ul class="list-group list-group-flush" id="results-list" style="list-style-type:none;background-color:none;">';
  while($data = $sth->fetch(PDO::FETCH_ASSOC)) {
      $c=$data['title'];
      $i=0;
      $article = stripslashes($data['description']);
      $d=reduire(strip_tags($article),600);
      $e=substr($data['photo'],0,-4);
      $f=stripslashes($_GET['q']);
      
      foreach ($s as $mot) {
          $i++;
          if($i>4){$i=1;}
          $c=str_ireplace($mot, '<span class="surlign'.$i.'">'.$mot.'</span>',$c);
          $d=str_ireplace($mot, '<span class="surlign'.$i.'">'.$mot.'</span>',$d);
          $e=str_ireplace($mot, '<span class="surlign'.$i.'">'.$mot.'</span>',$e);
          $f=str_ireplace($mot, '<span class="surlign'.$i.'">'.$mot.'</span>',$f);
      }
      echo "<li class=\"list-group-item mb-3 bg-white keep-white\">";
      echo "<a class=\"text-danger\" href=\"project/{$data['url']}\">";
      echo "{$c}";
      echo "</a>";
      echo "<div class='small text-secondary'>{$e}</div>";
      echo "<div style='line-height:1.7em;font-size:90%'>";
      echo "<p class='mb-0 text-dark'>{$d}</p>";
      echo "</div>";
      echo "<div class='small text-success'>";
          echo "Search term: {$f}";
      echo "</div>";

      echo "</li>";
  }
  echo "</ul>"; ?>
  <nav>
  <ul class="pagination">
      <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
      <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
          <a href="<?= $path ?>recherche.php?q=<?= $_GET['q'] ?>&page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
      </li>
      <?php for($page = 1; $page <= $pages; $page++): ?>
        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
              <a href="<?= $path ?>recherche.php?q=<?= $_GET['q'] ?>&page=<?= $page ?>" class="page-link"><?= $page ?></a>
          </li>
      <?php endfor ?>
        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
          <a href="<?= $path ?>recherche.php?q=<?= $_GET['q'] ?>&page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
      </li>
  </ul>
</nav>
<?php }
else{
    echo "<h3 class='mt-5 fs-1 text-primary'>Let's find what you're looking for!😎
    <br><span class='fs-3'> Just type a keyword in the search bar and we'll take care of the rest<span></h3>
    <p>Example : design</p>";
    echo '<div class="my-4 mb-5">';
  include 'includes/modules/search.php';
  echo '</div>';
}
?>
</div>


<!-- DEBUT DU FOOTER -->
<?php include 'includes/footer.php'; ?>
<?php include 'includes/end.php'; ?>
<!-- FIN DU FOOTER -->