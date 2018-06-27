<?php
// This is the HTML template include file (.tpl.php) for the tourist_answer_edit.php
// Feel free to edit this as needed.
global $gObjectName;
global $gObjectNamePlural;

$gObjectName =  t('TouristAnswer');
$gObjectNamePlural =  t('TouristAnswers');

$strPageTitle = t('TouristAnswer');
require(QCUBED_CONFIG_DIR . '/header.inc.php');

?>
<?php $this->renderBegin() ?>

<h1><?= t('TouristAnswer')?></h1>

<div class="form-controls">
	<?= _r($this->pnlTouristAnswer); ?>
</div>

<div class="form-actions">
	<div class="form-save"><?php $this->btnSave->render(); ?></div>
	<div class="form-cancel"><?php $this->btnCancel->render(); ?></div>
	<div class="form-delete"><?php $this->btnDelete->render(); ?></div>
</div>

<?php $this->renderEnd() ?>

<?php require(QCUBED_CONFIG_DIR .'/footer.inc.php');