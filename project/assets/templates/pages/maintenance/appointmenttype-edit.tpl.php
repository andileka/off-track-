<style>.breadcrumb{background:transparent;}</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=appointmenttype"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
	<div class="col-sm-6">
		<?= 
			$_CONTROL->txtNameEn->RenderFormGroup();
			$_CONTROL->txtNameFr->RenderFormGroup();
			$_CONTROL->txtNameNl->RenderFormGroup();	
		?>
		<div class="row">
			<div class="col-md-3">
				<?=  $_CONTROL->chkActive->RenderFormGroup(); ?>
			</div>
		</div>
		<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
	</div>
</div>