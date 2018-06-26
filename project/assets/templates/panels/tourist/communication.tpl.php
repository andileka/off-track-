<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("New communication") ?></h3></div>
</div>
<div class="row">
	<div class="col-md-12">
		<?= $_CONTROL->pnlCommunication->RenderFormGroup(); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Select documents") ?></h3></div>
</div>
<div class="row">
	<div class="col-md-12">	
		<?= $_CONTROL->pnlGallery->RenderFormGroup(); ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Communication history") ?></h3></div>
</div>
<div class="row">
	<div class="col-md-12"><?= $_CONTROL->dgCommunications->RenderFormGroup(); ?></div>
</div>