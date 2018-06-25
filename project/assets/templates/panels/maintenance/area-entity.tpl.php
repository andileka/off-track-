<div class="row">
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Add new Entity") ?></h3>
		<?= $_CONTROL->txtEntity->RenderFormGroup(); ?>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<?= $_CONTROL->blnIncludeExclude->RenderFormGroup(true,  ['WrapperCssClass' => '+ two-buttons']); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<?= $_CONTROL->btnAddEntity->RenderFormGroup() ?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Overview enteties") ?></h3>
		<?= $_CONTROL->ddgListEntities->RenderFormGroup() ?>
	</div>
</div>
