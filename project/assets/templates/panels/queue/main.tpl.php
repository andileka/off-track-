<?php 
//$_CONTROL->pnlAccordion->Render();
?>
<div id="accordionWrap">
	<?php foreach($this->arrPanels as $panel) : ?>

			<div id="<?= $panel ?>Wrap" class="box">
				<div data-tabname="<?= $panel ?>" class="box-header with-border <?= $panel ?>" role="tab" onclick="togglePanel(<?= $panel ?> )">
					<h3 class="box-title"><?= $_CONTROL->{$panel}->GetAccordionHeader() ?></h3>
					<?= is_a($_CONTROL->{$panel}, 'Hikify\Panels\Job\Title') ? '' :
						'<div class="box-tools pull-right">
							<span class="btn btn-box-tool"><i class="icon fa fa-plus"></i>
							</span>
						</div>'
					?>
				</div>
				<div id="<?= $panel ?>" class="panel-collapse collapse" role="tabpanel">
					<div class="panel-body" >
						<?= $_CONTROL->{$panel}->Render(); ?>
					</div>
				</div>
			</div>
	<?php endforeach; ?>
</div>