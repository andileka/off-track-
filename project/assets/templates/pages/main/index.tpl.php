<style>
	.content-wrapper{overflow-x: hidden;}
</style>
<div class="row">
	<div class="col-xs-12">
		<h2 class="text-center"></h2>
		<br><br>	
		<p class="text-center"></p>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="col-sm-12"><h3 class="subtitle"><?= tr("People on tracks / day") ?></h3></div>
		<?= $_CONTROL->pnlChartJob->Render(); ?>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="col-sm-12"><h3 class="subtitle"><?= tr("People in huts / day") ?></h3></div>
		<?= $_CONTROL->pnlChartAppointment->Render(); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-6">
			<div class="col-sm-12"><h3 class="subtitle"><?= tr("Last 5 created jobs") ?></h3>
			</div>
			<div class="col-sm-12" style="padding-top:15px;">
				<a class="right" href="index.php?c=tourist&a=listing"><?= tr("Go to tourists") ?> </a>
			</div>
	</div>

	<div class="col-xs-12 col-md-4 col-md-push-2">
		<div class="col-sm-12"><h3 class="subtitle"><?= tr("Type of jobs") ?></h3></div>
		<?php // $_CONTROL->pnlChartJobType->Render(); ?>
		
	</div>
</div>