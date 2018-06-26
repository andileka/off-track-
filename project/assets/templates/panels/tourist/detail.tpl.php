<div class="row">
	<div class="col-sm-12"></div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h3 class="subtitle"><?= tr("Tourist information") ?></h3>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label class=""><?= tr("Language") ?><sup>*</sup></label><?=$_CONTROL->lstLanguage->RenderFormGroup();?>
						</div>

					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label class=""><?= tr("Name") ?></label>
							<?=$_CONTROL->txtName->RenderFormGroup();?>
						</div>
						<div class="form-group">
							<label class=""><?= tr("Contact") ?></label>
							<?=$_CONTROL->txtContactinfo->RenderFormGroup();?>
						</div>
					</div>
				</div>



				
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label class=""><?= tr("Country") ?><sup>*</sup></label><?=$_CONTROL->lstCountry->RenderFormGroup();?>
						</div>
						<div class="form-group">
							<label class=""><?= tr("City") ?><sup>*</sup></label><?=$_CONTROL->lstCity->RenderFormGroup();?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>