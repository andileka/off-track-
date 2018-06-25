<?php
// This is the HTML template include file (.tpl.php) for the user_list.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.

// Be sure to move this file out of this directory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

global $gObjectName;
global $gObjectNamePlural;

$gObjectName =  t('User');
$gObjectNamePlural =  t('Users');

$strPageTitle = $gObjectName . ' ' . t('List');
require(QCUBED_CONFIG_DIR . '/header.inc.php');
?>

<?php $this->renderBegin() ?>

<?php $this->pnlNav->render(); ?>
<?php $this->pnlUserList->render(); ?>


<?php $this->renderEnd() ?>

<?php require(QCUBED_CONFIG_DIR . '/footer.inc.php'); ?>