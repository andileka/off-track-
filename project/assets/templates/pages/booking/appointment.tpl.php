<style>
	textarea{min-height:170px;}
</style>
<div class="row" style="margin-top:15px;">
	<?= $_CONTROL->pnlNotification->RenderFormGroup(true, ['WrapperCssClass' => '+ col-sm-12']) ?>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<?php $_CONTROL->lstType->RenderFormgroup();?>
		<?php $_CONTROL->pnlTimeOfDay->RenderFormgroup(true, ['WrapperCssClass' => '+ two-buttons']); ?>
		<?php $_CONTROL->blnPreferredTimeMayChange->RenderFormgroup(true, ['WrapperCssClass' => '+ two-buttons']); ?>
	</div>
	
	<div class="col-sm-12 col-md-6">
		<?php $_CONTROL->txtComment->RenderFormgroup(true, ['WrapperCssClass' => '+ col-md-12 col-sm-12']); ?>	
	</div>
	
</div>
<div class="row">
	<div class="col-sm-12 col-md-12">
		<?= $_CONTROL->pnlDatepickerContainer->RenderFormgroup(true, ['WrapperCssClass' => '+ col-sm-12 ll-skin-latoja']); ?>
	</div>
</div>