<?php
// This is the HTML template include file (.tpl.php) for the device_tourist_edit.php
// Feel free to edit this as needed.
global $gObjectName;
global $gObjectNamePlural;

$gObjectName =  t('DeviceTourist');
$gObjectNamePlural =  t('DeviceTourists');

$strPageTitle = t('DeviceTourist');
require(QCUBED_CONFIG_DIR . '/header.inc.php');

?>
<?php $this->renderBegin() ?>

<h1><?= t('DeviceTourist')?></h1>

<div class="form-controls">
	<?= _r($this->pnlDeviceTourist); ?>
</div>

<div class="form-actions">
	<div class="form-save"><?php $this->btnSave->render(); ?></div>
	<div class="form-cancel"><?php $this->btnCancel->render(); ?></div>
	<div class="form-delete"><?php $this->btnDelete->render(); ?></div>
</div>

<?php $this->renderEnd() ?>

<?php require(QCUBED_CONFIG_DIR .'/footer.inc.php');