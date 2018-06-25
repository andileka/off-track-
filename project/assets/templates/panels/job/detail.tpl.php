<div class="row">
	<div class="col-sm-12"><?= $_CONTROL->pnlNotification->RenderFormGroup() ?></div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h3 class="subtitle"><?= tr("Job information") ?></h3>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label class=""><?= tr("Type") ?><sup>*</sup></label><?=$_CONTROL->lstJobType->RenderFormGroup();?>
						</div>
						<div class="form-group">
							<label class=""><?= tr("Accident date") ?></label>
							<?=$_CONTROL->dtAccidentDate->RenderFormGroup();?>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label class=""><?= tr("Status") ?></label><?=$_CONTROL->lstJobStatus->RenderFormGroup();?>
						</div>
						<div class="form-group">
							<label class=""><?= tr("Languague") ?></label>
							<?=$_CONTROL->lstLanguage->RenderFormGroup();?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<h3 class="subtitle"><?= tr("Car information") ?></h3>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<label class="search-field"><?= tr("Vin") ?></label>
						<?= $_CONTROL->txtVin->RenderFormGroup() ?>	
					</div>
					<div class="col-sm-12 col-md-6">
						<label class="search-field"><?= tr("Plate") ?></label>
						<?= $_CONTROL->txtPlate->RenderFormGroup() ?>	
					</div>
				</div>
				
			</div>
		</div>
    </div>
</div>
<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Informex information") ?></h3></div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Type of mandate") ?></label>
			<?= $_CONTROL->lstMandateType->RenderFormGroup() ?>
        </div>
		<?= $_CONTROL->blnRemoteInspection->RenderFormGroup(true, ['WrapperCssClass' => '+ three-buttons']) ?>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Limit amount direct payment") ?></label>
			<?= $_CONTROL->lstLimitAmountType->RenderFormGroup() ?>
        </div>
		<?= $_CONTROL->blnThoroughMandate->RenderFormGroup(true, ['WrapperCssClass' => '+ three-buttons']) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Mandator") ?></h3></div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="form-group">
			<?= $_CONTROL->txtMandatorName->RenderFormGroup() ?>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label class=""><?= tr("Policy cover") ?></label>
					<?= $_CONTROL->lstPolicyType->RenderFormGroup() ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label class=""><?= tr("Policy #") ?></label>
					<?= $_CONTROL->txtPolicyNr->RenderFormGroup() ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label class=""><?= tr("Exemption % | €") ?></label>
					<?= $_CONTROL->txtExemption->RenderFormGroup() ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label class=""><?= tr("Type of exemption") ?></label>
					<?= $_CONTROL->lstExemptionType->RenderFormGroup() ?>
                </div>
            </div>
        </div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Claim reference") ?></label>
			<?= $_CONTROL->txtClaimReference->RenderFormGroup() ?>
        </div>
		<div class="form-group">
            <label class=""><?= tr("Insured value") ?></label>
			<?= $_CONTROL->txtInsuredValue->RenderFormGroup() ?>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<?= $_CONTROL->pnlCustomfields->RenderFormGroup(); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
			<?php $_CONTROL->btnSave->RenderFormGroup(); ?>
	</div>	
</div>	
