<div class="row">
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Car information") ?></h3>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label><?= tr("Vehicle type") ?><sup>*</sup></label>
				<?= $_CONTROL->lstVehicletype->RenderFormGroup(); ?>
            </div>
			<?php if(!$_CONTROL->blnHideVin): ?>
				<div class="col-md-6 col-sm-12">
					<label class="search-field"><?= tr("Vin") ?></label>
					<?= $_CONTROL->txtVin->RenderFormGroup(); ?>
				</div>
			<?php endif ?>
        </div>
        <div class="form-group">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<label class="search-field"><?= tr("Plate") ?></label>
					<?= $_CONTROL->txtPlate->RenderFormGroup(); ?>
				</div>
				<div class="col-md-6 col-sm-12">
					<label><?= tr("Make") ?><sup>*</sup></label>
					<?= $_CONTROL->lstMake->RenderFormGroup(); ?>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12"><label>
				<?= tr("Model") ?></label>
				<?= $_CONTROL->txtModel->RenderFormGroup(); ?>
            </div>
			<div class="col-md-6 col-sm-12">
                <label><?= tr("Model type") ?></label>
				<?= $_CONTROL->txtModelType->RenderFormGroup(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label><?= tr("Color") ?></label>
				<?= $_CONTROL->txtColor->RenderFormGroup(); ?>
            </div>
			<div class="col-md-6 col-sm-12">
				<?= $_CONTROL->pnlKnowJobs->RenderFormGroup(); ?>
			</div>
        </div>
    </div>
	<?php if(!$_CONTROL->blnHideTechnicalInfo): ?>
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Technical information") ?></h3>
        <div class="row">
			<?php if (!$_CONTROL->blnHideNumber): ?>
				<div class="col-sm-12 col-md-6">
					<label class=""><?= tr("Vehicle #") ?></label>
					<?= $_CONTROL->txtVehicleNumber->RenderFormGroup(); ?>
				</div>
			<?php endif ?>
			<?php if(!$_CONTROL->blnHasEngine): ?>
				<div class="col-sm-12 col-md-6">
					<label class=""><?= tr("Fuel type") ?></label>
					<?= $_CONTROL->lstFuelType->RenderFormGroup(); ?>
				</div>
				<div class="col-sm-12 col-md-6">
					<label class=""><?= tr("CO2") ?></label>
					<?= $_CONTROL->txtCo2->RenderFormGroup(); ?>
				</div>
			<?php endif ?>
        </div>
		<?php if(!$_CONTROL->blnHasEngine): ?>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<label class=""><?= tr("Engine capacity") ?></label>
					<?= $_CONTROL->txtEngineCapacity->RenderFormGroup(); ?>
				</div>
				<div class="col-sm-12 col-md-4">
					<label class=""><?= tr("Horsepower") ?></label>
					<?= $_CONTROL->txtHorsepower->RenderFormGroup(); ?>
				</div>
				<div class="col-sm-12 col-md-4">
					<label class=""><?= tr("kW") ?></label>
					<?= $_CONTROL->txtkW->RenderFormGroup(); ?>
				</div>
			</div>
		<?php endif ?>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <label class=""><?= tr("Payload") ?></label>
				<?= $_CONTROL->txtPayload->RenderFormGroup(); ?>
            </div>
            <div class="col-sm-12 col-md-6">
                <label class=""><?= tr("Tarra") ?></label>
				<?= $_CONTROL->txtTarra->RenderFormGroup(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <label class=""><?= tr("# seats") ?></label>
				<?= $_CONTROL->txtNmbrSeats->RenderFormGroup(); ?>
            </div>		
			<div class="col-sm-12 col-md-3">
				<label class=""><?= tr("Profile tyre") ?></label>
				<?= $_CONTROL->lstTireProfile->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-4">
				<label class=""><?= tr("Profile depth") ?></label>
				<?= $_CONTROL->txtProfileDepth->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-2">
				<label class="">&nbsp;</label>
				<?= $_CONTROL->btnAdd->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<?php if($_CONTROL->blnHasTires): ?> 
					<h3 class="subtitle"><?= tr("Tyre information") ?></h3>
					<?= $_CONTROL->ddgTireInfo->RenderFormGroup() ?>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<?php endif ?>
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Additional information") ?></h3>
        <div class="row">
			<?php if(!$_CONTROL->blnMileage): ?>
				<div class="col-sm-12 col-md-6">
					<label class=""><?= tr("Mileage") ?></label>
					<?= $_CONTROL->txtMileage->RenderFormGroup(); ?>
				</div>
			<?php endif ?>
			<?php if(!$_CONTROL->bldttFirstRegistrationDate): ?>
				<div class="col-sm-12 col-md-6">
					<label class=""><?= tr("First registration") ?></label>
					<?= $_CONTROL->dttFirstRegistrationDate->RenderFormGroup(); ?>
				</div>
			<?php endif ?>
        </div>
        <div class="row">
			<?php if(!$_CONTROL->blddttLastRegistrationDate): ?>
				<div class="col-sm-12 col-md-6">
					<label class=""><?= tr("Last registration") ?></label>
					<?= $_CONTROL->dttLastRegistrationDate->RenderFormGroup(); ?>
				</div>
			<?php endif ?>
            <div class="col-sm-12 col-md-6">
                <label class=""><?= tr("Retail value") ?></label>
				<?= $_CONTROL->txtRetailValue->RenderFormGroup(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <label class=""><?= tr("Current value") ?></label>
				<?= $_CONTROL->txtCurrentValue->RenderFormGroup(); ?>
            </div>
        </div>
    </div>
	<?php if(!$_CONTROL->blnHideOptions): ?>
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Options") ?></h3>
        <div class="row">
            <div class="col-sm-12 col-md-6"><?= $_CONTROL->chkHasAlarm->RenderFormGroup(); ?></div>
            <div class="col-sm-12 col-md-6"><?= $_CONTROL->chkHasSootFilter->RenderFormGroup(); ?></div>
        </div>
    </div>
	<?php endif ?>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="col-sm-12"><?= $_CONTROL->pnlCustomfields->RenderFormGroup(); ?></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12"><?= $_CONTROL->btnSave->RenderFormGroup(); ?></div>
    </div>
</div>
