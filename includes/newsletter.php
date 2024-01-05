<div class="newsletter p-4">
	<form>
		<h5 class="text-primary mb-3 fw-bold">Subscribe the newsletter</h5>
		<div class="input-group mb-3">
			<span class="input-group-text"><i class="bi bi-person-badge"></i></span>
			<div class="form-floating">
				<input type="text" class="form-control" id="newsprenom" placeholder="Prénom"/>
				<label for="typeCode" class="text-black">First name</label>
			</div>
			<div class="form-floating">
				<input type="text" class="form-control" id="newsnom" placeholder="Nom"/>
				<label for="typeCode" class="text-black">Last name</label>
			</div>
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text"><i class="bi bi-envelope"></i></span>
			<div class="form-floating">
				<input type="email" class="form-control" id="newsmail" placeholder="Email"/>
				<label for="typeCode" class="text-black">Email</label>
			</div>
		</div>
		<div class="d-grid">
			<button type="submit" class="btn btn-primary" id="addNewNews" data-website="<?php echo $website ?>">SUBSCRIBE NOW</button>
		</div>
	</form>
</div>