<style>.breadcrumb{background:transparent;}</style>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php?c=maintenance&a=expert"><i class="far fa-list-alt"></i> <?= tr('Back to overview') ?></a></li>
			<li class="active"><?= tr('Edit/Create') ?></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12"><?= $_CONTROL->navEntity->RenderFormGroup(true, ['WrapperCssClass' => '+ col-md-12']) ?></div>
</div>