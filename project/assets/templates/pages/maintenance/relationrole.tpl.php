<div class="clearfix">
	<div class="col-sm-12 col-md-3 col-lg-2  filter">
		<div class="row">
			<div class="col-xs-12">
				<h2><?= $_CONTROL->lblFilter->RenderFormGroup() ?></h2>
			</div>
			<div class="col-xs-12">
				<?php 
					$_CONTROL->txtNumber->RenderFormGroup(); 
					$_CONTROL->lstType->RenderFormGroup(); 
					$_CONTROL->txtEntity->RenderFormGroup(); 
				?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-9 col-lg-10 contentWrap">
        <div class="table-with-newbtn">
		<div class="row">
			<div class="col-xs-12">
				<?php $_CONTROL->btnNew->Render(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<?php $_CONTROL->lstRoles->Render(); ?>
			</div>
		</div>
        </div>
	</div>
</div>