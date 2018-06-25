<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label class=""><?= tr("Valid until") ?></label><?=$_CONTROL->ddtValidUntil->RenderFormGroup();?>
        </div>
    </div>
	<div class="col-sm-12 col-md-6">
		<div class="form-group">
            <label class=""><?= tr("Reason lower quotation") ?></label><?=$_CONTROL->lstLowerQuotation->RenderFormGroup();?>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">	
		<h3 class="subtitle"><?= tr("Buyer") ?></h3>
		<?=$_CONTROL->pnlBuyers->RenderFormGroup();?>
	</div>
	<div class="col-sm-12 col-md-6">	
		<h3 class="subtitle"><?= tr("Buyer overview") ?></h3>
		<?= $_CONTROL->dgBuyers->RenderFormGroup() ?>
	</div>
</div>

