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
<div class="row">
	<div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Add new workflow") ?></h3>
		<label><?= tr("Name EN") ?></label>
		<?= $_CONTROL->txtMainNameEn->RenderFormGroup(); ?>
		<label><?= tr("Name FR") ?></label>
		<?= $_CONTROL->txtMainNameFr->RenderFormGroup(); ?>
		<label><?= tr("Name NL") ?></label>
		<?= $_CONTROL->txtMainNameNl->RenderFormGroup(); ?>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<label><?= tr("Valid from") ?></label>
				<?= $_CONTROL->ddtFrom->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<label><?= tr("Valid till") ?></label>
				<?= $_CONTROL->ddtTill->RenderFormGroup(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-3">
				<?= $_CONTROL->chkMainActive->RenderFormGroup(); ?>
			</div>
		</div>
		<?= $_CONTROL->btnSave->RenderFormGroup(true, ["WrapperCssClass" => "+ rigth"]);	?>
		<div class="row">
			<div class="col-md-12">
				<h3 class="subtitle"><?= tr("Add Workflow step") ?></h3>
				<label><?= tr("Name EN") ?></label>
				<?= $_CONTROL->txtNameEn->RenderFormGroup(); ?>
				<label><?= tr("Name FR") ?></label>
				<?=	$_CONTROL->txtNameFr->RenderFormGroup(); ?>
				<label><?= tr("Name NL") ?></label>
				<?=	$_CONTROL->txtNameNl->RenderFormGroup(); ?>
				<?=	$_CONTROL->lstTeam->RenderFormGroup(); ?>
			</div>
			<div class="col-md-3">
				<?= $_CONTROL->chkActive->RenderFormGroup(); ?>
			</div>
			<div class="col-md-3">
				<?= $_CONTROL->btnSaveStep->RenderFormGroup(); ?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="row">
			<div class="col-md-12">
				<h3 class="subtitle"><?= tr("Overview steps") ?></h3>
				<?= $_CONTROL->dtgWorkflow->RenderFormGroup() ?>
			</div>
		</div>
	</div>
</div>