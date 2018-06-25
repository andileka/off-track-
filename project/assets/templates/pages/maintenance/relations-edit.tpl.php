<div class="row">
	<div class="col-sm-12">
	<?= 
		$_CONTROL->lstRole->RenderFormGroup(true, ['WrapperCssClass' => '+ col-md-6']);
		$_CONTROL->lstEntity->RenderFormGroup(true, ['WrapperCssClass' => '+ col-md-6']);
	?>
	</div>
</div>


<div class="row">
	<div class="col-sm-12">
		<?= $_CONTROL->btnSave->RenderFormGroup(true, ['WrapperCssClass' => '+ col-md-2']); ?>
	</div>
</div>