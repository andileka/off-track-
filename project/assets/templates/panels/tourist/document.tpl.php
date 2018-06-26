<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Uploaded documents") ?></h3></div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php if($_CONTROL->pnlGallery): ?>
			<?php $_CONTROL->pnlGallery->RenderFormGroup(true, ['WrapperCssClass' => '+ pnlgallery']); ?>
		<?php endif; ?>
	</div>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6"><?php $_CONTROL->flDocument->RenderFormGroup(); ?></div>
			<div class="col-md-6"><?= $_CONTROL->btnUpload->RenderFormGroup(); ?></div>
		</div>
	</div>
</div>