<div class="row">
    <div class="col-sm-12 col-md-6">
        <h3 class="subtitle"><?= tr("Add new Expert") ?></h3>
		
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<?= $_CONTROL->txtExpert->RenderFormGroup(); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<?= $_CONTROL->ddtStartdate->RenderFormGroup() ?>
					</div>
					<div class="col-sm-12 col-md-6">
						<?= $_CONTROL->ddtEndDate->RenderFormGroup() ?>
					</div>
				</div>
				
			</div>
		</div>
		<?= $_CONTROL->btnAddExpert->RenderFormGroup() ?>
	</div>
	<div class="col-sm-12 col-md-6">
		<h3 class="subtitle"><?= tr("Overview experts") ?></h3>
		<?= $_CONTROL->ddgListExperts->RenderFormGroup() ?>
	</div>
</div>
