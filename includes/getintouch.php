<div class="container text-center py-4">
	<div class="border-0 text-center p-4 p-lg-6">
		<div class="row card-body mb-3 mb-lg-4">
			<div class="col-xl-11 col-xxl-10 mx-auto">
				<div class="lc-block mb-5">
					<p class="text-uppercase" editable="inline">Don't be shy, drop me a line!</p>
					<h3 editable="inline" class="fw-bold display-2"><span class="text-primary">Get in touch</span>, I'd <span class="text-danger">❤</span> to hear from you!</h3>
				</div>
            <?php if ($page != 'contact'): ?>
				<div class="lc-block mb-4">
					<div class="d-flex flex-wrap justify-content-center gap-3">

						<div class="d-inline-flex gap-1">
                            <i class="bi bi-check2-circle text-primary fs-1 me-2"></i>
							<p editable="inline" class="lead my-auto">Unquestionably secure</p>

						</div>
						

					</div>
				</div>
            <?php endif ?>
			</div>
		</div>
        <?php if ($page != 'contact'): ?>
		<div><a class="btn btn-lg btn-primary" href="<?= $path ?>contact-me" role="button">Contact me</a></div>
        <?php endif ?>
	</div>
</div>
