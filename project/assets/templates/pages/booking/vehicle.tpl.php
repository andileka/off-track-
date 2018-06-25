<div class="row" style="margin-top:15px;">
	<div class="col-md-6">
		<div><?= $_CONTROL->lstVehicletype->RenderFormGroup() ?></div>
		<div><?= $_CONTROL->lstMake->RenderFormGroup() ?></div>	
		<div><?= $_CONTROL->txtModel->RenderFormGroup() ?></div>		
		<div><?= $_CONTROL->txtNumberKm->RenderFormGroup() ?></div>	
	</div>
	<div class="col-md-6">
		<div><?= $_CONTROL->txtVin->RenderFormGroup() ?></div>	
		<div><?= $_CONTROL->txtColor->RenderFormGroup() ?></div>
		<div><?= $_CONTROL->ddtDateAccident->RenderFormGroup() ?></div>	
		<div><?= $_CONTROL->txtPlate->RenderFormGroup() ?></div>	
	</div>
</div>