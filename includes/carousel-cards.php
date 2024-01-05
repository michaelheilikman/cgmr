<div class="container pt-3 pb-md-5">
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php 
            $sql = "SELECT * FROM blog";
            $query = $PDO->prepare($sql);
            $query->execute();
            
            while ($data = $query->fetch(PDO::FETCH_OBJ)) {
                $photo = substr($data->photo, 0, -4);
        ?>
			<div class="swiper-slide pb-5">
				<a href="<?= $path.'chantier/'.$data->url ?>">
					<div class="image-container">
						<img src="<?= $path ?>backoffice/imgs/original/<?= $photo ?>.jpg" class="img-fluid" alt="<?= htmlspecialchars($data->title) ?>">
					</div>
					<div class="slide-caption">
						<!-- <h5><?= htmlspecialchars($data->title) ?></h5>
						<p><?= htmlspecialchars(reduire($data->description, 100)) ?></p> -->
					</div>
				</a>
			</div>
			
        <?php } ?>
    </div>
    
    <div class="swiper-pagination"></div>
    <?php 
        $query->execute();
        $datas = $query->fetchAll();
        $countchantier =  count($datas);

        if($countchantier > 3):
    ?>
    <div class="swiper-button-prev d-none d-md-block"><div class="btn btn-xs btn-danger p-0"><i class="bi bi-arrow-left"></i></div></div>
    <div class="swiper-button-next d-none d-md-block"><div class="btn btn-xs btn-danger p-0"><i class="bi bi-arrow-right"></i></div></div>
    <?php endif ?>
</div>

</div>
