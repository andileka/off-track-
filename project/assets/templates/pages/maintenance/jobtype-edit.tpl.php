<style>
	.breadcrumb{background:transparent;}
	.chk_select label {
		width:100%;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=jobtype"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
</div>
<div class="col-sm-6">
	<div class="row">
		<div class="col-sm-12">
			<?= 
				$_CONTROL->txtNameEn->RenderFormGroup();
				$_CONTROL->txtNameFr->RenderFormGroup();
				$_CONTROL->txtNameNl->RenderFormGroup();
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<label><?= tr("Color") ?></label>
			<?= $_CONTROL->txtColor->RenderFormGroup(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<?=  $_CONTROL->chkActive->RenderFormGroup(); ?>
		</div>
	</div>
	<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
</div>