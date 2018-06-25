<div class="row">
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Area information") ?></h3>
		<label><?= tr("Area name") ?></label>
		<?= $_CONTROL->txtName->RenderFormGroup(); ?>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h3 class="subtitle"><?= tr("Select days AM") ?></h3>
				<?= $_CONTROL->pnlDayAM->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<h3 class="subtitle"><?= tr("Select days PM") ?></h3>
				<?= $_CONTROL->pnlDayPM->RenderFormGroup(); ?>
				<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Add city") ?></h3>
		<label><?= tr("Add zipcode") ?></label>
		<?= $_CONTROL->blnAddZipRange->RenderFormGroup(true, ['WrapperCssClass' => '+ two-buttons']); ?>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<label><?= tr("Country") ?></label>
				<?= $_CONTROL->lstCountry->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<?= $_CONTROL->txtCity->RenderFormGroup(); ?>
			</div>		
			<div class="col-sm-12 col-md-3">
				<?= $_CONTROL->txtRangeMin->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-3">
				<?= $_CONTROL->txtRangeMax->RenderFormGroup(); ?>			
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12"><?= $_CONTROL->addZipCode->RenderFormGroup() ?></div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h3 class="subtitle"><?= tr("Overview zipcodes") ?></h3>
				<?= $_CONTROL->dgZipcodes->RenderFormGroup() ?>
			</div>
		</div>
	</div>
</div>