<div class="row">
	<div class="col-md-12"><?= $_CONTROL->pnlWarning->RenderFormGroup() ?></div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-8">
		<?= $_CONTROL->lstTemplates->RenderFormGroup(); ?>
	</div>
	<div class="col-sm-12 col-md-3">
		<?= $_CONTROL->lstType->RenderFormGroup(); ?>
	</div>
	<div class="col-sm-12 col-md-1">
		<?= $_CONTROL->lstLang->RenderFormGroup(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3 class="subtitle"><?= tr("Send To") ?></h3>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<?= $_CONTROL->txtSubject->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<?= $_CONTROL->lstEntityEmailList->RenderFormGroup(); ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?= $_CONTROL->pnlEntityWarning->RenderFormGroup(); ?>
		<div class="row">
			<div class="col-sm-12 col-md-6"><?= $_CONTROL->pnlEntityEmail->RenderFormGroup(); ?></div>
			<div class="col-sm-12 col-md-6"><?= $_CONTROL->btnSaveEntity->RenderFormGroup(); ?></div>
		</div>
		
		<?= $_CONTROL->ckMessage->RenderFormGroup(); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
	</div>
</div>
