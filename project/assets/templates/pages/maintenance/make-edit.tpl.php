<style>
	.breadcrumb{background:transparent;}
	.chk_select label {
		width:100%;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=workflow"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
</div>
<div class="col-sm-6">
	<?= 
		$_CONTROL->lstVehicleType->RenderFormGroup();
		$_CONTROL->txtName->RenderFormGroup();
	?>
	
	<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
</div>