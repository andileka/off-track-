<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Damage information") ?></h3></div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Description") ?></label><?=$_CONTROL->txtDescription->RenderFormGroup();?>
        </div>
		<div class="">
			<h3 class="subtitle"><?= tr("Damagepoints") ?></h3>
			<?= $_CONTROL->pnlNotification->RenderFormGroup() ?>
			<?php $_CONTROL->btnDamagePoints->RenderFormGroup(); ?>
		</div>
    </div>
	<div class="col-sm-12 col-md-6">		
		<div class="form-group">
            <label class=""><?= tr("Date at repairer") ?></label><?=$_CONTROL->ddtAtRepairer->RenderFormGroup();?>
        </div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Cause") ?></label><?=$_CONTROL->lstCause->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Fault") ?></label><?=$_CONTROL->lstFault->RenderFormGroup();?>
				</div>
			</div>
		</div>
		<div class="form-group">
            <?=$_CONTROL->blnTotalLoss->RenderFormGroup(true, ['WrapperCssClass' => '+ three-buttons']);?>
        </div>
		<div class="form-group">
			<?= $_CONTROL->blnImmobilized->RenderFormGroup(true, ['WrapperCssClass' => '+ three-buttons']) ?>
        </div>
	</div>
</div>

	
<div class="row">
    <div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Additional") ?></h3>
		<div class="form-group">
			<label class=""><?= tr("Value") ?></label><?=$_CONTROL->txtValue->RenderFormGroup();?>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Limit Amount") ?></label><?=$_CONTROL->txtLimitAmount->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				
				<div class="form-group">
					<label class=""><?= tr("Rdr Limit") ?></label><?=$_CONTROL->txtLimitRdr->RenderFormGroup();?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Min") ?></label><?=$_CONTROL->txtMin->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Max") ?></label><?=$_CONTROL->txtMax->RenderFormGroup();?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Costs") ?></h3>
		<div class="form-group">
			<label class=""><?= tr("Car has been towed") ?></label>
			<?= $_CONTROL->blnTowed->RenderFormGroup(true, ['WrapperCssClass' => '+ two-buttons']) ?>
        </div>
		<div class="form-group">
			<label class=""><?= tr("Has been provisional repaired") ?></label>
			<?= $_CONTROL->blnProvisionalRepaired->RenderFormGroup(true, ['WrapperCssClass' => '+ two-buttons']) ?>
        </div>
		<div class="form-group">
			<label class=""><?= tr("Deduct from intervention") ?></label>
			<?= $_CONTROL->blnDeduct->RenderFormGroup(true, ['WrapperCssClass' => '+ two-buttons']) ?>
        </div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<?php if($_CONTROL->blnBreakdown): ?> 
						<label class=""><?= tr("Breakdown costs") ?></label><?=$_CONTROL->txtBreakDownCosts->RenderFormGroup();?>
					<?php endif ?>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<?php if($_CONTROL->blnShowProvisionalRepaired): ?>
						<label class=""><?= tr("Repair costs") ?></label><?=$_CONTROL->txtProvisionalRepairCosts->RenderFormGroup();?>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 col-md-6">
			<h3 class="subtitle"><?= tr("Impact direction") ?></h3>
			<div class="form-group">
				<label class=""><?= tr("First impactpoint") ?></label><?=$_CONTROL->lstFirstImpact->RenderFormGroup();?>
			</div>
			<?php $_CONTROL->btnDirection->RenderFormGroup(); ?>
	</div>
	<div class="col-sm-12 col-md-6"><?= $_CONTROL->btnSave->Render() ?></div>
	
</div>

