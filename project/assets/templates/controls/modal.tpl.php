<div class="modal <?= $_CONTROL->Class ?>" id="<?= $_CONTROL->ID ?>">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title"><?= $_CONTROL->lblTitle->Render() ?></h4>
			<?= $_CONTROL->btnClose->Render() ?>
		</div>
			<?= $_CONTROL->pnlBody->Render() ?>
	  </div>
	  <!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>