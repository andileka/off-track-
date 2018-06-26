<div class="clearfix">
	<div class="col-sm-12 col-md-3 col-lg-2  filter">
		<div class="row">
			<div class="col-xs-12">
				<h2><?= tr("Filter") ?></h2>
			</div>
			<div class="col-xs-12">
				<?= 
					$_CONTROL->lblFilter->RenderFormGroup(); 
					$_CONTROL->lstExpert->RenderFormGroup(); 
					$_CONTROL->ddtDate->RenderFormGroup(); 
				?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-9 col-lg-10">
		<?= $_CONTROL->pnlNotification->RenderFormGroup() ?>
	</div>
	<div class="col-sm-12 col-md-9 col-lg-10 contentWrap">
        <div class="table-with-newbtn">
		<div class="row">
			<div class="col-xs-12">
				<?= $_CONTROL->navPlanning->RenderFormGroup() ?>
			</div>
		</div>
        </div>
	</div>
</div>