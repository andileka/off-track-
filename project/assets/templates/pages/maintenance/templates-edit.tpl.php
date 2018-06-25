<style>.breadcrumb{background:transparent;}</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=templates"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
</div>
<div class='row'>
	<div class='col-md-12'>
		<div class="col-md-12"><h3 class="subtitle"><?= tr("Template type") ?></h3></div>
		<div class="col-md-6">
			<?= $_CONTROL->lstType->RenderFormGroup() ?>
		</div>
		<div class="col-md-6">
			<div  style="margin-top: 27px"><?= $_CONTROL->btnSave->RenderFormGroup(true, ['WrapperCssClass' => '+ left']) ?></div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12"><?= $_CONTROL->navLang->RenderFormGroup() ?></div>
	</div>
</div>
