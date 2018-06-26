<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Estimate detail") ?></h3></div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Labour Hours") ?></label><?=$_CONTROL->txtLabourHours->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Labour Costs") ?></label><?=$_CONTROL->txtLabourCosts->RenderFormGroup();?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label class=""><?= tr("Painting labour") ?></label><?=$_CONTROL->txtPaintingLabourHours->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label class=""><?= tr("Painting labor Costs") ?></label><?=$_CONTROL->txtPaintingLaborCost->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label class=""><?= tr("Painting Costs") ?></label><?=$_CONTROL->txtPaintingCost->RenderFormGroup();?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Parts Costs") ?></label><?=$_CONTROL->txtPartCost->RenderFormGroup();?>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					<label class=""><?= tr("Other Costs") ?></label><?=$_CONTROL->txtOtherCosts->RenderFormGroup();?>
				</div>
			</div>
        </div>
		<div class="form-group">
			<label class=""><?= tr("Status") ?></label><?=$_CONTROL->blnStatus->RenderFormGroup(true, ['WrapperCssClass' => '+ three-buttons']);?>
		</div>
    </div>
	<div class="col-sm-12 col-md-6">		
		<div class="form-group">
            <label class=""><?= tr("Substract amount") ?><sup>*</sup></label><?=$_CONTROL->txtSubstractCosts->RenderFormGroup();?>
        </div>
		<div class="form-group">
            <label class=""><?= tr("Date recieved") ?><sup>*</sup></label><?=$_CONTROL->dttDateRecieved->RenderFormGroup();?>
        </div>
		<div class="form-group">
            <label class=""><?= tr("Comment") ?></label><?=$_CONTROL->txtComment->RenderFormGroup();?>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Overview estimates") ?></h3></div>
</div>
<div class="row">
		<div class="col-md-12"><?= $_CONTROL->btnSave->RenderFormGroup(); ?></div>
</div>
<div class="row">
	<div class="col-md-12"><?= $_CONTROL->ddgJobEstimate->RenderFormGroup(); ?></div>
</div>

