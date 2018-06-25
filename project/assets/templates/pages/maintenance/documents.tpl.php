<div class="clearfix">
	<div class="col-sm-12 col-md-4 col-lg-3  filter">
		<div class="row">
			<div class="col-xs-12">
				<h2><?= tr("Upload documents") ?></h2>
			</div>
			<div class="col-xs-12">
				<?php  $_CONTROL->flDocument->Render(); ?>	
				<?php  $_CONTROL->btnUpload->Render(); ?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-8 col-lg-9 contentWrap">
        <div class="table-with-newbtn">
		<div class="row">
			<div class="col-xs-12">
				<?php $_CONTROL->dgWordTemplate->Render(); ?>
			</div>
		</div>
        </div>
	</div>
</div>