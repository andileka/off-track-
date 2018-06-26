<style>
	textarea{min-height:150px;}
</style>
<div class="row">
	<div class="col-sm-12"><h3 class="subtitle"><?= tr("Create new appointment") ?></h3></div>
	<?= $_CONTROL->pnlNotification->RenderFormGroup(true, ['WrapperCssClass' => '+ col-sm-12']) ?>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<?php $_CONTROL->lstType->RenderFormgroup();?>
				<?php $_CONTROL->pnlTimeOfDay->RenderFormgroup(true, ['WrapperCssClass' => '+ two-buttons']); ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<?php $_CONTROL->lstPlace->RenderFormgroup(); ?>
				<?php $_CONTROL->blnPreferredTimeMayChange->RenderFormgroup(true, ['WrapperCssClass' => '+ two-buttons']); ?>
			</div>
		</div>
		<?php $_CONTROL->lstAddTasks->RenderFormGroup() ?>
		<?php $_CONTROL->pnlHome->RenderFormgroup(); ?>
	</div>
	<div class="col-sm-12 col-md-6">
		<?php $_CONTROL->txtComment->RenderFormgroup(); ?>
		<?php	$_CONTROL->pnlPlaceVisitingHours->Render(); ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-12">
			<?= $_CONTROL->pnlCustomfields->RenderFormgroup(); ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-12">
			<?= $_CONTROL->pnlDatepickerContainer->RenderFormgroup(true, ['WrapperCssClass' => '+ ll-skin-latoja']); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 col-md-12">
		<h3 class="subtitle"><?= tr("Appointment overview") ?></h3>
		<?= $_CONTROL->dgAppointments->RenderFormgroup(true, ['WrapperCssClass' => '+ ll-skin-latoja']); ?>
	</div>
</div>
