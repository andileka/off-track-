<div class="col-sm-3">
	<div class="row">
		<div class="col-xs-11 col-xs-push-1">
			<h2><?= $_CONTROL->lblFilter->RenderFormGroup() ?></h2>
		</div>
		<div class="col-xs-11 col-xs-push-1">
			<?php 
				$_CONTROL->lstAssignedTo->RenderFormGroup(); 
				$_CONTROL->txtPlate->RenderFormGroup(); 
				$_CONTROL->lstWorkflowStatus->RenderFormGroup(); 
			?>
		</div>
	</div>
</div>
<div class="col-sm-12" style="margin-top:20px;">
	<div class="row">
		<div class="col-xs-12">
			<!--?php $_CONTROL->btnNew->RenderFormGroup(); ?-->
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php $_CONTROL->tblWork->RenderFormGroup(); ?>
		</div>
	</div>
</div>