 <div class="col-sm-3">
	<div class="row">
		<div class="col-xs-11 col-xs-push-1">
			<h2><?= $_CONTROL->lblFilter->RenderFormGroup() ?></h2>
		</div>
		<div class="col-xs-11 col-xs-push-1">
			<?php 
				$_CONTROL->txtNumber->RenderFormGroup(); 
				$_CONTROL->lstType->RenderFormGroup(); 
				$_CONTROL->txtEntity->RenderFormGroup(); 
			?>
		</div>
	</div>
</div>
<div class="col-sm-9">
	<div class="row">
		<div class="col-xs-12">
			<?php $_CONTROL->btnNew->Render(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php  $_CONTROL->lstExpert->Render(); ?>
		</div>
	</div>
</div>