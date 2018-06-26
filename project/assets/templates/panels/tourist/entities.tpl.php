<div class="col-sm-12 col-md-6 col-lg-4  single-entity-job">
	<?php if($_CONTROL->lstOwnerType): ?>
		<div>
            <h3 class="subtitle"><?= tr('Add entity') ?></h3>
            <?php $_CONTROL->lstOwnerType->Render(true, ['WrapperCssClass' => '+ hide']); ?>
			<?php $_CONTROL->lstRolesType->RenderFormGroup(); ?>
			<?php $_CONTROL->btnEntitySelect->RenderFormGroup(true, ['WrapperCssClass' => '+ btnEntitySelect clearfix']); ?>
			<?php $_CONTROL->txtReference->RenderFormGroup(); ?>
			<?php $_CONTROL->txtComment->RenderFormGroup(true, ['WrapperCssClass' => '+ txt-comment']); ?>
            <div class="clearfix actions">
				<?php $_CONTROL->btnSave->Render(true, ['WrapperCssClass' => '+ actionbtn btn-save-role']); ?>
            </div>

			<?/*= $_CONTROL->pnlEntity->RenderFormGroup(true, ['WrapperCssClass' => '+ col-sm-12']); */?>
            <?= $_CONTROL->modalEntity->Render() ?>
        </div>
	<?php else: ?>
		<div>
            <h3 class="subtitle"><?= $_CONTROL->lstRolesType->SelectedName ?></h3>
            <?php $_CONTROL->lstRolesType->RenderFormGroup(); ?>
			<?php $_CONTROL->btnEntitySelect->RenderFormGroup(true, ['WrapperCssClass' => '+ btnEntitySelect clearfix']); ?>
			<?php $_CONTROL->lstSubcontractors->RenderFormGroup(); ?>
			<?php $_CONTROL->txtReference->RenderFormGroup(); ?>
			<?php $_CONTROL->txtComment->RenderFormGroup(true, ['WrapperCssClass' => '+ txt-comment']); ?>
            <div class="clearfix actions">
			<?php $_CONTROL->btnSave->Render(true, ['WrapperCssClass' => '+ actionbtn btn-save-role']); ?>
			<?php $_CONTROL->btnDelete->Render(true, ['WrapperCssClass' => '+ actionbtn btn-delete-role']); ?>
            </div>
			<?/*= $_CONTROL->pnlEntity->RenderFormGroup(true, ['WrapperCssClass' => '+ col-sm-12']); */?>
			<?= $_CONTROL->modalEntity->Render() ?>
        </div>
	<?php endif; ?>
</div>
