<style>.breadcrumb{background:transparent;}</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=customfields"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
	<div class="col-sm-6">
		<?= 
			$_CONTROL->txtNameEn->RenderFormGroup();
			$_CONTROL->txtNameFr->RenderFormGroup();
			$_CONTROL->txtNameNl->RenderFormGroup();
			$_CONTROL->lstType->RenderFormGroup();
			$_CONTROL->txtPossibleValues->RenderFormGroup();
			$_CONTROL->lstContainer->RenderFormGroup();
		?>
		<div class="row">
			<div class="col-md-3">
				<?=  $_CONTROL->ckActive->RenderFormGroup(); ?>
			</div>
			<div class="col-md-3">
				<?=  $_CONTROL->ckRequired->RenderFormGroup(); ?>
			</div>
		</div>
		<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
	</div>
</div>