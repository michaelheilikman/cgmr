	<div class="<?php if(@$page == "connexion"){echo "row justify-content-center";} ?>">
		<form id="searchform" method="GET" action="recherche.php" <?php if(@$page == "connexion"){echo 'style="width:445px"';} ?>>
			<div class="input-group mb-3">
				<input type="text" class="form-control" value="<?php echo @$_GET['q'] ?>" id="inputString" onkeyup="lookup(this.value);" placeholder="Rechercher..." name="q"/>
				<button type="submit" class="btn btn-primary"><i class="bi bi-search" ></i></button>
			</div>
			<?php if(@$page != 'search'): ?><div class="suggestions"></div><?php endif; ?>
		</form>
	</div>