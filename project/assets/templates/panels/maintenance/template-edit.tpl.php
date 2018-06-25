<div class="row">
    <div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Add new template") ?></h3>
        <div class="row">
			<div class="col-sm-10 col-md-10">
				<?= $_CONTROL->lstTemplateTags->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-2 col-md-2">
				<div  style="margin-top: 27px"><?= $_CONTROL->btnExportTags->RenderFormGroup(); ?></div>
			</div>
		</div>
		<?= $_CONTROL->txtSubject->RenderFormGroup(); ?>
		<label><?= tr("Body") ?></label>
		<?= $_CONTROL->ckMessage->RenderFormGroup(); ?>
	</div>
    <div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Add Documents") ?></h3>
		<?= $_CONTROL->lstDocuments->RenderFormGroup(); ?>
		<?= $_CONTROL->flDocument->RenderFormGroup(); ?>
	</div>
</div>