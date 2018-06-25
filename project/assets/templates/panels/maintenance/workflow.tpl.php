<div class="row">
	<div class="col-sm-12 col-md-12">
		<h3 class="subtitle"><?= $_CONTROL->lblWorkStep->Render() ?></h3>
	</div>
	<div class="col-sm-12 col-md-2">
		<label class=""><?= tr("Team") ?></label>
		 <?=$_CONTROL->lstWorkTeam->RenderFormGroup();?>
	</div>
	<div class="col-sm-12 col-md-10">
		<div class="row">
			<div class="col-md-10 col-sm-12">
				<label class=""><?= tr("Status") ?></label>
				<?= $_CONTROL->btnStatus->Render() ?>
			</div>
			<div class="col-md-1 col-sm-6">
				<label class=""><?= tr("Date") ?></label>
				<?= $_CONTROL->txtDeadlineDate->RenderFormGroup() ?>
			</div>
			<div class="col-md-1 col-sm-6">
				<label class=""><?= tr("Time") ?></label>
				<?= $_CONTROL->txtDeadlineDateTime->RenderFormGroup() ?>
			</div>
		</div>
	</div>
</div>