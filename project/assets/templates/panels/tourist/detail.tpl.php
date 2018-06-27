	<h3 class="subtitle"><?= tr("Tourist information") ?></h3>
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label class=""><?= tr("Language") ?><sup>*</sup></label><?=$_CONTROL->lstLanguage->RenderFormGroup();?>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label class=""><?= tr("Status") ?><sup>*</sup></label><?=$_CONTROL->lstStatus->RenderFormGroup();?>
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
				<label class=""><?= tr("Nickname") ?></label>
				<?=$_CONTROL->lstNickname->RenderFormGroup();?>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label class=""><?= tr("Contact info") ?></label>
				<?=$_CONTROL->txtContactinfo->RenderFormGroup();?>
			</div>
		</div>
	</div>




	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label class=""><?= tr("Country") ?><sup>*</sup></label><?=$_CONTROL->lstCountry->RenderFormGroup();?>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label class=""><?= tr("City") ?><sup>*</sup></label><?=$_CONTROL->lstCity->RenderFormGroup();?>
			</div>
		</div>
	</div>	