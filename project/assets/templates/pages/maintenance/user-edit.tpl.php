<style>
	.breadcrumb{background:transparent;}
	.chk_select label {
		width:100%;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=users"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-12">
			<h3 class="subtitle"><?= tr("User credentials") ?></h3>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<label><?= tr("Firstname") ?></label>
					<?= $_CONTROL->txtFirstName->RenderFormGroup();?>
					<label><?= tr("Email") ?></label>
					<?= $_CONTROL->txtEmail->RenderFormGroup();?>
				</div>
				<div class="col-sm-12 col-md-6">
					<label><?= tr("Lastname") ?></label>
					<?= $_CONTROL->txtLastName->RenderFormGroup();?>
					<label><?= tr("Phone") ?></label>
					<?= $_CONTROL->txtMobilePhone->RenderFormGroup();?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h3 class="subtitle"><?= tr("Password user") ?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<label><?= tr("type Password") ?></label>
					<?= $_CONTROL->txtpassword1->RenderFormGroup();?>
				</div>
				<div class="col-sm-12 col-md-6">
					<label><?= tr("type Password") ?></label>
					<?= $_CONTROL->txtpassword2->RenderFormGroup();?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h3 class="subtitle"><?= tr("User Settings") ?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<label><?= tr("Type") ?></label>
					<?= $_CONTROL->lstType->RenderFormGroup();?>
				</div>
				<div class="col-sm-12 col-md-2">
					<label><?= tr("Language") ?></label>
					<?= $_CONTROL->lstLanguage->RenderFormGroup();?>
				</div>
				<div class="col-sm-12 col-md-4">
					<label><?= tr("Permissions") ?></label>
					<?= $_CONTROL->lstPermissions->RenderFormGroup();?>
				</div>
				<div class="col-sm-12 col-md-2">
					<div style="margin-top:27px"><?= $_CONTROL->chkActive->RenderFormGroup(); ?></div>
				</div>
			</div>
			<?= $_CONTROL->btnSave->RenderFormGroup(); ?>
		</div>
	</div>
</div>