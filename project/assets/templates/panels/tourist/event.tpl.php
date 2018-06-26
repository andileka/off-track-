<h3 class="subtitle"><?= tr("Event") ?></h3>
<?php $_CONTROL->pnlEvents->Render(); ?>
<?php
if(isset($_CONTROL->mpbox)) {
	$_CONTROL->mpbox->Render();
}
