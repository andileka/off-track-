<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Add new step") ?></h3></div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label class=""><?= tr("Type workflow") ?></label>
		 <?=$_CONTROL->lstWorkflow->RenderFormGroup();?>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="row">
			<div class="col-md-11 col-sm-12">
				<label class=""><?= tr("New workflow step") ?></label>
				<?=$_CONTROL->txtNewWorkflowStep->RenderFormGroup();?>
			</div>
			<div class="col-md-1 col-sm-1 col-md-pull-1">
				<label class="">&nbsp;</label>
				<?=$_CONTROL->btnAddWorkflowStep->RenderFormGroup();?>
			</div>
		</div>
	</div>
</div>

<?php $_CONTROL->pnlWorkflow->Render(); ?>