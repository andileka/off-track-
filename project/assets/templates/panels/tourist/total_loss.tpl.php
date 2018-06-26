<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Total loss information") ?></h3></div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label class=""><?= tr("Type") ?><sup>*</sup></label><?=$_CONTROL->lstType->RenderFormGroup();?>
        </div>
        <div class="form-group">
            <label class=""><?= tr("Marge On Sale") ?></label><?=$_CONTROL->blnMargeOnSale->RenderFormGroup(true, ['WrapperCssClass' => '+ two-buttons']);?>
        </div>
    </div>
	<div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Destination Vehicle") ?><sup>*</sup></label>
			<?=$_CONTROL->lstDestinationVehicle->RenderFormGroup();?>
        </div>
		
	</div>
</div>
<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Costs") ?></h3></div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Current Value") ?></label>
			<?=$_CONTROL->txtCurrentValue->RenderFormGroup();?>
        </div>
		<div class="form-group">
            <label class=""><?= tr("Deducted Value") ?></label><?=$_CONTROL->txtDeductedValue->RenderFormGroup();?>
        </div>
    </div>
	<div class="col-sm-12 col-md-6">
		<div class="row">
            <div class="col-md-6 col-sm-12">
               <label class=""><?= tr("Costs: Subject To VTA") ?></label>
				<?=$_CONTROL->txtCostsSubjectToVTA->RenderFormGroup();?>
            </div>
            <div class="col-md-6 col-sm-12">
                <label class=""><?= tr("Costs: Not Subject To VTA") ?></label>
			<?=$_CONTROL->txtCostsNoSubjectVTA->RenderFormGroup();?>
            </div>
		</div>
		<div class="row">
            <div class="col-md-6 col-sm-12">
                <label class=""><?= tr("Transfer Accessories") ?></label>
						<?=$_CONTROL->txtTransferAccessories->RenderFormGroup();?>
            </div>
            <div class="col-md-6 col-sm-12">
                <label class=""><?= tr("Replace Accessories") ?></label>
						<?=$_CONTROL->txtReplaceAccessories->RenderFormGroup();?>
            </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Quotations") ?></h3></div>
</div>
<?= $_CONTROL->pnlQuotations->RenderFormGroup() ?>


<div class="row">
    <div class="col-md-12">
        <div class="col-md-12"><?= $_CONTROL->btnSave->RenderFormGroup(); ?></div>
    </div>
</div>
